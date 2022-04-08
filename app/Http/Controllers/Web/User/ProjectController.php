<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        return view('user.modules.project.index.index');
    }
}
