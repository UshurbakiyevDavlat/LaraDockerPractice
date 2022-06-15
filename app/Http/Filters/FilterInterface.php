<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

Interface FilterInterface
{
    public function apply(Builder $builder);
}
