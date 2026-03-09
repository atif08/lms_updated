<?php

namespace App\Admin\Forms;

use App\Models\Batch;
use Carbon\Carbon;
use Kris\LaravelFormBuilder\Field;

class BatchForm extends BaseForm
{
    public function buildForm(): void
    {

        /** @var Batch $batch */
        $batch = $this->getData('batch');

        $this
            ->add('name', FIELD::TEXT, [
                'label' => required_label('Title'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr' => ['class' => 'form-control', 'rows' => '4'],
                'rules' => ['required', 'max:255'],
                'value' => $batch->name ?? '',
            ])
            ->add('month', FIELD::SELECT, [
                'label' => __('Month'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => ['class' => 'form-select'],
                'selected' => $batch->month ?? '',
                'choices' => array_combine(
                    array_map(fn ($i) => str_pad($i, 2, '0', STR_PAD_LEFT), range(1, 12)),
                    array_map(fn ($i) => Carbon::create()->month($i)->format('F'), range(1, 12))
                ),                'rules' => ['required'],
            ])
            ->add('year', Field::SELECT, [
                'label' => __('Year'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr' => ['class' => 'form-select'],
                'selected' => $batch->year ?? '',
                'choices' => array_combine(
                    range(date('Y'), date('Y') + 10), // Current year to 10 years in the future
                    range(date('Y'), date('Y') + 10)
                ),
                'rules' => ['required'],
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'wrapper' => ['class' => 'form-group col-md-12 col-sm-12 mt-2'],
                'label' => '<span class="fa fa-save"></span> '.__('Save'),
                'attr' => ['class' => 'btn btn-success btn-save'],
            ]);
    }
}
