<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    /**
     * Атрибуты, которые нельзя присваивать массово
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Получите всех работников, которым присвоен этот тег.
     *
     * @return MorphToMany
     */
    public function workers(): MorphToMany
    {
        return $this->morphedByMany(Worker::class, 'taggable');
    }

    /**
     * Получите всех клиентов, которым присвоен этот тег.
     *
     * @return MorphToMany
     */
    public function clients(): MorphToMany
    {
        return $this->morphedByMany(Client::class, 'taggable');
    }

}
