<?php

namespace App\Widget;

class CheckBox
{
    protected $type = 'checkbox';
    protected $selected = [];
    protected $actions = '';
    protected $options = [];
    protected $id = '';
    protected $classes = '';
    protected $filter;
    protected $label;
    protected $title;
    protectd $name = 'checkbox';

    public function data()
    {

    }

    public function items()
    {

    }

    public function title() {
        return 'Default Title';
    }

    public function type()
    {
        return $this->type;
    }

    public function selected()
    {
        return $this->selected;
    }

    public function actions($filter)
    {
        return $this->actions;
    }

    public function options($filter)
    {
        return $this->options;
    }

    public function classes()
    {
        return $this->classes;
    }

    public function label()
    {
        return $this->label;
    }

    public function name() {
        return $this->name;
    }

    public function render($filter = [])
    {
        $this->filter = $filter;
        return [
            'type' => $this->type(),
            'selected' => $this->selected(),
            'options' => $this->options($filter),
            'title' => $this->title(),
            'name' => $this->name()
        ];
    }
}
