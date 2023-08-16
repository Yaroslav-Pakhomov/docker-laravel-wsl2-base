<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkerResource;
use App\Models\Worker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WorkerController extends Controller
{
    /**
     * @return AnonymousResourceCollection|JsonResponse
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
}
