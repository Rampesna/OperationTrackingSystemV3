<?php

namespace App\Http\Controllers\Web\User\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index(Request $request)
    {
        return view('user.modules.employee.info.index.index', [
            'employeeId' => $request->id
        ]);
    }
}
