<?php

namespace App\Http\Controllers\Web\User\HumanResources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('user.modules.humanResources.employee.index.index');
    }

    public function personalInformation(Request $request)
    {
        if (!$request->id) {
            abort(404);
        } else {
            return view('user.modules.humanResources.employee.personalInformation.index', [
                'id' => $request->id
            ]);
        }
    }

    public function position(Request $request)
    {
        if (!$request->id) {
            abort(404);
        } else {
            return view('user.modules.humanResources.employee.position.index', [
                'id' => $request->id
            ]);
        }
    }

    public function permit(Request $request)
    {
        if (!$request->id) {
            abort(404);
        } else {
            return view('user.modules.humanResources.employee.permit.index', [
                'id' => $request->id
            ]);
        }
    }

    public function overtime(Request $request)
    {
        if (!$request->id) {
            abort(404);
        } else {
            return view('user.modules.humanResources.employee.overtime.index', [
                'id' => $request->id
            ]);
        }
    }

    public function payment(Request $request)
    {
        if (!$request->id) {
            abort(404);
        } else {
            return view('user.modules.humanResources.employee.payment.index', [
                'id' => $request->id
            ]);
        }
    }

    public function device(Request $request)
    {
        if (!$request->id) {
            abort(404);
        } else {
            return view('user.modules.humanResources.employee.device.index', [
                'id' => $request->id
            ]);
        }
    }

    public function file(Request $request)
    {
        if (!$request->id) {
            abort(404);
        } else {
            return view('user.modules.humanResources.employee.file.index', [
                'id' => $request->id
            ]);
        }
    }

    public function shift(Request $request)
    {
        if (!$request->id) {
            abort(404);
        } else {
            return view('user.modules.humanResources.employee.shift.index', [
                'id' => $request->id
            ]);
        }
    }

    public function punishment(Request $request)
    {
        if (!$request->id) {
            abort(404);
        } else {
            return view('user.modules.humanResources.employee.punishment.index', [
                'id' => $request->id
            ]);
        }
    }
}
