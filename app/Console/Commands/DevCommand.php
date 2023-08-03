<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Position;
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

        // Получаем должность
        $position = Position::query()->find(1);
        // Находим работника по профилю
        // if (isset($position->workers)) {
        //     $workers = $position->workers->toArray();
        //     dd($workers);
        // }

        // Получаем профиль
        $profile = Profile::query()->find(1);
        // Находим работника по профилю
        // if (isset($profile->worker)) {
        //     $worker = $profile->worker->toArray();
        //     dd($worker);
        // }

        // Получаем работника
        $worker = Worker::query()->find(1);
        // Находим профиль по работнику
        if (isset($worker->profile)) {
            $profile = $worker->profile->toArray();
            $position = $worker->position->toArray();

            dump($worker->toArray());
            dump($position);
            dd($profile);
        }

        $workers = Worker::query()->whereIn('id', [1, 2, 3,])->get();
        // pluck() - для выбора колонки из таблицы 'workers'
        $position_unique = $workers->pluck('position_id')->unique();
        $position_unique = $position_unique->toArray();
        dd(Position::query()->whereIn('id', $position_unique)->get()->toArray());

        return 0;
    }

    private function prepareData()
    {
        // Данные для записи в таблицу 'positions'
        $positionData1 = [
            'title'       => 'Науный сотрудник',
            'description' => 'Описание должности научного сотрудника',
        ];
        $positionData2 = [
            'title'       => 'Ведущий науный сотрудник',
            'description' => 'Описание должности ведущий научного сотрудника',
        ];

        $position1 = Position::query()->create($positionData1);
        $position2 = Position::query()->create($positionData2);
        dump($position1->title);
        dump($position2->title);

        // Данные для записи в таблицу 'workers'
        $workerData1 = [
            'name'        => 'Алексей',
            'surname'     => 'Алексеев',
            'email'       => 'aleckseev@mail.ru',
            'age'         => 23,
            'description' => 'Я Алексей Алексеев.',
            'is_married'  => FALSE,
            'position_id' => $position1->id,
        ];
        $workerData2 = [
            'name'        => 'Александр',
            'surname'     => 'Александров',
            'email'       => 'alecksandrov@mail.ru',
            'age'         => 23,
            'description' => 'Я Александр Александров.',
            'is_married'  => FALSE,
            'position_id' => $position1->id,
        ];
        $workerData3 = [
            'name'        => 'Семен',
            'surname'     => 'Семенов',
            'email'       => 'semenov@mail.ru',
            'age'         => 35,
            'description' => 'Я Семен Семенов.',
            'is_married'  => TRUE,
            'position_id' => $position2->id,
        ];

        $worker1 = Worker::query()->create($workerData1);
        $worker2 = Worker::query()->create($workerData2);
        $worker3 = Worker::query()->create($workerData3);
        dump($worker1->name);
        dump($worker2->name);
        dump($worker3->name);

        // Данные для записи в таблицу 'profiles'
        $profileData1 = [
            'city'              => 'Москва',
            'skill'             => 'JavaScript, PHP',
            'experience'        => 3,
            'finished_study_at' => '2022-07-05',
            'worker_id'         => $worker1->id,
        ];
        $profileData2 = [
            'city'              => 'Екатеринбург',
            'skill'             => 'HTML, CSS, JavaScript, Python',
            'experience'        => 3,
            'finished_study_at' => '2022-07-05',
            'worker_id'         => $worker2->id,
        ];
        $profileData3 = [
            'city'              => 'Санкт-Петербург',
            'skill'             => 'Java',
            'experience'        => 5,
            'finished_study_at' => '2012-07-05',
            'worker_id'         => $worker3->id,
        ];

        $profile1 = Profile::query()->create($profileData1);
        $profile2 = Profile::query()->create($profileData2);
        $profile3 = Profile::query()->create($profileData3);

        dump($profile1->city);
        dump($profile2->city);
        dd($profile3->city);
    }
}
