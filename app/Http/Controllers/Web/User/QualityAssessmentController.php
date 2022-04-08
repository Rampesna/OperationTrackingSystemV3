<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class QualityAssessmentController extends Controller
{
    public function index()
    {
        return view('user.modules.qualityAssessment.index.index');
    }
}
