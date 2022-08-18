<?php

namespace App\Http\Controllers\Web\User\SalesAndMarketing;

use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    public function index()
    {
        return view('user.modules.salesAndMarketing.modules.seller.index');
    }

    public function batchSeller()
    {
        return view('user.modules.salesAndMarketing.modules.batchSeller.index');
    }
}
