<?php

namespace App\Repository\Services\Filter;


use Closure;
use Illuminate\Support\Str;

abstract class  Filter
{
    public function handle($request, Closure $next)
    {
        if (!\request()->has($this->FilterName()))
            return $next($request);

        $builder=$next($request);
        return $this->applyFilter($builder);

    }
     protected abstract function applyFilter($builder);

    protected function  FilterName(){
        return Str::snake(class_basename($this));
    }

}
