<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return view('user.modules.exam.index.index');
    }

    public function employee(Request $request)
    {
        if (!$request->examId) {
            abort(404);
        } else {
            return view('user.modules.exam.employee.index', [
                'examId' => $request->examId
            ]);
        }
    }
}
