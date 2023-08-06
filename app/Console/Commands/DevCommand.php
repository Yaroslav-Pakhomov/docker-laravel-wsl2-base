<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Avatar;
use App\Models\Client;
use App\Models\Department;
use App\Models\Position;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Review;
use App\Models\Worker;
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
        // $this->prepareData();
        // $this->prepareManyToMany();
        // $this->preparePolymorphic();

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
        // // Находим профиль по работнику
        // if (isset($worker->profile)) {
        //     $profile = $worker->profile->toArray();
        //     $position = $worker->position->toArray();
        //     $projects = $worker->projects->toArray();
        //
        //     // dump($worker->toArray());
        //     dump($position);
        //     dump($profile);
        //     dd($projects);
        // }

        // // К какому отделу принадлежит работник
        // dd($worker->position->department->toArray());


        // Получаем проект
        $project = Project::query()->find(2);
        // // Находим работников проекта
        // if (isset($project->workers)) {
        //     dd($project->workers->toArray());
        // }

        // если писать в конце скобки $worker->projects(), то вызывается метод и можно продолжать запрос к таблице в методе, т.е. 'project_workers'
        //
        // метод attach() добавляет запись в таблицу, можно передавать массив attach([$project->id, $project1->id, $project2->id,])
        //
        // метод detach() - противоположный методу attach()
        //
        // метод toggle() переключает запись в таблицу создаёт/удаляет, можно передавать массив toggle([$project->id, $project1->id, $project2->id,])
        //
        // метод sync() записывает то, что ему передают всё, что было до этого он удаляет в таблице, можно передавать массив sync([$project->id, $project1->id, $project2->id,])

        // $worker->projects()->attach($project->id);
        // dd('Запись в project_workers добавлена');

        // Отдел работника, через отношение 'Один к одному через'
        $department = Department::query()->find(1);
        // // Получим Зав. лаба.
        // dd($department->positionWorker(3)->get()->toArray());

        $workers = Worker::query()->whereIn('id', [1, 2, 3,])->get();
        // pluck() - для выбора колонки из таблицы 'workers'
        // $position_unique = $workers->pluck('position_id')->unique();
        // $position_unique = $position_unique->toArray();
        // dd(Position::query()->whereIn('id', $position_unique)->get()->toArray());


        // ---------------------------------------------------------------------------
        // Отношение один к одному полиморф (One To One (Polymorphic)) - начало
        // ---------------------------------------------------------------------------

        // $worker1 = Worker::query()->find(1);
        // dump($worker1->avatar->toArray());
        //
        // $client1 = Client::query()->find(1);
        // dump($client1->avatar->toArray());
        //
        // $avatar4 = Avatar::query()->find(4);
        // dd($avatar4->avatarable->toArray());

        // ---------------------------------------------------------------------------
        // Отношение один к одному полиморф (One To One (Polymorphic)) - конец
        // ---------------------------------------------------------------------------


        // ---------------------------------------------------------------------------
        // Отношение один к многим полиморф (One To Many (Polymorphic)) - начало
        // ---------------------------------------------------------------------------

        $worker1 = Worker::query()->find(1);
        dump($worker1->reviews->toArray());

        $client1 = Client::query()->find(1);
        dump($client1->reviews->toArray());

        $review4 = Review::query()->find(4);
        dd($review4->reviewable->toArray());

        // ---------------------------------------------------------------------------
        // Отношение один к многим полиморф (One To Many (Polymorphic)) - конец
        // ---------------------------------------------------------------------------


        return 0;
    }

    private function prepareData()
    {
        $department1 = Department::query()->create([
            'title' => 'ИТ',
        ]);
        $department2 = Department::query()->create([
            'title' => 'Аналитика',
        ]);

        // Данные для записи в таблицу 'positions'
        $positionData1 = [
            'title'         => 'Научный сотрудник',
            'description'   => 'Описание должности научного сотрудника',
            'department_id' => $department1->id,
        ];
        $positionData2 = [
            'title'         => 'Ведущий науный сотрудник',
            'description'   => 'Описание должности ведущий научного сотрудника',
            'department_id' => $department1->id,
        ];
        $positionData3 = [
            'title'         => 'Заведующий лаборатории',
            'description'   => 'Описание должности заведующего лаборатории',
            'department_id' => $department1->id,
        ];

        $position1 = Position::query()->create($positionData1);
        $position2 = Position::query()->create($positionData2);
        $position3 = Position::query()->create($positionData3);
        dump($position1->title);
        dump($position2->title);
        dump($position3->title);

        // Данные для записи в таблицу 'workers'
        $workerData1 = [
            'name'        => 'Алексей',
            'surname'     => 'Алексеев',
            'email'       => 'aleckseev@mail.ru',
            'age'         => 23,
            'description' => 'Я Алексей Алексеев.',
            'is_married'  => false,
            'position_id' => $position1->id,
        ];
        $workerData2 = [
            'name'        => 'Александр',
            'surname'     => 'Александров',
            'email'       => 'alecksandrov@mail.ru',
            'age'         => 23,
            'description' => 'Я Александр Александров.',
            'is_married'  => false,
            'position_id' => $position1->id,
        ];
        $workerData3 = [
            'name'        => 'Семен',
            'surname'     => 'Семенов',
            'email'       => 'semenov@mail.ru',
            'age'         => 35,
            'description' => 'Я Семен Семенов.',
            'is_married'  => true,
            'position_id' => $position2->id,
        ];
        $workerData4 = [
            'name'        => 'Иван',
            'surname'     => 'Иванов',
            'email'       => 'ivanov@mail.ru',
            'age'         => 45,
            'description' => 'Я Иван Иванов.',
            'is_married'  => true,
            'position_id' => $position2->id,
        ];
        $workerData5 = [
            'name'        => 'Петр',
            'surname'     => 'Петров',
            'email'       => 'petrov@mail.ru',
            'age'         => 55,
            'description' => 'Я Петр Петров.',
            'is_married'  => true,
            'position_id' => $position3->id,
        ];
        $workerData6 = [
            'name'        => 'Сидор',
            'surname'     => 'Сидоров',
            'email'       => 'sidorov@mail.ru',
            'age'         => 65,
            'description' => 'Я Семен Семенов.',
            'is_married'  => true,
            'position_id' => $position2->id,
        ];

        $worker1 = Worker::query()->create($workerData1);
        $worker2 = Worker::query()->create($workerData2);
        $worker3 = Worker::query()->create($workerData3);
        $worker4 = Worker::query()->create($workerData4);
        $worker5 = Worker::query()->create($workerData5);
        $worker6 = Worker::query()->create($workerData6);

        // ---------------------------------------------------------------------------
        // Отношение один к одному полиморф (One To One (Polymorphic)) - начало
        // ---------------------------------------------------------------------------

        $worker1->avatar()->create([
            'path' => 'workers/avatar/worker1.img',
        ]);
        $worker2->avatar()->create([
            'path' => 'workers/avatar/worker2.img',
        ]);
        $worker3->avatar()->create([
            'path' => 'workers/avatar/worker3.img',
        ]);
        $worker4->avatar()->create([
            'path' => 'workers/avatar/worker4.img',
        ]);
        $worker5->avatar()->create([
            'path' => 'workers/avatar/worker5.img',
        ]);
        $worker6->avatar()->create([
            'path' => 'workers/avatar/worker6.img',
        ]);

        // ---------------------------------------------------------------------------
        // Отношение один к одному полиморф (One To One (Polymorphic)) - конец
        // ---------------------------------------------------------------------------


        // ---------------------------------------------------------------------------
        // Отношение один к многим полиморф (One To Many (Polymorphic)) - начало
        // ---------------------------------------------------------------------------

        $worker1->reviews()->create([
            'title'   => 'Отзыв 1',
            'content' => 'Содержание отзыва 1.',
        ]);
        $worker1->reviews()->create([
            'title'   => 'Отзыв 2',
            'content' => 'Содержание отзыва 2.',
        ]);
        $worker1->reviews()->create([
            'title'   => 'Отзыв 3',
            'content' => 'Содержание отзыва 3.',
        ]);

        $worker2->reviews()->create([
            'title'   => 'Отзыв 1',
            'content' => 'Содержание отзыва 1.',
        ]);
        $worker2->reviews()->create([
            'title'   => 'Отзыв 2',
            'content' => 'Содержание отзыва 2.',
        ]);
        $worker2->reviews()->create([
            'title'   => 'Отзыв 3',
            'content' => 'Содержание отзыва 3.',
        ]);

        $worker3->reviews()->create([
            'title'   => 'Отзыв 1',
            'content' => 'Содержание отзыва 1.',
        ]);
        $worker3->reviews()->create([
            'title'   => 'Отзыв 2',
            'content' => 'Содержание отзыва 2.',
        ]);
        $worker3->reviews()->create([
            'title'   => 'Отзыв 3',
            'content' => 'Содержание отзыва 3.',
        ]);

        $worker4->reviews()->create([
            'title'   => 'Отзыв 1',
            'content' => 'Содержание отзыва 1.',
        ]);
        $worker4->reviews()->create([
            'title'   => 'Отзыв 2',
            'content' => 'Содержание отзыва 2.',
        ]);
        $worker4->reviews()->create([
            'title'   => 'Отзыв 3',
            'content' => 'Содержание отзыва 3.',
        ]);

        $worker5->reviews()->create([
            'title'   => 'Отзыв 1',
            'content' => 'Содержание отзыва 1.',
        ]);
        $worker5->reviews()->create([
            'title'   => 'Отзыв 2',
            'content' => 'Содержание отзыва 2.',
        ]);
        $worker5->reviews()->create([
            'title'   => 'Отзыв 3',
            'content' => 'Содержание отзыва 3.',
        ]);

        $worker6->reviews()->create([
            'title'   => 'Отзыв 1',
            'content' => 'Содержание отзыва 1.',
        ]);
        $worker6->reviews()->create([
            'title'   => 'Отзыв 2',
            'content' => 'Содержание отзыва 2.',
        ]);
        $worker6->reviews()->create([
            'title'   => 'Отзыв 3',
            'content' => 'Содержание отзыва 3.',
        ]);

        // ---------------------------------------------------------------------------
        // Отношение один к многим полиморф (One To Many (Polymorphic)) - конец
        // ---------------------------------------------------------------------------


        dump($worker1->name);
        dump($worker2->name);
        dump($worker3->name);
        dump($worker4->name);
        dump($worker5->name);
        dump($worker6->name);

        // Данные для записи в таблицу 'profiles'
        $profileData1 = [
            'city'              => 'Москва',
            'skill'             => 'JavaScript, PHP',
            'experience'        => 3,
            'finished_study_at' => '2022-07-05',
            // 'worker_id'         => $worker1->id,
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
        $profileData4 = [
            'city'              => 'Новосибирск',
            'skill'             => 'C++',
            'experience'        => 7,
            'finished_study_at' => '2002-07-05',
            'worker_id'         => $worker4->id,
        ];
        $profileData5 = [
            'city'              => 'Иркутск',
            'skill'             => 'C#',
            'experience'        => 15,
            'finished_study_at' => '1992-07-05',
            'worker_id'         => $worker5->id,
        ];
        $profileData6 = [
            'city'              => 'Омск',
            'skill'             => 'Java',
            'experience'        => 25,
            'finished_study_at' => '1982-07-05',
            'worker_id'         => $worker6->id,
        ];


        // $profile1 = Profile::query()->create($profileData1);
        // Вместо способа выше, через отношения
        $profile1 = $worker1->profile()->create($profileData1);

        $profile2 = Profile::query()->create($profileData2);
        $profile3 = Profile::query()->create($profileData3);
        $profile4 = Profile::query()->create($profileData4);
        $profile5 = Profile::query()->create($profileData5);
        $profile6 = Profile::query()->create($profileData6);

        dump($profile1->city);
        dump($profile2->city);
        dump($profile3->city);
        dump($profile4->city);
        dump($profile5->city);
        dump($profile6->city);
    }

    private function prepareManyToMany()
    {
        $workerResearcher1 = Worker::query()->find(1);
        $workerResearcher2 = Worker::query()->find(2);
        $workerResearcher3 = Worker::query()->find(6);

        $workerLeadingResearcher1 = Worker::query()->find(3);
        $workerLeadingResearcher2 = Worker::query()->find(4);

        $workerLaboratoryHead = Worker::query()->find(5);

        $projectData1 = [
            'title' => 'Приложение',
        ];
        $projectData2 = [
            'title' => 'Интернет-магазин',
        ];
        $projectData3 = [
            'title' => 'Блог',
        ];

        $project1 = Project::query()->create($projectData1);
        $project2 = Project::query()->create($projectData2);
        $project3 = Project::query()->create($projectData3);

        // Проект 1 с 1_1 по 1_4 и записи в БД
        $project1->workers()->attach([
            $workerResearcher1->id,
            $workerResearcher2->id,
            $workerLeadingResearcher1->id,
            $workerLaboratoryHead->id,
        ]);

        // Проект 2 с 2_1 по 2_4 и записи в БД
        $project2->workers()->attach([
            $workerResearcher2->id,
            $workerResearcher3->id,
            $workerLeadingResearcher2->id,
            $workerLaboratoryHead->id,
        ]);

        // Проект 3 с 3_1 по 3_4 и записи в БД
        $project3->workers()->attach([
            $workerResearcher1->id,
            $workerResearcher3->id,
            $workerLeadingResearcher1->id,
            $workerLaboratoryHead->id,
        ]);

        // Проект 1
        // $projectWorkerData1_1 = [
        //     'project_id' => $project1->id,
        //     'worker_id'  => $workerResearcher1->id,
        // ];
        // $projectWorkerData1_2 = [
        //     'project_id' => $project1->id,
        //     'worker_id'  => $workerResearcher2->id,
        // ];
        // $projectWorkerData1_3 = [
        //     'project_id' => $project1->id,
        //     'worker_id'  => $workerLeadingResearcher1->id,
        // ];
        // $projectWorkerData1_4 = [
        //     'project_id' => $project1->id,
        //     'worker_id'  => $workerLaboratoryHead->id,
        // ];
        // Проект 1 запись в БД
        // $projectWorker1_1 = ProjectWorker::query()->create($projectWorkerData1_1);
        // $projectWorker1_2 = ProjectWorker::query()->create($projectWorkerData1_2);
        // $projectWorker1_3 = ProjectWorker::query()->create($projectWorkerData1_3);
        // $projectWorker1_4 = ProjectWorker::query()->create($projectWorkerData1_4);

        dump('Многие ко многим готовы');
    }

    private function preparePolymorphic()
    {
        $clientData1 = [
            'name' => 'Клиент 1',
        ];
        $clientData2 = [
            'name' => 'Клиент 2',
        ];
        $clientData3 = [
            'name' => 'Клиент 3',
        ];

        $client1 = Client::query()->create($clientData1);
        $client2 = Client::query()->create($clientData2);
        $client3 = Client::query()->create($clientData3);


        // ---------------------------------------------------------------------------
        // Отношение один к одному полиморф (One To One (Polymorphic)) - начало
        // ---------------------------------------------------------------------------

        $client1->avatar()->create([
            'path' => 'clients/avatar/client1.img',
        ]);
        $client2->avatar()->create([
            'path' => 'clients/avatar/client2.img',
        ]);
        $client3->avatar()->create([
            'path' => 'clients/avatar/client3.img',
        ]);

        // ---------------------------------------------------------------------------
        // Отношение один к одному полиморф (One To One (Polymorphic)) - конец
        // ---------------------------------------------------------------------------


        // ---------------------------------------------------------------------------
        // Отношение один к многим полиморф (One To Many (Polymorphic)) - начало
        // ---------------------------------------------------------------------------

        $client1->reviews()->create([
            'title'   => 'Отзыв 1',
            'content' => 'Содержание отзыва 1.',
        ]);
        $client1->reviews()->create([
            'title'   => 'Отзыв 2',
            'content' => 'Содержание отзыва 2.',
        ]);
        $client1->reviews()->create([
            'title'   => 'Отзыв 3',
            'content' => 'Содержание отзыва 3.',
        ]);

        $client2->reviews()->create([
            'title'   => 'Отзыв 1',
            'content' => 'Содержание отзыва 1.',
        ]);
        $client2->reviews()->create([
            'title'   => 'Отзыв 2',
            'content' => 'Содержание отзыва 2.',
        ]);
        $client2->reviews()->create([
            'title'   => 'Отзыв 3',
            'content' => 'Содержание отзыва 3.',
        ]);

        $client3->reviews()->create([
            'title'   => 'Отзыв 1',
            'content' => 'Содержание отзыва 1.',
        ]);
        $client3->reviews()->create([
            'title'   => 'Отзыв 2',
            'content' => 'Содержание отзыва 2.',
        ]);
        $client3->reviews()->create([
            'title'   => 'Отзыв 3',
            'content' => 'Содержание отзыва 3.',
        ]);

        // ---------------------------------------------------------------------------
        // Отношение один к многим полиморф (One To Many (Polymorphic)) - конец
        // ---------------------------------------------------------------------------

        dd('Клиенты готовы');
    }
}
