<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class AssignmentController extends Controller
{
    public function index()
    {
        return view('user.modules.assignment.index.index');
    }
}
