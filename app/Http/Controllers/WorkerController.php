<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Filters\Var1\WorkerFilter as WorkerFilterVar1;
use App\Http\Requests\Worker\WorkerRequest;
use App\Models\Worker;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class WorkerController extends Controller
{
    /**
     * @param WorkerRequest $request
     *
     * @return View
     */
    public function index(WorkerRequest $request): View
    {
        $data = $request->validated();
        $workerQuery = Worker::query();

        $workerFilter1 = new WorkerFilterVar1($data);
        $workerFilter1->getFilters($workerQuery);

        $workers = $workerQuery->paginate(2);

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
     * @throws AuthorizationException
     */
    public function create(): View
    {
        // Проверка App\Policies\WorkerPolicy у пользователя
        $this->authorize('create', Worker::class);

        return view('worker.create');
    }

    /**
     * @param WorkerRequest $request
     *
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function store(WorkerRequest $request): RedirectResponse|Response
    {
        // Проверка App\Policies\WorkerPolicy у пользователя
        $this->authorize('create', Worker::class);

        $worker = $request->validated();
        $worker['is_married'] = !empty($worker['is_married']);
        Worker::query()->create($worker);

        return redirect()->route('workers.index')->with('success', 'Новый работник успешно создан');
    }

    /**
     * @param Worker $worker
     *
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Worker $worker): View
    {
        // Проверка App\Policies\WorkerPolicy у пользователя
        $this->authorize('update', $worker);

        return view('worker.edit', compact('worker'));
    }

    /**
     * @param WorkerRequest $request
     * @param Worker $worker
     *
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(WorkerRequest $request, Worker $worker): RedirectResponse
    {
        // Проверка App\Policies\WorkerPolicy у пользователя
        $this->authorize('update', $worker);

        $data = $request->validated();
        $data['is_married'] = !empty($data['is_married']);
        $worker->update($data);

        return redirect()->route('workers.show', $worker)->with('success', 'Работник успешно обновлён');
    }

    /**
     * @param Worker $worker
     *
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function delete(Worker $worker): RedirectResponse
    {
        // Проверка App\Policies\WorkerPolicy у пользователя
        $this->authorize('delete', $worker);

        $worker->delete();
        return redirect()->route('workers.index')->with('success', 'Работник успешно удалён');
    }
}
