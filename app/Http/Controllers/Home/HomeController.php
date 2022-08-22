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
        $gitlabUserService = new UserService;
        return response()->json(
            $gitlabUserService->getAllUsers()->getData()
        );
    }

    public function test123321123()
    {
        $client = new Client;
        $searchUrl = 'https://suchen.mobile.de/fahrzeuge/search.html?dam=0&isSearchRequest=true&ref=quickSearch&sb=rel&vc=Car';
        $brands = json_decode(file_get_contents(public_path('brands.json')));
//        return $brands;
        foreach ($brands as $brand) {
            try {
                foreach ($brand->models as $model) {
                    $carList = [];
                    for ($counter = 1; $counter <= 50; $counter++) {
                        $url = $searchUrl . '&pageNumber=' . $counter . '&ms=' . $brand->value . '%3B' . $model->value . '%3B%3B';
                        $response = $client->get($url, [
                            'headers' => [
                                'Accept' => 'application/json',
                                'Accept-Encoding' => 'gzip, deflate, br',
                                'Accept-Language' => 'tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
                                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Safari/537.36 OPR/89.0.4447.64',
                                'Referer' => 'https://suchen.mobile.de/fahrzeuge/search.html?dam=0&isSearchRequest=true&ref=quickSearch&sb=rel&vc=Car',
                                'Cookie' => 'optimizelyEndUserId=oeu1656155571651r0.023912667791742725; _tt_enable_cookie=1; _ttp=08ddbb00-d380-4eed-8e6e-d1d5a8854bcb; vi=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjaWQiOiJiNWQ2ZWU4OC01MGJiLTQ4ZGMtYWMzOS0zOGQ2ODk5ZTQxZmQiLCJpYXQiOjE2NTYxNTU1NzV9.rcpf5Q0602Vxs6NhwvKUGKlXQsz6fX1zsddEUORiHUY; mdeConsentDataGoogle=1; mdeConsentData=CPbJUkpPbJUkpEyAHADECVCgAP_AAELAAAYgI3Nd_X__bX9n-_7_6ft0eY1f9_r37uQzDhfFs-8F3L_W_LwX32E7NF36tq4KmR4ku3bBIQNtHMnUTUmxaolVrzHsak2cpyNKJ7JkknsZe2dYGH9Pn9lD-YKZ7_5___f52T_9_9_-39z3_9f___d__-__-vjf_599n_v9fV_78_L________-___________wLzgDgAKABAADQAIoATAAtgLzAJCQEAAFgAVAAyABwAEQAMgAeABEACeAFUAYYA_QEiAMkAZOAy4NAFACYAFwA6oCRAGTiIAgATADqgJEAZOKgCABMAC4ApsBeYyAEAEwBeY6AqAAsACoAGQAOAAiABkADwAHwARAAngBVAC4AGIATAAwwB-gEWASIAyQBk4DLiEAkABYAGQARABMACqAFwAMQCRAGTkoBYACwAMgAcABEADwAIgAVQAuABiASIAycpASAAWABUADIAHAARAAyAB4AEQAJ4AUgAqgBiAH6ARYBIgDJAGTgMuA.YAAAAAAAD4AAAKcAAAAA; _gcl_au=1.1.2054213975.1656155576; _pbjs_userid_consent_data=8245490656587554; _pubcid=a78c86db-755b-406d-9817-aba16d8addd1; axd=4298032481539637571; __gsas=ID=53bddc4ee156c08b:T=1658396559:S=ALNI_MYSb-R5nw5xftt3t_kPWKnnJM8Xqg; _fbp=fb.1.1658396563064.2036532667; cto_axid=OfNacgFYxFqxDE_TfLekuuaN5ko5ryAl; iom_consent=0103ff03ff&1659424599942; POPUPCHECK=1661250007541; _gid=GA1.2.1835421943.1661163609; _clck=1kb5afw|1|f48|0; tis=EP117%3A3270; hsstp=1; mobile.LOCALE=en; ces=-; bm_sz=0FBC50B506C783701B093B2F5A87B6EC~YAAQG4QUAtaUS7aCAQAAvXouxRCEa0a8+8KGqIn2IXi4Co7WZ6SgAH78k+6TkBqLN7ruPzpGSWWbn97qEoZkM/m/b84tCMxWxvixplRKc8QbYJozQtTmRcX27JfOVq1rpgVwiY1jyvwdracuCLuPeP3l09wtM8uuJDxlqDHS14becnGZIgJWKLA/wMsB7S7gkFZO/7wgx8MVUpVPdQOvB26As3GJ4SNkcF/AYB3rguTR+ETw6PdpGpLnduuWyNe6doy34rnmuHUEzwpAavIbsa3pwsDIOQQv4Ae88yRYZs2gaSFSn+JHrzBanKOXjNjUDsWPqKerd9bgPA==~4604473~3356985; lux_uid=166116943362181337; bm_mi=B547EA28BA270E74C6A43F2ED7F1B9F6~YAAQ3XEGF3tfx5eCAQAALKKAxRBju13F/kFWhCZVSSC/C6UR3lqPwxKhoFPxBYDzlX1Dqz+IfjJHOwj6EIL3Q4gmQi3sUgKA7i4Lx/PUdGvLb7isgZqG8+t1sTRLbUylSdJs757zYBLPrylT1YJ3EjF8dwzOkZthL++SARhAnbQ/aaSCgeIRLumyIjHqxnIrhVeev3p6A3stJAsyz048uKV6fZpwngV17yoWDL70mKX2WAA0sdREK947Ae+J7tUpHYkkjvc2owkQ+XJfXnqoqb56KaNb3W9OARB2tTFQFgZts6F0o/qAW6GoTKig1JrY37Zb/3tI0WBiG2nNGoojbo0A~1; ak_bmsc=5DDAE9686C6399DA8FE222416DC328E7~000000000000000000000000000000~YAAQt6wVArb8QruCAQAA3kWJxRC++snsPK4U4xTxIH1ClAbqMxAI9kH226gO5SGB+jOTv4v+HBe2325/q8tCrmyELyssoQWBNM7ANpidfngVBYZXpCJKnn4Q/YWDlRmWrjyZQMkRwLeQM/oSFbUl81Lag59fVszyIyFyZN0KWEuuN82h32kTqiMxQO/F2djkK/3ELau0IvxS6xEnLwswtYymYW3UfDQedHqRYprA8jzgDLZC6BlmNI74t2JHZtJkG0nfOOdVmFA+DcJzAN+0pfFa1znCyTqaYlsMjw4w5VrLpjFM+CmzLxH6nC3UVkxdmf0/3NYBIk02a22infoqvLxw9Ki9hGDZxihwb8mlh6cLPKs5rrL1zU1QlfnHIkDP9o9ppaCeH5elSqOX3DtNPUpwJG0WChqKqvk8R3QNZr9ht2ZLQT0DYUDcq//2cCXtMRk9iSen/XmVqahJZ55o2EPm8YWw5PE1fyUDS2MlEendgdk/qg==; _gat_UA-3584729-32=1; ioam2018=001b8f8e42d0a770b62b6ee0e:1685531663752:1656155663752:.mobile.de:153:mobile:DE/EN/OB/S/P/S/G:noevent:1661173347084:y04zho; _abck=9BBE60CBF24F09C5C6208FE1EF0E94D8~0~YAAQt6wVAr+PR7uCAQAAx7GlxQiDNK0w81k0tUutgrs6SgblS9LS/n1GmvPcLRxB4Q9djNyOew9nFpwTnoUXv4NNYu8O3Tagdt4bJTXNg77vj+cm0wm5fnYJgrR0+wU3xtSp9O/jIN3cfayAe3ALn1nSW+89h7/3xhNw1aKYmYyeH8wKCKE+bdi/G0BZHnPPD7bLgGHqIWBOtEMV8yGjm50vg9HVB0fKoSwQ789/PztqaMX0MWM2vhViwvSviWHtRNgM8p6gtOAW9ouu7JaxTEGnr+BJm/osquBBz92Rg+a8NqMIwc2FdX5cvoALwz99XUPflKR9Wik4WreDfnRB6zUvqu4OI1zOmxaWlsB8UPWHdtb/UWwTisxq~-1~-1~-1; _ga_2H40T2VTNP=GS1.1.1661163609.7.1.1661173347.0.0.0; _ga=GA1.1.2003995425.1656155574; bm_sv=E7F1F61DF5A1249678A44CF238CA0801~YAAQt6wVAiqQR7uCAQAAsbOlxRAl4ltuIIvJ4RieuNiZBvUQ3CbiHwIotGbEzSI0es9aTiBl0aHZQNvtmwp9/+BVKuICsxfvjkUjkQC/sZxCJz6ZL88vrh6oeNShuBf0vB+m1XS6FH6YKvR9ITWJUHBtDumO0Xsr3pzC/mwfN7+aXZf9vATQt675VXbZbOOYDDE8RTbcazAVSAh2K/v2hxBujzcebBh+EjWcYAOhV4svlKxbSBndggAmOuM0F77h~1; _uetsid=ffe09730220311edaa88257238471df6; _uetvid=f8fec750f47711ecbde22df4657c2c73; outbrain_cid_fetch=true; _clsk=fbichx|1661173354276|25|1|d.clarity.ms/collect',
                            ],
                        ]);

                        $result = $response->getBody()->getContents();

                        $clean1 = str_replace(["\n", "\t", "\r", "  "], null, $result);
                        $clean2 = str_replace(["&quot;"], null, $clean1);
                        $clean3 = preg_replace('~{(.*?)}~', null, $clean2);
                        $cleanResult = preg_replace('~{(.*?)}~', null, $clean3);
                        preg_match('~<div class="cBox cBox--content cBox--resultList ">(.*?)<div data-srp-private-selling-teaser class="force-medium">~', $cleanResult, $list);
                        preg_match_all('~<div class="cBox-body cBox-body--resultitem" data-testid="no-top">(.*?)</a>~', $list[1], $dataList);

                        $cars = $dataList[1];

                        foreach ($cars as $carString) {
                            preg_match('~<span class="h3 u-text-break-word">(.*?)</span>~', $carString, $carName);
                            preg_match('~<a class="link--muted no--text--decoration result-item" href="(.*?)" data-listing-id~', $carString, $carUrl);
                            $carList[] = [
                                'carName' => $carName[1],
                                'carUrl' => $carUrl[1],
                            ];
                        }

                        sleep(10);
                    }
                    $model->carList = $carList;
                    return $brands;
                }
            } catch (\Exception $exception) {
                return $brands;
            }
            return $brands;
        }
        return $brands;
    }

    public function test444444()
    {

        // https://suchen.mobile.de/fahrzeuge/search.html?dam=0&isSearchRequest=true&ref=quickSearch&sb=rel&vc=Car
        // https://suchen.mobile.de/fahrzeuge/search.html?damageUnrepaired=NO_DAMAGE_UNREPAIRED&isSearchRequest=true&pageNumber=2&ref=srpNextPage&scopeId=C&sortOption.sortBy=relevance&refId=9a719d1a-f079-6320-2d93-d569b433f359
        $client = new Client;
        $response = $client->get('https://suchen.mobile.de/fahrzeuge/search.html?damageUnrepaired=NO_DAMAGE_UNREPAIRED&isSearchRequest=true&pageNumber=2&ref=srpNextPage&scopeId=C&sortOption.sortBy=relevance&refId=9a719d1a-f079-6320-2d93-d569b433f359', [
            'headers' => [
                'Accept' => 'application/json',
                'Accept-Encoding' => 'gzip, deflate, br',
                'Accept-Language' => 'tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Safari/537.36 OPR/89.0.4447.64',
                'Referer' => 'https://suchen.mobile.de/fahrzeuge/search.html?dam=0&isSearchRequest=true&ref=quickSearch&sb=rel&vc=Car',
                'Cookie' => 'optimizelyEndUserId=oeu1656155571651r0.023912667791742725; _tt_enable_cookie=1; _ttp=08ddbb00-d380-4eed-8e6e-d1d5a8854bcb; vi=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjaWQiOiJiNWQ2ZWU4OC01MGJiLTQ4ZGMtYWMzOS0zOGQ2ODk5ZTQxZmQiLCJpYXQiOjE2NTYxNTU1NzV9.rcpf5Q0602Vxs6NhwvKUGKlXQsz6fX1zsddEUORiHUY; mdeConsentDataGoogle=1; mdeConsentData=CPbJUkpPbJUkpEyAHADECVCgAP_AAELAAAYgI3Nd_X__bX9n-_7_6ft0eY1f9_r37uQzDhfFs-8F3L_W_LwX32E7NF36tq4KmR4ku3bBIQNtHMnUTUmxaolVrzHsak2cpyNKJ7JkknsZe2dYGH9Pn9lD-YKZ7_5___f52T_9_9_-39z3_9f___d__-__-vjf_599n_v9fV_78_L________-___________wLzgDgAKABAADQAIoATAAtgLzAJCQEAAFgAVAAyABwAEQAMgAeABEACeAFUAYYA_QEiAMkAZOAy4NAFACYAFwA6oCRAGTiIAgATADqgJEAZOKgCABMAC4ApsBeYyAEAEwBeY6AqAAsACoAGQAOAAiABkADwAHwARAAngBVAC4AGIATAAwwB-gEWASIAyQBk4DLiEAkABYAGQARABMACqAFwAMQCRAGTkoBYACwAMgAcABEADwAIgAVQAuABiASIAycpASAAWABUADIAHAARAAyAB4AEQAJ4AUgAqgBiAH6ARYBIgDJAGTgMuA.YAAAAAAAD4AAAKcAAAAA; _gcl_au=1.1.2054213975.1656155576; _pbjs_userid_consent_data=8245490656587554; _pubcid=a78c86db-755b-406d-9817-aba16d8addd1; axd=4298032481539637571; __gsas=ID=53bddc4ee156c08b:T=1658396559:S=ALNI_MYSb-R5nw5xftt3t_kPWKnnJM8Xqg; _fbp=fb.1.1658396563064.2036532667; cto_axid=OfNacgFYxFqxDE_TfLekuuaN5ko5ryAl; iom_consent=0103ff03ff&1659424599942; ces=cs; _clck=1kb5afw|1|f41|0; tis=EP117%3A3263; _uetvid=f8fec750f47711ecbde22df4657c2c73; ioam2018=001b8f8e42d0a770b62b6ee0e:1685531663752:1656155663752:.mobile.de:73:mobile:DE/EN/OB/S/P/S/G:noevent:1660549397663:3xi07v; _ga=GA1.2.2003995425.1656155574; _ga_2H40T2VTNP=GS1.1.1660548926.6.1.1660549410.0; _abck=9BBE60CBF24F09C5C6208FE1EF0E94D8~-1~YAAQ3XEGF0Y4npeCAQAAuZ9dxAgcMxKz9A40RkX4tzuY/zufAZ0Hp63wCQLw4s5OHoq/CLhtXCLR2Bw9tQTJhvXipXlC4r1QJUCGEk6WAi8R3ICFljYyyDvWXYgvG8WS7N32PjEqIS0BDqzD4j6mKwhtN+dPPQkCyTOy4XcUMAJW0r2lzT0eVuaSJgkNVbIRNfSN0AKbAoY8huOoHt6jTDO17O0NDZwEuwG8lHUC5AXEBk7LnbQGzeDU/2Io+Z8kWu0YbJExhybbUMyreumaegHxToDQH2v1G0kMcQMY7SSYd9F9Vp9z3b2qlAYhj3qXbtBygKqzLL7QYjJevmd0dKKnk5ZfPK+iiVo1M83wjTO7131v+7XF6STTSBhLLL6iavo8Qi4H9bxoOJPTYGLyU+pJtM1a~-1~-1~-1; bm_sz=EA602A551775E359B2863362F1752B34~YAAQ3XEGF0g4npeCAQAAuZ9dxBDyu0xHxfSg5W+0qC3QiSL13c0O8vGAz8GavPVC2qzqOrlWy9F0QVsjzFGMn9lVmxIX+06kDcqHBMUn6y/Bf/inhOf4vYR6ZB+3zd6e6NxcMXnz8Xzo3Yu3hUCLw4umxw2znSgWGd5SQmiM4yflSonCF/NRs7BK9LCilZGFKVgTv1SlMzoKHoKh+DJGobgacwxfPx+NHLCkH5Av5W8eJQpmx/I/ALo/GtRkLdEmuIW7UHtHfxj7FVZtc45AC1KvtACNxtq7xt+0FKeGNj16eQ==~3485764~4274489'
            ],
        ]);

        $result = $response->getBody()->getContents();

        $clean1 = str_replace(["\n", "\t", "\r", "  "], null, $result);
        $clean2 = str_replace(["&quot;"], null, $clean1);
        $clean3 = preg_replace('~{(.*?)}~', null, $clean2);
        $cleanResult = preg_replace('~{(.*?)}~', null, $clean3);
        preg_match('~<div class="cBox cBox--content cBox--resultList ">(.*?)<div data-srp-private-selling-teaser class="force-medium">~', $cleanResult, $list);
        preg_match_all('~<div class="cBox-body cBox-body--resultitem" data-testid="no-top">(.*?)</a>~', $list[1], $dataList);

        $cars = $dataList[1];

        $myResponseObject = [];

        foreach ($cars as $carString) {
            preg_match('~<span class="h3 u-text-break-word">(.*?)</span>~', $carString, $carName);
            $myResponseObject[] = [
                'carName' => $carName[1],
            ];
        }

        return response()->json($myResponseObject);
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
