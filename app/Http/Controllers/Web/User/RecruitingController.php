<?php

namespace App\Http\Controllers\Web\User;

use App\Exports\RecruitingsExport;
use App\Http\Controllers\Controller;
use App\Models\Eloquent\Recruiting;
use Maatwebsite\Excel\Facades\Excel;
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

    public function download(Request $request)
    {
        $companyIds = $request->companyIds ? explode(',', $request->companyIds) : [];
        $keyword = $request->keyword;
        $stepIds = $request->stepIds ? explode(',', $request->stepIds) : [];

        $recruitings = Recruiting::with([
            'company',
            'department',
            'step',
        ])->orderBy('id', 'desc')->whereIn('company_id', $companyIds);

        if ($keyword) {
            $recruitings->where(function ($recruitings) use ($keyword) {
                $recruitings->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhere('phone_number', 'like', '%' . $keyword . '%')
                    ->orWhere('identity', 'like', '%' . $keyword . '%');
            });
        }

        if ($stepIds) {
            $recruitings->whereIn('step_id', $stepIds);
        }

        return Excel::download(new RecruitingsExport($recruitings->get()), 'İşe Alım Listesi.xlsx');
    }
}
