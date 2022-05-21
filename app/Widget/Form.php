<?php

namespace App\Widget;

class Form
{
    protected $button;
    protected $fields = [];
    protected $action = '';
    protected $method = '';
    protected $formGroups = [];
    protected $shouldConfirm = false;

    public function formGroups($filter) {
        return $this->formGroups;
    }

    public function method() {
        return $this->method;
    }

    public function action() {
        return $this->action;
    }

    public function shouldConfirm() {
        $this->shouldConfirm;
    }

    public function buttons() {
        return [
            [
                'type' => 'button',
                'label' => 'Submit',
                'classes' => '',
                'id' => ''
            ]
        ];
    }

    public function render($filter) {
        return [
            'formGroups' => $this->formGroups($filter),
            'method' => $this->method(),
            'action' => $this->action(),
            'buttons' => $this->buttons(),
            'shouldConfirm' => $this->shouldConfirm()
        ];
    }
}
