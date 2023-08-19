<?php

declare(strict_types=1);

namespace App\Http\Filters\Var1\Interfaces;


use Illuminate\Database\Eloquent\Builder;

interface FilterInterface {

    /**
     * Вызываем те методы фильтрации, значения которых существует
     */
    public function getFilters(Builder $builder): void;

    /**
     * Возвращает необходимые методы (их название) для фильтрации
     *
     * @return array
     */
    public function getCallbacks(): array;
}
