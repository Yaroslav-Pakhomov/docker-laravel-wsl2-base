<?php

namespace App\Http\Filters\Var1;

use App\Http\Filters\Var1\Interfaces\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter implements FilterInterface
{
    /**
     * @param array $params массив со значениями фильтрации
     */
    public array $params = [];

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function getFilters(Builder $builder): void
    {
        foreach ($this->getCallbacks() as $attribute => $method) {
            if (isset($this->params[$attribute])) {
                $this->$method($builder, $this->params[$attribute]);
            }
        }
    }

    abstract public function getCallbacks(): array;

}
