<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class SalesAndMarketingController extends Controller
{
    public function index()
    {
        return view('user.modules.salesAndMarketing.index.index');
    }
}
