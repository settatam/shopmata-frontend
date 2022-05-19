<?php

namespace App\Widget;

abstract class Widget
{
    /**
     * @var int How many minutes to cache the Widget's data; set to 0 for no caching
    */
      protected $cacheFor = 0;

      /**
       * @var bool This is a beta widget
       */
      protected $beta = false;

      /**
       * @var string The title of the widget
       */
      protected $title = 'Widget';

      protected $icon = null;

      protected $description = null;

      protected $component = 'Empty';

      protected $explore = null;

      protected $options = [];

      protected $filter = null;

      protected $data = [];

    function config($filter, $data)
      {
        return [];
      }

      function title()
      {

        return $this->title;
      }

      function component($filter, $data)
      {
        return $this->component;
      }

      function description($filter, $filteredData)
      {
        return $this->description;
      }

      protected function icon($filter, $filteredData)
      {
        return $this->icon;
      }

      protected function explore($filter, $filteredData)
      {
        return $this->explore;
      }

      protected function exploreLabel($filter, $filteredData)
      {
        return 'Explore';
      }

      public function exportable($filter, $filteredData)
      {
        return null;
      }

      public function options($filter, $data) {
        return [];
      }


      /**
       * If Widget is exportable, use this function to control whether or not the export
       * is deferred to a queueable job and delivered as an attachment.
       * @param $filter
       * @param $filteredData
       * @return bool Defaults to false
       */
      public function defersExport()
      {
        return false;
      }

      protected function footer()
      {
        return null;
      }

      function authorized(User $user, $action = 'view', $filter = null)
      {
        return true;
      }

      function actions($filter) {
          return [];
      }

      function buildFilters($filter, $data) {
          return $filter;
      }

      function render($filter = null, $data = [])
      {

        $title = $this->title($filter, $data);
        $data = $this->data;

        return array_merge([
            'widget' => get_class($this),
            'title' => $this->title(),
            'description' => $this->description($filter, $data),
            'icon' => $this->icon($filter, $data),
            'component' => $this->component($filter, $data),
            'filter' => $filter,
            'filters' => $this->buildFilters($filter, $data),
            'explore' => $this->explore($filter, $data),
            'exploreLabel' => $this->exploreLabel($filter, $data),
            'footer' => $this->footer($filter, $data),
            'exportable' => $this->exportable($filter, $data),
            'options' => $this->options($filter, $data),
            'actions' => $this->actions($filter),
        ], $this->config($filter, $data));
      }
}
