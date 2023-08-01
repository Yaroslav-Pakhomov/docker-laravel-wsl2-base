<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Profile;
use App\Models\Worker;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
        // $this->prepareData();

        // Получаем профиль
        $profile = Profile::query()->find(1);
        // Находим работника по профилю
        if (isset($profile->worker)) {
            $worker = $profile->worker->toArray();
            dump($worker);
        }

        // Получаем работника
        $worker = Worker::query()->find(7);
        // Находим профиль по работнику
        if (isset($worker->profile)) {
            $profile = $worker->profile->toArray();

            dd($profile);
        }

        return 0;
    }

    private function prepareData()
    {
        // Данные для записи в таблицу 'workers'
        $workerData = ['name' => 'Алексей', 'surname' => 'Алексеев', 'email' => 'aleckseev@mail.ru', 'age' => 23, 'description' => 'Я Алексей Алексеев.', 'is_married' => FALSE,];

        $worker = Worker::query()->create($workerData);

        // Данные для записи в таблицу 'profiles'
        $profileData = ['city' => 'Москва', 'skill' => 'JavaScript, PHP', 'experience' => 3, 'finished_study_at' => '2022-07-05', 'worker_id' => $worker->id,];

        $profile = Profile::query()->create($profileData);

        dd($profile->id);
    }
}
