<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Worker\WorkerRequest;
use App\Http\Resources\WorkerResource;
use App\Models\Worker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WorkerController extends Controller
{
    /**
     * @return AnonymousResourceCollection|JsonResponse|array
     */
    public function index(): AnonymousResourceCollection|JsonResponse|array
    {
        $workers = Worker::all();

        // ->resolve() - избавляемся от слова 'data'
        return WorkerResource::collection($workers);

        // // $workers = Worker::query()->limit(2)->get();
        // $data = [
        //     'workers' => $workers,
        // ];
        //
        // return response()->json($data);
    }

    /**
     * @param Worker $worker
     *
     * @return WorkerResource|array
     */
    public function show(Worker $worker): WorkerResource|array
    {
        // ->resolve() - избавляемся от слова 'data'
        return WorkerResource::make($worker)->resolve();
        // 2-ой способ new WorkerResource($worker) - лучше использовать 1-ый
    }

    /**
     * @param WorkerRequest $request
     *
     * @return WorkerResource|array
     */
    public function store(WorkerRequest $request): WorkerResource|array
    {
        // dd($request->validated());

        $data = $request->validated();
        $data['is_married'] = !empty($data['is_married']);
        $worker = Worker::query()->create($data);

        // ->resolve() - избавляемся от слова 'data'
        return WorkerResource::make($worker)->resolve();
    }

    /**
     * @param WorkerRequest $request
     * @param Worker $worker
     *
     * @return WorkerResource|array
     */
    public function update(WorkerRequest $request, Worker $worker): WorkerResource|array
    {
        // return WorkerResource::make($worker)->resolve();
        // dd($worker);
        // dd($request->validated());

        $data = $request->validated();
        $data['is_married'] = !empty($data['is_married']);
        $worker->update($data);
        $worker->fresh();

        // ->resolve() - избавляемся от слова 'data'
        return WorkerResource::make($worker)->resolve();
    }

    /**
     * @param Worker $worker
     *
     * @return JsonResponse
     */
    public function delete(Worker $worker): JsonResponse
    {
        // dd($worker->toArray());
        $worker->delete();

        return response()->json([
            'message' => 'Работник успешно удалён',
        ]);
    }
}
