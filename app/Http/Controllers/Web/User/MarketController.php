<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class MarketController extends Controller
{
    public function index()
    {
        return view('user.modules.market.index.index');
    }

    public function employee()
    {
        return view('user.modules.market.employee.index');
    }

    public function market()
    {
        return view('user.modules.market.market.index');
    }
}
