<?php

declare(strict_types=1);

namespace App\Http\Controllers;

// use App\Http\Filters\Var1\WorkerFilter as WorkerFilterVar1;
use App\Http\Filters\Var2\Worker\AgeFrom;
use App\Http\Filters\Var2\Worker\AgeTo;
use App\Http\Filters\Var2\Worker\Description;
use App\Http\Filters\Var2\Worker\Email;
use App\Http\Filters\Var2\Worker\IsMarried;
use App\Http\Filters\Var2\Worker\Name;
use App\Http\Filters\Var2\Worker\Surname;
use App\Http\Requests\Worker\WorkerRequest;
use App\Models\Worker;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pipeline\Pipeline;

class WorkerController extends Controller
{
    /**
     * @param WorkerRequest $request
     *
     * @return View
     * @throws BindingResolutionException
     */
    public function index(WorkerRequest $request): View
    {
        // --------------------------------------------------------------------------------
        // Шаблон Filter для запросов (первый вариант фильтра) - начало
        // --------------------------------------------------------------------------------

        // $data = $request->validated();

        // // Фильтрация данных

        // // 1-ый способ создания фильтра специально для Laravel
        // $workerFilter1 = new WorkerFilterVar1($data);

        // // 2-ой способ создания фильтра специально для Laravel
        // $workerFilter1 = app()->make(WorkerFilterVar1::class, [
        //     'params' => $data,
        // ]);
        // $workerQuery = Worker::filter($workerFilter1);

        // --------------------------------------------------------------------------------
        // Шаблон Filter для запросов (первый вариант фильтра) - конец
        // --------------------------------------------------------------------------------

        // --------------------------------------------------------------------------------
        // Шаблон Filter на основе класса Pipeline (второй вариант фильтра) - начало
        // --------------------------------------------------------------------------------

        $workerQuery = app()->make(Pipeline::class)
            ->send(Worker::query())
            ->through([
                Name::class,
                Surname::class,
                Email::class,
                AgeFrom::class,
                AgeTo::class,
                Description::class,
                IsMarried::class,
            ])
            ->thenReturn();

        // --------------------------------------------------------------------------------
        // Шаблон Filter на основе класса Pipeline (второй вариант фильтра) - конец
        // --------------------------------------------------------------------------------

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
