<?php

namespace App\Repository\Services\Filter\Filters;


use \App\Repository\Services\Filter\Filter;
use Closure;

/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 21.08.2021
 * Time: 16:39
 */

class DateTo extends Filter
{
    protected  function applyFilter($builder){
      return  $builder->where('created_at','<=',\request($this->Filter_Name()));
    }
}
