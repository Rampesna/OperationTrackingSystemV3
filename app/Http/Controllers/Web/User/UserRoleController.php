<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class UserRoleController extends Controller
{
    public function index()
    {
        return view('user.modules.userRole.index.index');
    }
}
