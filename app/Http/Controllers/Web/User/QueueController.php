<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class QueueController extends Controller
{
    public function index()
    {
        return view('user.modules.queue.index.index');
    }
}
