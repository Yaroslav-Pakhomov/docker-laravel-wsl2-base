<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this->hasMany(Worker::class, 'position_id', 'id');
    }

    /**
     * Получите отдел.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
