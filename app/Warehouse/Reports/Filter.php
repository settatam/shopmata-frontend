<?php

namespace App\Warehouse\Reports;

class Filter
{
    static function uriKey()
    {
        return static::class;
    }

  /**
   * Get the value for this filter; if empty or null, load the default
   * @param null $filter
   * @return mixed
   */
  static function get($filter = null)
  {
    return data_get($filter, self::uriKey(), (new static)->default($filter, null));
  }

  /**
   * Is there a defined value for this filter in the request?
   * @param null $filter
   * @return bool
   */
  static function has($filter = null)
  {
    return (bool) data_get($filter, self::uriKey());
  }


  /**
   * Does this filter exist in the request?
   * @param null $filter
   */
  static function exists($filter = null)
  {
    return array_key_exists(self::uriKey(), $filter);
  }
}
