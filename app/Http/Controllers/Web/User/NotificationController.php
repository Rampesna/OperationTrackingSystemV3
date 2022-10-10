<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        return view('user.modules.notification.index.index');
    }
}
