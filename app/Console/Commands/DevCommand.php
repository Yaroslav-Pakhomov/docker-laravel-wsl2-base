<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DevCommand extends Command
{
    /**
     * Имя и подпись консольной команды без 'php artisan'.
     *
     * @var string
     */
    protected $signature = 'app:develop';

    /**
     * Описание консольной команды.
     *
     * @var string
     */
    protected $description = 'Команда разработки/отладки.';

    /**
     * Выполнение консольной команды, что она делает.
     */
    public function handle()
    {
        dd(11111);
//        return 1111;
    }
}
