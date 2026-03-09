<?php

namespace App\Admin\Forms\Courses;

use App\Admin\Forms\BaseForm;
use Domain\Courses\Models\Topic;
use Kris\LaravelFormBuilder\Field;

class RegisterForm extends BaseForm
{
    /** @var Topic */
    protected $topic;

    public function buildForm()
    {
        $topic = $this->getData('item');
        $this
            ->add('first_name', FIELD::TEXT, [
                'label' => required_label('First Name'),
                'wrapper' => ['class' => 'input-block'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
            ])
            ->add('last_name', FIELD::TEXT, [
                'label' => required_label('Last Name'),
                'wrapper' => ['class' => 'input-block'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
            ])
            ->add('email', FIELD::EMAIL, [
                'label' => required_label('Email'),
                'wrapper' => ['class' => 'input-block'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
            ])
            ->add('mobile', FIELD::TEXT, [
                'label' => required_label('Mobile'),
                'wrapper' => ['class' => 'input-block'],
                'attr' => ['class' => 'form-control'],
                'rules' => ['required', 'string', 'max:255'],
            ])
            ->add('password', FIELD::PASSWORD, [
                'label' => required_label('Password'),
                'wrapper' => ['class' => 'input-block '],
                'attr' => ['class' => 'form-control pass-input'],
                'rules' => ['required', 'string', 'max:255'],
            ])

//            ->add('media', 'single_media',["label"=>'Select Assignment',"item"=>$topic ?? new Topic()])

            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => __('Create Account'),
                'wrapper' => ['class' => 'd-grid'],
                'attr' => ['class' => 'btn btn-primary btn-start'],
            ]);
    }
}
