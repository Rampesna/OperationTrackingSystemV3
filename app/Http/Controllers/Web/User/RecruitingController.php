<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecruitingController extends Controller
{
    public function index()
    {
        return view('user.modules.recruiting.index.index');
    }

    public function recruiting()
    {
        return view('user.modules.recruiting.recruiting.index');
    }

    public function recruitingStep()
    {
        return view('user.modules.recruiting.recruitingStep.index');
    }

    public function evaluationParameter()
    {
        return view('user.modules.recruiting.evaluationParameter.index');
    }

    public function wizard(Request $request)
    {
        if (!$request->id) {
            abort(404);
        } else {
            return view('user.modules.recruiting.wizard.index', [
                'id' => $request->id,
            ]);
        }
    }
}
