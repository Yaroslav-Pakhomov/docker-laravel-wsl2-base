<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Worker\WorkerRequest;
use App\Models\Worker;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
     * @param WorkerRequest $request
     *
     * @return RedirectResponse
     */
    public function store(WorkerRequest $request): RedirectResponse
    {
        $worker = $request->validated();
        $worker['is_married'] = !empty($worker['is_married']);
        Worker::query()->create($worker);

        return redirect()->route('workers.index')->with('success', 'Новый работник успешно создан');
    }

    /**
     * @param Worker $worker
     *
     * @return View
     */
    public function edit(Worker $worker): View
    {
        return view('worker.edit', compact('worker'));
    }

    /**
     * @param WorkerRequest $request
     * @param Worker $worker
     *
     * @return RedirectResponse
     */
    public function update(WorkerRequest $request, Worker $worker): RedirectResponse
    {
        $data = $request->validated();
        $data['is_married'] = !empty($data['is_married']);
        $worker->update($data);

        return redirect()->route('workers.show', $worker)->with('success', 'Работник успешно обновлён');
    }

    /**
     * @param Worker $worker
     *
     * @return RedirectResponse
     */
    public function delete(Worker $worker): RedirectResponse
    {
        $worker->delete();
        return redirect()->route('workers.index')->with('success', 'Работник успешно удалён');
    }
}
