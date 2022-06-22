<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class CompetenceController extends Controller
{
    public function index()
    {
        return view('user.modules.competence.index.index');
    }
}
