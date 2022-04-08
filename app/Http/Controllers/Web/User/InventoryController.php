<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function index()
    {
        return view('user.modules.inventory.index.index');
    }
}
