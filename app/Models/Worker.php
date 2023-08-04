<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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
     *
     * @return HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Получите должность, которую имеет работник.
     *
     * @return BelongsTo
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Проекты, которые принадлежат работнику.
     *
     * @return BelongsToMany
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    /**
     * Аватар, который принадлежит работнику.
     * Отношение один к одному полиморф (One To One (Polymorphic))
     *
     * @return MorphOne
     */
    public function avatar(): MorphOne
    {
        return $this->morphOne(Avatar::class, 'avatarable');
    }
}
