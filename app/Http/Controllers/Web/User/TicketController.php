<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index()
    {
        return view('user.modules.ticket.index.index');
    }
}
