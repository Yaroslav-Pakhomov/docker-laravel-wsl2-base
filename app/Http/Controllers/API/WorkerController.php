<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\JsonResponse;

class WorkerController extends Controller
{
    public function index(): JsonResponse
    {
        $workers = Worker::all();
        // $workers = Worker::query()->limit(2)->get();
        $data = [
            'workers' => $workers,
        ];

        return response()->json($data);
    }
}
