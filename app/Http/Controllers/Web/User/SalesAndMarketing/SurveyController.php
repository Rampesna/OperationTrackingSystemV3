<?php

namespace App\Http\Controllers\Web\User\SalesAndMarketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        return view('user.modules.salesAndMarketing.modules.survey.index.index');
    }

    public function create()
    {
        return view('user.modules.salesAndMarketing.modules.survey.create.index');
    }

    public function update(Request $request)
    {
        return view('user.modules.salesAndMarketing.modules.survey.update.index', [
            'scriptId' => $request->scriptId,
            'scriptCode' => $request->scriptCode,
        ]);
    }

    public function question(Request $request)
    {
        return view('user.modules.salesAndMarketing.modules.survey.question.index', [
            'id' => $request->id,
            'code' => $request->code,
        ]);
    }

    public function examine(Request $request)
    {
        return view('user.modules.salesAndMarketing.modules.survey.examine.index', [
            'id' => $request->id,
            'code' => $request->code,
        ]);
    }
}
