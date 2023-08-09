<?php

declare(strict_types=1);

namespace App\Listeners\Worker;

use App\Models\Profile;

class CreateProfileListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Обработать событие. Вся логика, которая д.б. реализована при событии пишется здесь.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle(object $event): void
    {
        // dd($event->worker->toArray());
        Profile::query()->create([
            'worker_id' => $event->worker->id,
        ]);
    }
}
