<?php

namespace App\Admin\Categories\Controllers;

use App\Admin\DataTables\CategoryDataTable;
use App\Admin\Forms\Settings\CategoryForm;
use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Categories\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data_table = new CategoryDataTable(user: $this->user, request: $request);
        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('admin.categories.index', compact('data_table'));
    }

    public function create(FormBuilder $formBuilder): View
    {
        $form = $this->_getForm($formBuilder);

        return $this->renderView('admin.categories.form', compact('form'));
    }

    public function store(FormBuilder $formBuilder, Request $request): RedirectResponse
    {
        $form = $this->_getForm($formBuilder);
        $form->redirectIfNotValid();
        Category::query()->create($form->getFieldValues());
        FlashMessage::success('Category created successfully !');

        return to_route('categories.index');
    }

    public function edit(Category $category, FormBuilder $formBuilder): View
    {
        $form = $this->_getForm($formBuilder, $category);

        return $this->renderView('admin.categories.form', compact('form'));
    }

    public function update(Category $category, FormBuilder $formBuilder, Request $request): RedirectResponse
    {
        $form = $this->_getForm($formBuilder, $category);

        $form->redirectIfNotValid();

        $category->update($form->getFieldValues());

        FlashMessage::success('Category updated successfully !');

        return to_route('categories.index');
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json(['message' => 'item deleted successfully']);
    }

    private function _getForm(FormBuilder $form_builder, $category = null): Form
    {
        return $form_builder->create(CategoryForm::class, [
            'method' => $category ? 'PUT' : 'POST',
            'url' => $category ? route('categories.update', $category->id) : route('categories.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'item' => $category,
            'class' => get_class($this),
        ]);
    }
}
