<?php

namespace App\Http\Controllers\Web\User\SalesAndMarketing;

use App\Http\Controllers\Controller;

class OpponentController extends Controller
{
    public function index()
    {
        return view('user.modules.salesAndMarketing.modules.opponent.index');
    }
}
