<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class MeetingController extends Controller
{
    public function index()
    {
        return view('user.modules.meeting.index.index');
    }
}
