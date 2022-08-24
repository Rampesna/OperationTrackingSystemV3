<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Eloquent\JobDepartment;
use App\Models\Eloquent\SaturdayPermit;
use App\Models\Eloquent\Ticket;
use App\Models\Eloquent\User;
use App\Services\AwsS3\StorageService;
use App\Services\Gitlab\UserService;
use Aws\S3\S3Client;
use App\Models\Eloquent\Device;
use App\Models\Eloquent\DevicePackage;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\EmployeePersonalInformation;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
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
        $gitlabUserService = new UserService;
        return response()->json(
            $gitlabUserService->getAllUsers()->getData()
        );
    }

    public function oneSignalTest()
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
