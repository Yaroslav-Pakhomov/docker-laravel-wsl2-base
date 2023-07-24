<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * @return string
     */
    public function index(): string
    {
        return 'Workers index route controller.';
    }

    /**
     * @return string
     */
    public function show(): string
    {
        return 'Worker show route controller.';
    }
}
