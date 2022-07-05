<?php

namespace App\Http\Controllers\Web\Market;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('market.modules.dashboard.index.index');
    }
}
