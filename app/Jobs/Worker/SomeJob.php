<?php

namespace App\Jobs\Worker;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SomeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Выполнить задание. Вся логика работы очереди.
     * Выполняется то, что прописана в момент запуска работы (Job),
     * а не то, что было прописано в момент внесения работы
     * в таблицу 'jobs' у очереди
     */
    public function handle(): void
    {
        // $someString = 'Some string';
        // $someInt = 100;
        // dump($someString . ' ' . $someInt);

        // dd($var);
    }
}
