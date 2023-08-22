<?php

declare(strict_types=1);


namespace App\Http\Filters\Var2\Worker;

use Closure;
use Illuminate\Database\Eloquent\Builder;

/**
 * Фильтрация по фамилии
 */
class Surname
{

    /**
     * @param Builder $builder
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Builder $builder, Closure $next): mixed
    {
        if (!empty(request('surname'))) {
            $builder->where('surname', 'like', '%' . request('surname') . '%');
        }

        return $next($builder);
    }
}
