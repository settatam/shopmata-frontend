<?php

namespace App\Widget;

use Illuminate\Support\Str;

class Table extends Widget
{

    protected $title = 'Table Widget';

    protected $component = 'Table';

    protected $striped = true;

    protected $hover = true;

    protected $allowShowAll = true;

    protected $showAll = false;

    protected $fixed = false;

    protected $responsive = true;

    protected $stickyHeader = true;

    protected $stacked = false;

    protected $hasCheckBox = false;

    protected $isSearchable = false;

    protected $shouldChangeStatus = false;

    protected $showPagination = true;

    protected $data;

    public function __construct($filter=null, $data=[])
      {
          $this->filter = $filter;
          $this->data = $data;
      }

      /**
       * @param $filter
       * @param $filteredData
       * @return array|Arrayable
       */
      public function fields()
      {
          $filteredData = $this->data;

          $items = collect(data_get($filteredData, 'items'));

            if ($data = $items->first()) {
              if ($data instanceof Arrayable) {
                $data = $data->toArray();
              }
              return array_keys((array) $data);
            } else {
              return [];
            }
      }

      /**
       * @param $filter
       * @param $filteredData
       * @return array|Arrayable
       */
      public function items($filter)
      {
          return data_get($this->data, 'items');
      }

      protected function tableOptions($filter, $filteredData)
      {
          return [
          'fixed' => $this->fixed($filter, $filteredData),
          'stickyHeader' => $this->stickyHeader($filter, $filteredData),
          'stacked' => $this->stacked($filter, $filteredData),
          'responsive' => $this->responsive($filter, $filteredData),
          'striped' => $this->striped($filter, $filteredData),
          'hover' => $this->hover($filter, $filteredData),
//          'htmlFormattedFields' => $this->htmlFormattedFields($filter, $filteredData) ?: [],
//          'htmlFormattedHeaders' => $this->htmlFormattedHeaders($filter, $filteredData) ?: [],
          'fieldWidths' => $this->fieldWidths($filter, $filteredData) ?: [],
          'perPage' => $this->perPage($filter, $filteredData),
          'sortBy' => $this->sortBy($filter, $filteredData),
          'sortDesc' => $this->sortDesc($filter, $filteredData),
          'allowShowAll' => $this->allowShowAll($filter, $filteredData),
              'hasCheckBox' => $this->hasCheckBox()
        ];
      }

      public function config($filter, $filteredData=[])
      {
        $config = [
          'data' => [
              'fields' => $this->fields($filter, $filteredData),
              'options' => $this->tableOptions($filter, $filteredData),
              'items' => $this->items($filter),
              //'totalRows' => $this->data->lastPage(),
          ],
        ];

        $config['hasCheckBox'] = $this->hasCheckBox();
        $config['isSearchable'] = $this->isSearchable();
        $config['pagination'] = $this->pagination();

        $config['fields'] = collect($this->fields($filter, $filteredData))
          ->map(function($data) use (&$config) {
            if (is_string($data)) {
              $field = [
                $key = $data,
                Str::studly($key),
                false
              ];
            } else {
              $field = [
                $key = data_get($data, 'key'),
                data_get($data, 'label', Str::studly($key)),
                data_get($data, 'sortable', false),
              ];
            }

            if ($html = data_get($data, 'html')) {
              if (is_array($html)) {
                if (data_get($data, 'html.field')) {
                  $config['data']['options']['htmlFormattedFields'][] = $key;
                }
                if (data_get($data, 'html.header')) {
                  $config['data']['options']['htmlFormattedHeaders'][] = $key;
                }
              } else {
                $config['data']['options']['htmlFormattedFields'][] = $key;
                $config['data']['options']['htmlFormattedHeaders'][] = $key;
              }
            }

            if ($width = data_get($data, 'width')) {
              $config['data']['options']['fieldWidths'][$key] = $width;
            }

            return $field;
          });

        return $config;
      }

      protected function fieldWidths($filter, $filteredData)
      {
        return [];
      }

      protected function fixed($filter, $filteredData)
      {
        return (bool) $this->fixed;
      }

      protected function stacked($filter, $filteredData)
      {
        return $this->stacked;
      }

      protected function responsive($filter, $filteredData)
      {
        return $this->responsive;
      }

      protected function stickyHeader($filter, $filteredData)
      {
        return (bool) $this->stickyHeader;
      }

      protected function striped($filter, $filteredData)
      {
        return (bool) $this->striped;
      }

      protected function hover($filter, $filteredData)
      {
        return (bool) $this->hover;
      }

      public function sortBy($filter, $filteredData)
      {
//        return Paginator::get($filter)->sortBy();
      }

      public function sortDesc($filter, $filteredData)
      {
//        return Paginator::get($filter)->sortDesc();
      }

      public function perPage($filter, $filteredData)
      {
//        return $this->showAll && $this->allowShowAll ? $this->totalRows($filter, $filteredData) : Paginator::get($filter)->perPage();
      }

      public function totalRows()
      {
        return 0;
      }

      public function allowShowAll($filter, $filteredData)
      {
        return $this->allowShowAll;
      }

      public function hasCheckBox() {
          return $this->hasCheckBox;
      }

    public function isSearchable() {
          return $this->isSearchable;
    }

    public function shouldChangeStatus() {
          return $this->shouldChangeStatus;
    }

    public function showPagination() {
          return $this->showPagination;
    }

    public function pagination() {
          return [
              'total' => $this->data->total(),
              'per_page' => $this->data->perPage(),
              'current_page' => $this->data->currentPage(),
              'from' => (($this->data->currentPage()-1) * $this->data->perPage()) + 1,
              'to' => (($this->data->currentPage()) * $this->data->perPage()) < $this->data->total() ? $this->data->currentPage() * $this->data->perPage() : $this->data->total() ,
              'first_page_url' => $this->data->url(1),
              'last_page_url' => $this->data->url($this->data->lastPage()),
              'path' => $this->data->path(),
              'links' => $this->data->linkCollection()->toArray(),
              'show_pagination' => $this->showPagination()
          ];
    }

    protected function paginatorLinks() {
          //$totalPages = $this->data->total();
    }

}
