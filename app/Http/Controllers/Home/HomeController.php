<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Eloquent\JobDepartment;
use App\Models\Eloquent\SaturdayPermit;
use App\Models\Eloquent\Ticket;
use App\Models\Eloquent\User;
use App\Services\AwsS3\StorageService;
use Aws\S3\S3Client;
use App\Models\Eloquent\Device;
use App\Models\Eloquent\DevicePackage;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\EmployeePersonalInformation;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
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

    public function testaaa(Request $request)
    {
        return 'No Way';
    }

    public function test2(Request $request)
    {

    }

    public function test3(Request $request)
    {

    }

    function searchByValue($array, $key, $value)
    {
        foreach ($array ?? [] as $index => $data) {
            if ($data->$key == $value) {
                return $index;
            }
        }
        return -1;
    }

    // REGEX

    public function test()
    {
        $key = 'excelTemplates/abc/aaa/sss/jobs.xlsx';
        $parsed = explode('/', $key);
        return end($parsed);
        // https://suchen.mobile.de/fahrzeuge/search.html?dam=0&isSearchRequest=true&ref=quickSearch&sb=rel&vc=Car
//        $client = new Client;
//        $response = $client->get('https://suchen.mobile.de/fahrzeuge/search.html?dam=0&isSearchRequest=true&ref=quickSearch&sb=rel&vc=Car', [
//            'headers' => [
//                'Accept' => 'application/json',
//                'Accept-Encoding' => 'gzip, deflate, br',
//                'Accept-Language' => 'tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
//                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Safari/537.36 OPR/89.0.4447.64',
//                'Referer' => 'https://suchen.mobile.de/fahrzeuge/search.html?dam=0&isSearchRequest=true&ref=quickSearch&sb=rel&vc=Car',
//                'Cookie' => 'vi=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjaWQiOiJhZTkwODQ5Ni1jMmZlLTRkZjUtOThlMC01MzM2NjhhODZjMGUiLCJpYXQiOjE2NTkzODg1OTF9.cMUCheFuNcWNnDCe_cej36kltiCkamBuLbsd4UTC0Ys; mdeConsentDataGoogle=1; mdeConsentData=CPdEprXPdEprXEyAHADECaCgAP_AAELAAAYgI7Nd_X__bX9n-_7_6ft0eY1f9_r37uQzDhfNs-8F3L_W_LwX32E7NF36tq4KmR4ku1bBIQNtHMnUDUmxaolVrzHsak2cpyNKJ_JkknsZe2dYGF9Pn9tj-YKZ7_5_9_f52T_9_9_-39z3_9f___dv_-___vjf_599n_v9fV_78_Kf9_7____-____________8C84A4ACgAQAA0ACKAEwALYC8wCQkA8ABYAFQAMgAcABEADwAIgATwAqgDDAH6AkQBkgDJwGXBoAoATAAuAHVASIAycRAEACYAdUBIgDJxUAMAJgAXAF5jIAQATAF5joCgACwAKgAZAA4ACIAHgAPgAiABPACqAFwAMQAmABhgD9AIsAkQBkgDJwGXEIBIACwAMgAiACYAFUALgAYgEiAMnJQCwAFgAZAA4ACIAHgARAAqgBcADEAkQBk5SAiAAsACoAGQAOAAiAB4AEQAJ4AUgAqgBiAH6ARYBIgDJAGTgMuA.YAAAAAAAD4AAAKcAAAAA; _ga=GA1.2.1723716003.1659388590; iom_consent=0103ff03ff&1659388750961; mobile.LOCALE=de; bm_sz=515B1EB5CE951D15B4C478C3E640E631~YAAQXltgaJxdAa2CAQAAFK0KrRBAaoItn7zi11cCf15K1LmKS1+VfRf/HnM2HZBDLxKRrHhj9CO11HDgsI3hmmd52D/1CaIjUMFbUZA1DeWwk3ywtsu9dZQt7Sl9YErQYdinwm44fQTw8vyu6sgiSwoUYMwIdPKllYe7iUmCXcbCAD1tkeXzVUzHc0Yt9fqHRZSR0nUDvYHcBuBKDyObD5zLT7u9VYp6qSZRpUcXSEdZU0V5O7NZnq7wcFFV+l0NjxTutLBbQZNFMUkiCi9zuEIGdoQIi/adLiAOtdXKTji1Uw==~3556678~4404531; ces=greenMob1; POPUPCHECK=1660846936554; _pbjs_userid_consent_data=3295364265010004; _pubcid=cb984448-0b71-480b-9487-58e5edbacfa7; _gid=GA1.2.1596324127.1660760537; hsstp=1; ak_bmsc=E5A97BEDE99F322283AA2794D44A9019~000000000000000000000000000000~YAAQ1nEGF38PaaeCAQAAxRMNrRDpC21nMplU8gTTBvHDQ74Nij+2gA2rO1NooUQLlzEEUsKacPJak6N/kTKDyr4cfgZUYEtMAJxZc+yETdnfl5zu9yIZNZHQat465iY8j6oOHjsp2yjSlzm3TkB5v3vvw/Hm0xxr/NUmslvyI6quWUdcCqvDH9GFT+IHM19QEsVuRXLTqW3wxZOSKZKmdrHVviJj2B4qzU19u0Cp1TgtLM4gmQJ8UEjwMZP6cotBaLWDYR3Il4rH24Wjp1D8IQuS7HqyB25EV4C5rnBk9uvgCYjZTExn7SYOu15gQmTBakEHxBgxid76YqZRU3thzOSMrroGpf7jf/6ofckgbNJJSE4T/WrAKdh6qL1xZMXLWmrWqcPQ9PEkoYJV2+f5K8DcfK8DCVZ9Squ1TYqMZ1MHKtCa2nhXPEx6dldzAKY4lBBrMgT6ZIskSlYtib48vY4INy5/Tk+uLMVP2u6x5hAA9MVTCXMID5B8+f8o5WsuJgCb3FERfuQn58IaGkKxCerrEPkFecHQoKbKUEc=; _abck=C32D799A32AB367C59DF6732EF094B31~0~YAAQRXEGF3oQo3yCAQAA2iANrQiJ8LbFEjNpvroQ03g7+p5xgISEG1ftCph8cIYbPDPw4Hk214X9GNaifhh06gWlD636PTgLAlho9jNmoeIi79305uQSEVDkLAmShlawq1voPu0I8bamvxlnmP9qFQtCyS1s9k0fxVK/Yv+lbhyPc9QPXUcVBy6gadTx0TLPcicaftLi1swu6PGgate7gdBVkAmOLQGNjbAoZfMIpFMp8EfiYib059ow56JAbO1Q+V8e+i64YFHxG7rBdgvcg/c1weV0GGPzcou0KQ4vHbIUy8hkJTfVk8tBEAsxqpNFpTVPnhxjNdv5tpN4FYOqzKsaSkdcPyeFOWy/OfLQ7FuurFOEANWTR/jdxZb0uBUpZy1+o/h0o635gEgUarZwhBCstas=~-1~-1~-1; ioam2018=001332052bb7646c262e8434f:1687814350966:1659388750966:.mobile.de:7:mobile:DE/DE/OB/S/P/S/G:noevent:1660760696054:y2antm; bm_sv=EF6D9D604B3D35F056E36513770D47FE~YAAQ1nEGF6EYaaeCAQAAa24NrRDlxmWjfxRW1hYz2c2Mf68B72cwp5SMaKwGXc3WRDwjX+IOZtUNeE8hOZwgbtBOmKC+vqn9ZM4CglbU8bmpn4jmpfDp7L2bU/IUDdM7xoGwmVtaUUyfd1lX3so4XXH9+iK3Qs17E8taf92HBu2U408c7JPtMYDM6LSLn9Cp6SeaJIigc0jxMOL704uyCvFks2ZNb9RKsabl5tt0j88ycjcKsAmOKdEauqIuBMrY~1'
//            ],
//        ]);
//
//        return $result = $response->getBody()->getContents();
//
//        $clean1 = str_replace(["\n", "\t", "\r", "  "], null, $result);
//        $clean2 = str_replace(["&quot;"], null, $clean1);
//        $clean3 = preg_replace('~{(.*?)}~', null, $clean2);
//        $cleanResult = preg_replace('~{(.*?)}~', null, $clean3);
//        preg_match('~<div class="cBox cBox--content cBox--resultList ">(.*?)<div data-srp-private-selling-teaser class="force-medium">~', $cleanResult, $list);
//        preg_match_all('~<div class="cBox-body cBox-body--resultitem" data-testid="no-top">(.*?)</a>~', $list[1], $dataList);
//
//        $cars = $dataList[1];
//
//        $myResponseObject = [];
//
//        foreach ($cars as $carString) {
//            preg_match('~<span class="h3 u-text-break-word">(.*?)</span>~', $carString, $carName);
//            $myResponseObject[] = [
//                'carName' => $carName[1],
//            ];
//        }
//
//        return response()->json($myResponseObject);
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
