<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;
use App\Models\Eloquent\SocialEvent;

class SocialEventController extends Controller
{
    public function index()
    {
        $socialEvents = SocialEvent::with([
            'images'
        ])->orderBy('date', 'desc')->get();
        return view('employee.modules.socialEvent.index.index', [
            'socialEvents' => $socialEvents
        ]);
    }
}
