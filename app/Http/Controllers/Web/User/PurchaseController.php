<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    public function index()
    {
        return view('user.modules.purchase.index.index');
    }

    public function purchase()
    {
        return view('user.modules.purchase.purchase.index');
    }

    public function report()
    {
        return view('user.modules.purchase.report.index');
    }
}
