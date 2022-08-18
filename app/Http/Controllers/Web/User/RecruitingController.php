<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

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
}
