<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function index()
    {
        return view('user.modules.inventory.index.index');
    }

    public function employee()
    {
        return view('user.modules.inventory.employee.index');
    }

    public function device()
    {
        return view('user.modules.inventory.device.index');
    }

    public function package()
    {
        return view('user.modules.inventory.package.index');
    }
}
