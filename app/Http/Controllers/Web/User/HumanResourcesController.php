<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class HumanResourcesController extends Controller
{
    public function index()
    {
        return view('user.modules.humanResources.index.index');
    }
}
