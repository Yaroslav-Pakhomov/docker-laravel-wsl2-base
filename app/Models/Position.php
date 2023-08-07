<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';

    /**
     * Атрибуты, которые нельзя присваивать массово
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Получите всех работник, который имеет должность.
     */
    public function workers(): HasMany
    {
        return $this->hasMany(Worker::class);
    }

    /**
     * Получите отдел.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Получите всех работник в возрастном интервале.
     *
     * @return HasMany
     */
    public function middleAgeWorkers(): HasMany
    {
        return $this->hasMany(Worker::class)->whereBetween('age', [30, 50]);
    }

    /**
     * Получите самого старшего работника.
     *
     * @return HasOne
     */
    public function oldestWorker(): HasOne
    {
        return $this->hasOne(Worker::class)->ofMany('age');
    }

    /**
     * Получите самого старшего работника.
     *
     * @return HasOne
     */
    public function youngestWorker(): HasOne
    {
        return $this->hasOne(Worker::class)->ofMany('age', 'min');
    }

}
