<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;

class ConnectionsForm extends BaseForm {

    public function buildComponents(): void {
        $parent_user = $this->user->getParent();

        $this
            ->add('client_id', FIELD::TEXTAREA, [
                'label'   => required_label('Client Id'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr'    => ['class' => 'form-control', 'rows' => '4'],
                'rules'   => ['required', 'max:255'],
                'value'   => $parent_user->connection->client_id
            ])
            ->add('client_secret', FIELD::TEXTAREA, [
                'label'   => required_label('Client Secret'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr'    => ['class' => 'form-control', 'rows' => '4'],
                'rules'   => ['required', 'max:255'],
                'value'   => $parent_user->connection->client_secret
            ])
            ->add('refresh_token', FIELD::TEXTAREA, [
                'label'   => required_label('Refresh Token'),
                'wrapper' => ['class' => 'form-group mb-2 col-lg-12'],
                'attr'    => ['class' => 'form-control', 'rows' => '10'],
                'rules'   => ['required', 'max:255'],
                'value'   => $parent_user->connection->refresh_token
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'wrapper' => ['class' => 'form-group col-md-12 col-sm-12 mt-2'],
                'label'   => '<span class="fa fa-save"></span> ' . __('Update'),
                'attr'    => ['class' => 'btn btn-success btn-save'],
            ]);
    }
}
