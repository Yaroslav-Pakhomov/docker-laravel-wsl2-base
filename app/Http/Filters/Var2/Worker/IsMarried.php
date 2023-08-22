<?php

declare(strict_types=1);


namespace App\Http\Filters\Var2\Worker;

use Closure;
use Illuminate\Database\Eloquent\Builder;

/**
 * Фильтрация женат/не женат
 */
class IsMarried
{

    /**
     * @param Builder $builder
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Builder $builder, Closure $next): mixed
    {
        if (!empty(request('is_married')) && (string)request('is_married') === 'on') {
            $builder->where('is_married', true);
        }

        return $next($builder);
    }
}
