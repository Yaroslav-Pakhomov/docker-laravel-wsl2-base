<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Worker extends Model
{
    use HasFactory;

    protected $table = 'workers';

    /**
     * Атрибуты, которые нельзя присваивать массово
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Получите профиль, который имеет работник.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }
}
