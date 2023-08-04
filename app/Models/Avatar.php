<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Avatar extends Model
{
    use HasFactory;

    protected $table = 'avatars';

    /**
     * Атрибуты, которые нельзя присваивать массово
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Получите родительскую модель аватара (worker или client).
     * Отношение один к одному полиморф (One To One (Polymorphic))
     *
     * @return MorphTo
     */
    public function avatarable(): MorphTo
    {
        return $this->morphTo();
    }
}
