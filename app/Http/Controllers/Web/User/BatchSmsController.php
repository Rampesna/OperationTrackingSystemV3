<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class BatchSmsController extends Controller
{
    public function index()
    {
        return view('user.modules.batchSms.index.index');
    }
}
