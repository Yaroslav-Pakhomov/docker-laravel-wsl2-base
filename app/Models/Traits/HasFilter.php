<?php

namespace App\Models\Traits;

use App\Http\Filters\Var1\Interfaces\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

trait HasFilter
{

    /**
     * Создание своего запроса для фильтра
     */
    public function scopeFilter(Builder $builder, FilterInterface $workerFilter): Builder
    {
        $workerFilter->getFilters($builder);

        return $builder;
    }

}
