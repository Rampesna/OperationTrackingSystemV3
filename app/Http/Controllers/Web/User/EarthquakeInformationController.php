<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class EarthquakeInformationController extends Controller
{
    public function index()
    {
        return view('user.modules.earthquakeInformation.index.index');
    }
}
