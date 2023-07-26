<?php

namespace App\Http\Controllers;

use App\Http\Requests\Worker\StoreRequest;
use App\Models\Worker;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $workers = Worker::all();

        return view('worker.index', compact('workers'));
    }

    /**
     * @param Worker $worker
     *
     * @return View
     */
    public function show(Worker $worker): View
    {
        return view('worker.show', compact('worker'));
    }


    /**
     * @return View
     */
    public function create(): View
    {

        return view('worker.create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $worker = $request->validated();
        $worker['is_married'] = !empty($worker['is_married']);
        Worker::query()->create($worker);

        return redirect()->route('workers.index');
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
