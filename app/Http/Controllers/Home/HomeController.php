<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IBoardService;
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

    public function test(IBoardService $boardService)
    {
        $result = $boardService->getAll();
        return $result->getIsSuccess() ?
            $this->success(
                $result->getMessage(),
                $result->getData(),
                $result->getStatusCode()
            ) : $this->error(
                $result->getMessage(),
                $result->getData()
            );
    }
}
