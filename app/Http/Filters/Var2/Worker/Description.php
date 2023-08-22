<?php

declare(strict_types=1);


namespace App\Http\Filters\Var2\Worker;

use Closure;
use Illuminate\Database\Eloquent\Builder;


/**
 * Фильтрация по описанию
 */
class Description
{

    /**
     * @param Builder $builder
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Builder $builder, Closure $next): mixed
    {
        if (!empty(request('description'))) {
            $builder->where('description', 'like', '%' . request('description') . '%');
        }

        return $next($builder);
    }
}
