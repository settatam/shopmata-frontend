<?php

namespace App\Widget\Filter;

class Select
{
    protected $type = 'select';
    protected $selected = '';
    protected $actions = '';
    protected $button_label = 'Submit';
    protected $options = [];
    protected $id = '';
    protected $classes = '';
    protected $filter;
    protected $label;
    protected $isRequired = false;

    public function data() {

    }

    public function items() {

    }

    public function type() {
        return $this->type;
    }

    public function selected() {
        return $this->selected;
    }

    public function actions($filter) {
        return $this->actions;
    }

    public function options($filter) {
        return $this->options;
    }

    public function classes() {
        return $this->classes;
    }

    public function id() {
        return $this->id;
    }

    public function isRequired() {
        return $this->isRequired;
    }

    public function label() {
        return $this->label;
    }

    public function attributes($filter) {
        return [
            'name' => '',
            'value' => '',
            'id' => $this->id(),
            'classes' => $this->classes()
        ];
    }

    public function render($filter=[]) {
        $this->filter = $filter;
        return [
            'type' => $this->type(),
            'selected' => $this->selected(),
            'action' => $this->actions($filter),
            'options' => $this->options($filter),
            'attributes' => $this->attributes($filter)
        ];
    }
}
