<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index()
    {
        return view('user.modules.meeting.index.index');
    }

    public function meetingAgenda()
    {
        return view('user.modules.meeting.meetingAgenda.index');
    }

    public function agenda(Request $request)
    {
        if ($request->meetingId) {
            return view('user.modules.meeting.agenda.index', [
                'meetingId' => $request->meetingId
            ]);
        } else {
            abort(404);
        }
    }
}
