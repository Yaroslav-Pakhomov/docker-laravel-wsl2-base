<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    /**
     * Атрибуты, которые нельзя присваивать массово
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Получить работника по его id через должность, занимаемую в отделе.
     */
    public function positionWorker(int $id): HasOneThrough
    {
        return $this->hasOneThrough(Worker::class, Position::class, 'department_id', 'position_id', 'id', 'id')->where('position_id', $id);
    }
}
