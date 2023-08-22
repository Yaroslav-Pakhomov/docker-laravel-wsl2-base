<?php

declare(strict_types=1);

namespace App\Http\Filters\Var2\Worker;

use Closure;
use Illuminate\Database\Eloquent\Builder;

/**
 * Фильтрация по возрасту от
 */
class AgeFrom
{

    /**
     * @param Builder $builder
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Builder $builder, Closure $next): mixed
    {
        if (!empty(request('age_from'))) {
            $builder->where('age', '>=', (int)request('age_from'));
        }

        return $next($builder);
    }
}
