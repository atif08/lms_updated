<?php

namespace App\Admin\FileLibrary\Controllers;

use App\Admin\DataTables\FileLibrary\FileLibraryDataTable;
use App\Admin\Forms\FileLibrary\FileLibraryForm;
use App\Http\Controllers\BaseController;
use App\Jobs\ShareUserEmailJob;
use App\Services\FlashMessage;
use Domain\FileLibrary\Enums\MediaCollectionEnum;
use Domain\FileLibrary\Models\FileLibrary;
use Domain\Users\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileLibraryController extends BaseController
{
    public function index(Request $request): View|JsonResponse
    {

        $data_table = new FileLibraryDataTable(user: $this->user, request: $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

        $data_table->setFilterData(['users' => User::where('is_active', 1)->get()]);

        return $this->renderView('admin.fileLibrary.index', compact('data_table'));

    }

    public function create(FormBuilder $formBuilder): View
    {
        $fileLibrary = new FileLibrary;
        $createForm = $this->_getForm($formBuilder);

        return $this->renderView('admin.fileLibrary.form', compact('createForm', 'fileLibrary'));

    }

    public function store(Request $request, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $this->_getForm($formBuilder);

        $form->redirectIfNotValid();

        $fileLibrary = FileLibrary::query()->create($form->getFieldValues() + ['user_id' => $request->user()->id]);

        if ($request->has('media')) {

            $fileLibrary->addFromMediaLibraryRequest($request->media)
                ->toMediaCollection(MediaCollectionEnum::MEDIA_LIBRARY());
        }

        FlashMessage::success('FileLibrary created successfully !');

        return to_route('file-libraries.index');
    }

    public function edit(FileLibrary $fileLibrary, FormBuilder $formBuilder): View
    {
        $createForm = $this->_getForm($formBuilder, $fileLibrary);

        return $this->renderView('admin.fileLibrary.form', compact('createForm'));
    }

    public function update(FileLibrary $fileLibrary, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $this->_getForm($formBuilder, $fileLibrary);

        $form->redirectIfNotValid();

        $fileLibrary->update($form->getFieldValues());

        FlashMessage::success('FileLibrary updated successfully !');

        return to_route('file-libraries.index');
    }

    public function changeStatus(FileLibrary $fileLibrary): JsonResponse
    {
        $fileLibrary->changeStatus();

        return $this->resJson('Successfully changed status');
    }

    private function _getForm(FormBuilder $form_builder, $item = null): Form
    {

        return $form_builder->create(FileLibraryForm::class, [
            'method' => $item ? 'PUT' : 'POST',
            'url' => $item ? route('file-libraries.update', $item) : route('file-libraries.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'item' => $item,

            'class' => get_class($this),
        ]);
    }

    public function destroy($id): JsonResponse
    {

        try {
            // Fetch the media instance by ID
            $media = Media::query()->findOrFail($id);
            // Get the file path from the media instance
            $filePath = $media->getPath();
            // Ensure we have a relative path
            $relativePath = str_replace(storage_path('app/public/media').'/', '', $filePath);
            // Log the relative file path for debugging
            Log::info('Relative file path for deletion: '.$relativePath);
            // Verify if the file exists on the media disk
            if (Storage::disk('media')->exists($relativePath)) {
                // Delete the file from the media disk
                Storage::disk('media')->delete($relativePath);
                Log::info('File deleted: '.$relativePath);
            } else {
                Log::warning('File not found during deletion: '.$relativePath);
            }
            // Delete the media record from the database
            $media->delete();

            // Redirect back with a success message
            return response()->json(['message' => 'item deleted successfully', 'item' => []]);
        } catch (\Exception $e) {
            // Log the exception message
            Log::error('Deletion error: '.$e->getMessage());

            // Redirect back with an error message
            return response()->json(['message' => 'item deleted successfully', 'item' => []]);
        }

    }

    public function download($id): BinaryFileResponse|RedirectResponse
    {
        try {
            // Fetch the media instance by ID
            $media = Media::findOrFail($id);
            // Get the file path from the media instance
            $filePath = $media->getPath();
            // Ensure we have a relative path
            $relativePath = str_replace(storage_path('app/public/media').'/', '', $filePath);
            // Log the relative file path for debugging
            Log::info('Relative file path: '.$relativePath);

            // Verify if the file exists on the media disk
            if (! Storage::disk('media')->exists($relativePath)) {
                Log::error('File not found: '.$relativePath);
                abort(404, 'File not found.');
            }

            // Return the file as a download response
            return response()->download(
                Storage::disk('media')->path($relativePath),
                $media->file_name
            );
        } catch (\Exception $e) {
            // Log the exception message
            Log::error('Download error: '.$e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'There was a problem downloading the file.');
        }
    }

    public function share(Request $request)
    {
        // dd($request->selectedFileIds);
        // Validate the request
        $request->validate([
            'selectedUsers' => 'required|array',
            'selectedUsers.*' => 'exists:users,id',
        ]);
        $users = User::whereIn('id', $request->selectedUsers)->get();

        // Fetch selected file IDs
        $selectedFileIds = explode(',', $request->selectedFileIds);
        // Retrieve the selected files from the database
        $files = Media::whereIn('id', $selectedFileIds)->get();
        if ($files->isEmpty()) {
            FlashMessage::error('No files found for the selected IDs.');

            return to_route('file-libraries.index');
        }
        foreach ($users as $user) {
            // Dispatch job to share users via email
            ShareUserEmailJob::dispatch($user, $files);
        }
        FlashMessage::success('Files shared successfully with selected users!');

        return to_route('file-libraries.index');
    }
}
