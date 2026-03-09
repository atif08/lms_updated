<?php

namespace App\Forms;

use Domain\Users\Models\User;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

abstract class BaseForm extends Form {

    /** @var User */
    protected $user;
    /** @var User */
    protected $selected_user;
    /** @var User */
    protected $current_account;
    /** @var string */
    protected $class;

    public function buildForm() {
        $this->user = $this->getData('user');
        $this->selected_user = $this->getData('selected_user');
        $this->current_account = $this->getData('current_account');
        $this->class = $this->getData('class');

        $this->buildComponents();
    }

    public function buildComponents() {}

    public function addIf($name, $type = 'text', array $options = [], $condition = true) {
        return $condition ? $this->add($name, $type, $options) : $this;
    }

    protected function addHeading($name, $title, $options = []) {
        $this
            ->add("{$name}_heading", FIELD::STATIC, array_merge([
                'label'   => false,
                'tag'     => 'h4',
                'wrapper' => ['class' => 'form-group mb-3 mt-3'],
                'value'   => __($title)
            ], $options));

        return $this;
    }

    protected function addSeparator($name) {
        $this
            ->add("{$name}_separator", FIELD::STATIC, [
                'label'   => false,
                'tag'     => 'hr',
                'wrapper' => ['class' => 'form-group mb-3 mt-3'],
                'value'   => ''
            ]);

        return $this;
    }

    protected function addLabel($name, $title) {
        $this
            ->add($name . '_label', FIELD::STATIC, [
                'label'   => false,
                'tag'     => 'label',
                'wrapper' => ['class' => 'form-group m-0'],
                'attr'    => ['class' => 'control-label'],
                'value'   => __($title)
            ]);

        return $this;
    }
}
