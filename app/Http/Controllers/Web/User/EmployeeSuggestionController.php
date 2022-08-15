<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class EmployeeSuggestionController extends Controller
{
    public function index()
    {
        return view('user.modules.employeeSuggestion.index.index');
    }
}
