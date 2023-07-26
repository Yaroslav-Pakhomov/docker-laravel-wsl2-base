<?php

namespace App\Http\Controllers;

use App\Http\Requests\Worker\StoreRequest;
use App\Http\Requests\Worker\UpdateRequest;
use App\Models\Worker;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;

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
     * @param Worker $worker
     * @return View
     */
    public function edit(Worker $worker): View
    {
        return view('worker.edit', compact('worker'));
    }

    /**
     * @param UpdateRequest $request
     * @param Worker $worker
     *
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Worker $worker): RedirectResponse
    {
        $data = $request->validated();
        $data['is_married'] = !empty($data['is_married']);
        $worker->update($data);

        return redirect()->route('workers.show', $worker);
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
