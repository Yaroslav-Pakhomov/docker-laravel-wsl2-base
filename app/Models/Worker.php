<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\Worker\CreatedEvent as WorkerCreatedEvent;
use App\Http\Filters\Var1\WorkerFilter as WorkerFilterVar1;
use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static filter(WorkerFilterVar1 $workerFilter1)
 */
class Worker extends Model
{
    use HasFactory;

    // Трейт фильтра
    use HasFilter;

    // Мягкое удаление
    use SoftDeletes;

    protected $table = 'workers';

    /**
     * Атрибуты, которые нельзя присваивать массово
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Метод для работы с Событиями и Слушателями
     *
     * @return void
     */
    protected static function booted(): void
    {
        // Событие создания у модели
        static::created(static function (Worker $worker) {

            event(new WorkerCreatedEvent($worker));

            // // Короткий способ при создании рабочего сразу создавать его пустой профиль
            // Profile::query()->create([
            //     'worker_id' => $worker->id,
            // ]);
        });

        // Событие обновления у модели
        static::updated(static function (Worker $worker) {
            // При проверке данных на изменение нужно приводить данные к типу, который указан в таблице и сравнивать оператором эквивалентности '!=='
            if ($worker->wasChanged() && ((int)$worker->getOriginal('age') !== (int)$worker->getAttributes()['age'])) {

                // dump($worker->getOriginal('age'), $worker->getAttributes()['age']);

                // dd($worker->toArray());
                // event(new WorkerUpdatedEvent($worker));
            }
        });
    }

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

    /**
     * Комментарии, которые принадлежат работнику.
     * Отношение один ко многим полиморф (One To Many (Polymorphic))
     *
     * @return MorphMany
     */
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    /**
     * Получите все теги для работника.
     *
     * @return MorphToMany
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
