<?php

namespace App\Admin\Forms\FileLibrary;

use App\Admin\Forms\BaseForm;
use Domain\FileLibrary\Enums\FileTypeEnum;
use Domain\Users\Models\User;
use Kris\LaravelFormBuilder\Field;

class FileLibraryForm extends BaseForm
{
    public function buildForm()
    {

        $item = $this->getData('item');
        $this
           /* ->add('type', FIELD::SELECT, [
                'label'    => __('Media Type'),
                'wrapper'  => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr'     => ['class' => 'form-select'],
                'selected' => $item->type ?? '',
                'choices'  => FileTypeEnum::getDropdown(),
                'rules'    => ['required'],
            ])*/
            ->add('media', 'collection_media', ['item' => new User])

            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => '<span class="fa fa-save"></span> '.__($item ? 'Save' : 'Save'),
                'wrapper' => ['class' => 'form-group mt-2 mb-2'],
                'attr' => ['class' => 'btn btn-success btn-supplier-save'],
            ]);
    }
}
