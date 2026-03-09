<?php

namespace App\Http\Controllers;

use App\DataTables\ImportRequestsDataTable;
use App\Enums\JobStatusEnum;
use App\Enums\ReportTypeEnum;
use App\Forms\Import\ImportMappingsForm;
use App\Forms\Import\SupplierSheetImportForm;
use App\Forms\Import\UPCImportForm;
use App\Forms\SupplierForm;
use App\Http\Requests\DropdownRequest;
use App\Jobs\ImportRequestsJob;
use App\Models\ImportRequest;
use App\Models\Supplier;
use Carbon\Carbon;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\FormBuilder;

class ImportsController extends BaseController {

    protected function hasControllerAccess(Request $request): bool {
        return $this->user->isAdmin();
    }

    public function getIndex(Request $request) {
        $data_table = new ImportRequestsDataTable($this->user, $this->current_account, $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('imports.index', compact('data_table'));
    }

    public function getDownload(Request $request) {
        $request->validate(['import_id' => ['required']]);

        $import_request = $this->_getImportRequest($request, true);

        return storage()->download($import_request->file_path);
    }

    public function postDelete(Request $request) {
        $request->validate(['import_id' => ['required']]);

        $import_request = $this->_getImportRequest($request, true);

        $import_request->delete();
        return true;
    }

    public function getRequests(Request $request, FormBuilder $form_builder) {
        $request->validate([
            'report_type' => ['required', Rule::in(ReportTypeEnum::cases())]
        ]);

        $import_request = null;
        if ($request->has('import_id')) {
            $import_request = $this->_getImportRequest($request);
        }

        return match ($request->get('report_type')) {
            ReportTypeEnum::SUPPLIER_SHEET()->value => $this->_getSupplierSheetRequests($request, $form_builder, $import_request),
            default                                 => $this->_getRequests($request, $form_builder, $import_request),
        };
    }

    private function _getRequests(Request $request, FormBuilder $form_builder, ImportRequest $import_request = null) {
        $upload_form = $this->createForm($form_builder, UPCImportForm::class, [
            'method' => 'POST',
            'url'    => route('imports.post.requests'),
            'role'   => 'form',
            'class'  => 'file-import-form'
        ], compact('import_request'));

        $mappings_form = null;
        if ($import_request) {
            $mappings_form = $this->createForm($form_builder, ImportMappingsForm::class, [
                'method' => 'POST',
                'url'    => route('imports.post.mappings'),
                'role'   => 'form',
                'class'  => 'mappings-form row'
            ], compact('import_request'));
        }

        return $this->renderView('imports.requests', compact('upload_form', 'mappings_form'));
    }

    private function _getSupplierSheetRequests(Request $request, FormBuilder $form_builder, ImportRequest $import_request = null) {
        $supplier_form = $mappings_form = null;

        $upload_form = $this->createForm($form_builder, SupplierSheetImportForm::class, [
            'method' => 'POST',
            'url'    => route('imports.post.requests'),
            'role'   => 'form',
            'class'  => 'file-import-form'
        ], compact('import_request'));

        if ($import_request) {
            $mappings_form = $this->createForm($form_builder, ImportMappingsForm::class, [
                'method' => 'POST',
                'url'    => route('imports.post.mappings'),
                'role'   => 'form',
                'class'  => 'mappings-form row'
            ], compact('import_request'));
        } else {
            $supplier_form = $this->createForm($form_builder, SupplierForm::class, [
                'method' => 'POST',
                'url'    => route('suppliers.post.details'),
                'role'   => 'form',
                'class'  => 'supplier-create'
            ]);
        }

        return $this->renderView('imports.supplier-sheet-requests', compact('supplier_form', 'upload_form', 'mappings_form'));
    }

    public function postRequests(Request $request, FormBuilder $form_builder) {
        $request->validate([
            'report_type' => ['required', Rule::in(ReportTypeEnum::cases())]
        ]);

        $import_request = null;
        if ($request->has('import_id')) {
            $import_request = $this->_getImportRequest($request);
        }

        if (!$import_request) {
            $import_request = match ($request->get('report_type')) {
                ReportTypeEnum::SUPPLIER_SHEET()->value => $this->_postSupplierSheetRequests($request, $form_builder),
                default                                 => $this->_postRequests($request, $form_builder),
            };
        }

        if (!$import_request instanceof ImportRequest) {
            return $import_request;
        }

        return match ($request->get('report_type')) {
            ReportTypeEnum::SUPPLIER_SHEET()->value => $this->_getSupplierSheetRequests($request, $form_builder, $import_request),
            default                                 => $this->_getRequests($request, $form_builder, $import_request),
        };
    }

    /**
     * @param Request $request
     * @param FormBuilder $form_builder
     * @return ImportRequest|JsonResponse
     */
    private function _postRequests(Request $request, FormBuilder $form_builder): ImportRequest|JsonResponse {
        $form = $this->createForm($form_builder, UPCImportForm::class);

        if (!$form->isValid()) {
            return $this->resJson(['errors' => $form->getErrors()], 422);
        }

        $account = null;
        if ($request->has('account_id')) {
            $account = User::query()->findOrFail($request->get('account_id'));
        }

        return $this->_createImportRequest($request, $account);
    }

    /**
     * @param Request $request
     * @param FormBuilder $form_builder
     * @return ImportRequest|JsonResponse
     */
    private function _postSupplierSheetRequests(Request $request, FormBuilder $form_builder): ImportRequest|JsonResponse {
        $form = $this->createForm($form_builder, SupplierSheetImportForm::class);

        if (!$form->isValid()) {
            return $this->resJson(['errors' => $form->getErrors()], 422);
        }

        /** @var Supplier $supplier */
        $supplier = Supplier::query()->findOrFail($request->get('supplier_id'));

        return $this->_createImportRequest($request, $supplier);
    }

    /**
     * @param DropdownRequest $request
     * @param FormBuilder $form_builder
     * @return JsonResponse
     */
    public function postMappings(DropdownRequest $request, FormBuilder $form_builder) {
        $request->validate(['import_id' => ['required']]);

        $import_request = $this->_getImportRequest($request);

        $form = $this->createForm($form_builder, ImportMappingsForm::class, [], compact('import_request'));

        if (!$form->isValid()) {
            return $this->resJson(['errors' => $form->getErrors()], 422);
        }

        $mappings = $request->except('file', '_token', 'report_type', 'import_id', 'supplier_id');

        $import_request->update([
            'mappings' => $mappings,
            'status'   => JobStatusEnum::QUEUED(),
        ]);

        dispatch(new ImportRequestsJob($this->user->getParent()))
            ->delay(Carbon::now()->addSeconds(30));

        return response()->json('done');
    }

    /**
     * @param Request $request
     * @param $status_any
     * @return ImportRequest
     */
    private function _getImportRequest(Request $request, $status_any = false): ImportRequest {
        /** @var ImportRequest $import_request */
        $import_request = ImportRequest::query()->find($request->get('import_id'));

        abort_if(!$import_request ||
            (!$status_any && !$import_request->isPreQueued()), 422);

        return $import_request;
    }

    /**
     * @param Request $request
     * @param User|Supplier|null $importable
     * @return ImportRequest
     */
    private function _createImportRequest(Request $request, User|Supplier $importable = null): ImportRequest {
        $report = $request->file('file');
        $file_path = 'imports/' . $this->user->id . '/';
        $file_path = storage()->put($report, $file_path);
        $data = [
            'user_id'         => $this->user->id,
            'report_name'     => pathinfo(basename($file_path), PATHINFO_FILENAME),
            'report_type'     => $request->get('report_type'),
            'account_id'      => $this->current_account->id,
            'importable_type' => $importable ? get_class($importable) : null,
            'importable_id'   => $importable?->id,
            'status'          => JobStatusEnum::PENDING(),
            'file_path'       => $file_path
        ];

        /** @var ImportRequest $import_request */
        $import_request = ImportRequest::query()->create($data);

        return $import_request->verifyHeaders();
    }
}
