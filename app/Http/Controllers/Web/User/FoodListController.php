<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class FoodListController extends Controller
{
    public function index()
    {
        return view('user.modules.foodList.index.index');
    }

    public function foodList()
    {
        return view('user.modules.foodList.foodList.index');
    }

    public function report()
    {
        return view('user.modules.foodList.report.index');
    }
}
