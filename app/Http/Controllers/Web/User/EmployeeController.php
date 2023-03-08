<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('user.modules.employee.index.index');
    }

    public function specialInformation(Request $request)
    {
        return view('user.modules.employee.specialInformation.index.index', [
            'employeeId' => $request->id,
        ]);
    }

    public function skillInventory(Request $request)
    {
        return view('user.modules.employee.skillInventory.index.index', [
            'employeeId' => $request->id,
        ]);
    }
}
