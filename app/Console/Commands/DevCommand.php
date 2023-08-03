<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Position;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectWorker;
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
        // $this->prepareManyToMany();

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

        // Получаем проект
        $project = Project::query()->find(2);

        // Находим работников проекта
        if (isset($project->workers)) {
            dd($project->workers->toArray());
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
            'title'       => 'Научный сотрудник',
            'description' => 'Описание должности научного сотрудника',
        ];
        $positionData2 = [
            'title'       => 'Ведущий науный сотрудник',
            'description' => 'Описание должности ведущий научного сотрудника',
        ];
        $positionData3 = [
            'title'       => 'Заведующий лаборатории',
            'description' => 'Описание должности заведующего лаборатории',
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
        $workerData4 = [
            'name'        => 'Иван',
            'surname'     => 'Иванов',
            'email'       => 'ivanov@mail.ru',
            'age'         => 45,
            'description' => 'Я Иван Иванов.',
            'is_married'  => TRUE,
            'position_id' => $position2->id,
        ];
        $workerData5 = [
            'name'        => 'Петр',
            'surname'     => 'Петров',
            'email'       => 'petrov@mail.ru',
            'age'         => 55,
            'description' => 'Я Петр Петров.',
            'is_married'  => TRUE,
            'position_id' => $position3->id,
        ];
        $workerData6 = [
            'name'        => 'Сидор',
            'surname'     => 'Сидоров',
            'email'       => 'sidorov@mail.ru',
            'age'         => 65,
            'description' => 'Я Семен Семенов.',
            'is_married'  => TRUE,
            'position_id' => $position2->id,
        ];

        $worker1 = Worker::query()->create($workerData1);
        $worker2 = Worker::query()->create($workerData2);
        $worker3 = Worker::query()->create($workerData3);
        $worker4 = Worker::query()->create($workerData4);
        $worker5 = Worker::query()->create($workerData5);
        $worker6 = Worker::query()->create($workerData6);
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

        $profile1 = Profile::query()->create($profileData1);
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
        dd($profile6->city);
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

        // Проект 1
        $projectWorkerData1_1 = [
            'project_id' => $project1->id,
            'worker_id'  => $workerResearcher1->id,
        ];
        $projectWorkerData1_2 = [
            'project_id' => $project1->id,
            'worker_id'  => $workerResearcher2->id,
        ];
        $projectWorkerData1_3 = [
            'project_id' => $project1->id,
            'worker_id'  => $workerLeadingResearcher1->id,
        ];
        $projectWorkerData1_4 = [
            'project_id' => $project1->id,
            'worker_id'  => $workerLaboratoryHead->id,
        ];

        // Проект 2
        $projectWorkerData2_1 = [
            'project_id' => $project2->id,
            'worker_id'  => $workerResearcher2->id,
        ];
        $projectWorkerData2_2 = [
            'project_id' => $project2->id,
            'worker_id'  => $workerResearcher3->id,
        ];
        $projectWorkerData2_3 = [
            'project_id' => $project2->id,
            'worker_id'  => $workerLeadingResearcher2->id,
        ];
        $projectWorkerData2_4 = [
            'project_id' => $project2->id,
            'worker_id'  => $workerLaboratoryHead->id,
        ];

        // Проект 2
        $projectWorkerData3_1 = [
            'project_id' => $project3->id,
            'worker_id'  => $workerResearcher1->id,
        ];
        $projectWorkerData3_2 = [
            'project_id' => $project3->id,
            'worker_id'  => $workerResearcher3->id,
        ];
        $projectWorkerData3_3 = [
            'project_id' => $project3->id,
            'worker_id'  => $workerLeadingResearcher1->id,
        ];
        $projectWorkerData3_4 = [
            'project_id' => $project3->id,
            'worker_id'  => $workerLaboratoryHead->id,
        ];

        // Проект 1 запись в БД
        $projectWorker1_1 = ProjectWorker::query()->create($projectWorkerData1_1);
        $projectWorker1_2 = ProjectWorker::query()->create($projectWorkerData1_2);
        $projectWorker1_3 = ProjectWorker::query()->create($projectWorkerData1_3);
        $projectWorker1_4 = ProjectWorker::query()->create($projectWorkerData1_4);

        // Проект 2 запись в БД
        $projectWorker2_1 = ProjectWorker::query()->create($projectWorkerData2_1);
        $projectWorker2_2 = ProjectWorker::query()->create($projectWorkerData2_2);
        $projectWorker2_3 = ProjectWorker::query()->create($projectWorkerData2_3);
        $projectWorker2_4 = ProjectWorker::query()->create($projectWorkerData2_4);

        // Проект 3 запись в БД
        $projectWorker3_1 = ProjectWorker::query()->create($projectWorkerData3_1);
        $projectWorker3_2 = ProjectWorker::query()->create($projectWorkerData3_2);
        $projectWorker3_3 = ProjectWorker::query()->create($projectWorkerData3_3);
        $projectWorker3_4 = ProjectWorker::query()->create($projectWorkerData3_4);

        dd('Загружено');
    }
}