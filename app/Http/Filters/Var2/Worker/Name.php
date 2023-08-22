<?php

declare(strict_types=1);


namespace App\Http\Filters\Var2\Worker;

use Closure;
use Illuminate\Database\Eloquent\Builder;

/**
 * Фильтрация по имени
 */
class Name
{

    /**
     * @param Builder $builder
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Builder $builder, Closure $next): mixed
    {
        if (!empty(request('name'))) {
            $builder->where('name', 'like', '%' . request('name') . '%');
        }

        return $next($builder);
    }
}
