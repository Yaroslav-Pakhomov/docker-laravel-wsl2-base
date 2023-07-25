<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * @return string
     */
    public function index(): string
    {
        $workers = Worker::all();
        foreach ($workers as $worker) {
            dump($worker->name);
            dump($worker->surname);
            echo '<br>';
        }
        // dd($workers);
        return 'Workers index route controller.';
    }

    /**
     * @return string
     */
    public function show(): string
    {
        $worker = Worker::query()->find(3);
        dump($worker->toArray());
        return 'Worker show route controller.';
    }

    /**
     * @return string
     */
    public function create(): string
    {
        $worker = [
            'name' => 'Petr',
            'surname' => 'Petrov',
            'email' => 'petrov@mail.ru',
            'age' => 30,
            'description' => 'I am Petr.',
            'is_married' => false,
        ];

        Worker::query()->create($worker);

        return 'Worker Petr was created.';
    }

    /**
     * @return string
     */
    public function update(): string
    {
        $worker = Worker::query()->find(4);

        $worker->update([
            'name' => 'Semen',
            'surname' => 'Semenov',
            'email' => 'semenov@mail.ru',
            'age' => 40,
            'description' => 'I am Semen.',
            'is_married' => true,
        ]);

        // $worker->name = 'Anton';
        // $worker->save();

        return 'Worker ' . $worker->name . ' update route controller.';
    }

    /**
     * @return string
     */
    public function delete(): string
    {
        $worker = Worker::query()->find(2);
        $worker->delete();

        return 'Worker ' . $worker->name . ' was deleted.';
    }
}
