<?php

namespace App\Http\Controllers\Web\User\SalesAndMarketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SurveyReportController extends Controller
{
    public function general(Request $request)
    {
        return view('user.modules.salesAndMarketing.modules.survey.report.general.index', [
            'id' => $request->id,
            'code' => $request->code,
        ]);
    }

    public function detail(Request $request)
    {
        return view('user.modules.salesAndMarketing.modules.survey.report.detail.index', [
            'id' => $request->id,
            'code' => $request->code,
        ]);
    }

    public function employee(Request $request)
    {
        return view('user.modules.salesAndMarketing.modules.survey.report.employee.index', [
            'id' => $request->id,
            'code' => $request->code,
        ]);
    }
}
