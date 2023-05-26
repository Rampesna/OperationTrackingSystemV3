<?php

namespace App\Http\Controllers\Web\User\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function stats(Request $request)
    {
        return view('user.modules.employee.info.stats.index', [
            'employeeId' => $request->id
        ]);
    }
}
