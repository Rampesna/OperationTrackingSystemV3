<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Eloquent\Employee;
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

    public function test()
    {
        $fields['include_player_ids'] = Employee::where('device_token', '<>', null)->pluck('device_token')->toArray();
        $fields['name'] = 'OTS 2';
        $fields['contents'] = [
            'en' => 'Test notification',
            'tr' => 'Test notification',
        ];
        $notificationMsg = 'Hello!! A tiny web push notification.!';
        OneSignal::sendPush($fields, $notificationMsg);

        return OneSignal::getNotifications();
    }
}
