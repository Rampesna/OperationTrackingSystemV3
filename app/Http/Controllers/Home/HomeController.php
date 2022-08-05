<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
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

    public function test(Request $request)
    {
        $file = $request->file('file');

        define('AWS_KEY', 'ots');
        define('AWS_SECRET_KEY', '357159123');
        $ENDPOINT = 'http://ays.s3.ayssoft.com';

        $client = new S3Client([
            'region' => '',
            'version' => '2006-03-01',
            'endpoint' => $ENDPOINT,
            'credentials' => [
                'key' => AWS_KEY,
                'secret' => AWS_SECRET_KEY
            ],
            // Set the S3 class to use objects.dreamhost.com/bucket
            // instead of bucket.objects.dreamhost.com
            'use_path_style_endpoint' => true
        ]);

        $response = $client->putObject([
            'Bucket' => "otsweb",
            'Key' => 'avatar4.png',
            'Body' => fopen($file->getPath() . '/' . $file->getFilename(), 'r'),
            'ACL' => 'public-read'
        ]);

        return $client->getObjectUrl('otsweb', 'avatar4.png');
    }

    public function test2()
    {
        $client = new Client;
        $response = $client->get('https://suchen.mobile.de/fahrzeuge/search.html?dam=0&isSearchRequest=true&ref=quickSearch&sb=rel&vc=Car', [
            'headers' => [
                'Accept' => 'application/json',
                'Accept-Encoding' => 'gzip, deflate, br',
                'Accept-Language' => 'tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Safari/537.36 OPR/89.0.4447.64',
                'Referer' => 'https://suchen.mobile.de/fahrzeuge/search.html?dam=0&isSearchRequest=true&ref=quickSearch&sb=rel&vc=Car',
                'Cookie' => 'optimizelyEndUserId=oeu1656155571651r0.023912667791742725; _tt_enable_cookie=1; _ttp=08ddbb00-d380-4eed-8e6e-d1d5a8854bcb; vi=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjaWQiOiJiNWQ2ZWU4OC01MGJiLTQ4ZGMtYWMzOS0zOGQ2ODk5ZTQxZmQiLCJpYXQiOjE2NTYxNTU1NzV9.rcpf5Q0602Vxs6NhwvKUGKlXQsz6fX1zsddEUORiHUY; mdeConsentDataGoogle=1; mdeConsentData=CPbJUkpPbJUkpEyAHADECVCgAP_AAELAAAYgI3Nd_X__bX9n-_7_6ft0eY1f9_r37uQzDhfFs-8F3L_W_LwX32E7NF36tq4KmR4ku3bBIQNtHMnUTUmxaolVrzHsak2cpyNKJ7JkknsZe2dYGH9Pn9lD-YKZ7_5___f52T_9_9_-39z3_9f___d__-__-vjf_599n_v9fV_78_L________-___________wLzgDgAKABAADQAIoATAAtgLzAJCQEAAFgAVAAyABwAEQAMgAeABEACeAFUAYYA_QEiAMkAZOAy4NAFACYAFwA6oCRAGTiIAgATADqgJEAZOKgCABMAC4ApsBeYyAEAEwBeY6AqAAsACoAGQAOAAiABkADwAHwARAAngBVAC4AGIATAAwwB-gEWASIAyQBk4DLiEAkABYAGQARABMACqAFwAMQCRAGTkoBYACwAMgAcABEADwAIgAVQAuABiASIAycpASAAWABUADIAHAARAAyAB4AEQAJ4AUgAqgBiAH6ARYBIgDJAGTgMuA.YAAAAAAAD4AAAKcAAAAA; _gcl_au=1.1.2054213975.1656155576; _pbjs_userid_consent_data=8245490656587554; _pubcid=a78c86db-755b-406d-9817-aba16d8addd1; axd=4298032481539637571; __gsas=ID=53bddc4ee156c08b:T=1658396559:S=ALNI_MYSb-R5nw5xftt3t_kPWKnnJM8Xqg; _fbp=fb.1.1658396563064.2036532667; cto_axid=OfNacgFYxFqxDE_TfLekuuaN5ko5ryAl; bm_sz=72B90152416F30EF81D183F4901743E8~YAAQhFozuMcL4C2CAQAA0+ZpXRBE8K9ff0CKKQDbxUqywsGM/Jid5bItlOo1PfpIP/alD/1jiBrKd+Nanr+mov7VA+ZpGXdgn3o6mkjdVXlzKYmgadqW2guuZfPL3KGicuq0wWTT/mPgQ7X8TBgU69sS1fEi58DndqKXfXTfgpIeBbh1JZZFr0UINOVc3/HhcHM8mUQHuwUBy2jjmxuxaBPRB6XWQ8FDCsGRLT/uZaf1tlxdwDK/4WaJffPeMj4hEAX2wGzdWSlkulT7P2qHKp23UmZqafGg6Y84PutmdgA2vg==~3750212~3356217; bm_mi=21A339D917827E2C7512136DCB8ED8FE~YAAQhFozuPsL4C2CAQAAOehpXRD6wj+PS7ekGDDwnP7uODuQahRBkAZP1qlIhEXwnjHmMZ55bzpz52I9hjQzP3SYtYPLV6D0PyjJf/2DqqOVfuUlZ17mOWIR9+lPBNpv29Bgov+TtAr9zze8lyziJEaG9N2QL6q1xAlEqxfGVkL2/S1M2PXRJzOxXu1W0LNr8FzIcgDqo1R742HkfdOrOWhrokBieJuZF+RJB71YqnmrmQzNfUAPOcpLiD1p9PNztGoOgx11efPXiNbLM1hwIbDjFunJeZzTBXuZpp1SUSdOo+SBD7FMiMSr0m1d~1; _gid=GA1.2.1790723377.1659424600; iom_consent=0103ff03ff&1659424599942; _clck=1kb5afw|1|f3o|0; mobile.LOCALE=de; POPUPCHECK=1659511006886; ces=cs; lux_uid=165942460801016810; tis=EP117%3A3250; outbrain_cid_fetch=true; hsstp=1; _gat_UA-3584729-32=1; ak_bmsc=19BC0E184A9B90282098AFD4E89DE7B2~000000000000000000000000000000~YAAQhFozuJEu4C2CAQAACn1sXRCXZtu9S8EYRYtFTXnIoyjpglbV8XsiebkCOivNA4gG1F2Ww9IyNuwpDYCMSJqIxiDUiUA1pMVw8j6//jh7/J/dELCX05omq691/w1FPOXnVOA38VVI8vSo+bhXEm7oseTZB5A6CneVq8/1q1zh17HN1UnJYk+pM9h92oQFJDqMF0fQKnwCBsm67o+C0IlSH7lO2Q4UkJ/Vnz8o6UynW+g50D2eESXx+XU5ZBVdW6MuedujvlyV6foxWAvQBU9ngsWiN0AYnWAjHxMykD3b48VFNSbPtHgVjq1qeg8/iuzMscb9f7Ggq2k4P2+WbvI7c1SgkSshoPATLFfqKvmUCLkiRDHlZcNt3bljZdtQFlTdefLAVym53LUhak0djCjixJqfBBw7a1K2ohUP3n4y+wsjlC/wQRvooWxpj/9AOkmEOqLhb6YAygsD2fLqr9y8lw==; ioam2018=001b8f8e42d0a770b62b6ee0e:1685531663752:1656155663752:.mobile.de:13:mobile:DE/DE/OB/S/P/S/G:noevent:1659424768477:nbaxwl; bm_sv=194D98CEDF7A0661DE1D095F554EEBE3~YAAQhFozuNQu4C2CAQAA84JsXRDggSnSoZbbwKZHgPh23R2m2R8I1QTqOy5n5PPh2IrHElM4XCUe5tgd2ose+CjwB9xJLgizNjj0FF7xPzqvo7Ex3SFuowYpAcdktZIMskZMulTLH1x6QCETm/RSaMjJdsRzqJcK/0KHgrNrOKdRUb4UNKXcO9MIyx0kHP5jTUAWjanEdupSfguyolXwLSgk/viN9jPe4XCHLqrNtZxWCH+v37Y0/pFWhoGRxeCv~1; _ga_2H40T2VTNP=GS1.1.1659424600.3.1.1659424769.0; _ga=GA1.2.2003995425.1656155574; _abck=9BBE60CBF24F09C5C6208FE1EF0E94D8~0~YAAQhFozuO8u4C2CAQAA6YdsXQjhdp3lwOezZ6NaK+pW2z0Jljf6OQHGt8Sca/UB51OwcND1nY0QrZo1fax3qhePOIl0KNwPLurhuOOe80ejH2PR6tczq88rHE1ZTfj46lfYjDq82lesuYtsJulAYWfFm2gZYSTRHN7NaPD0prjJ99X2N8QOOXboCchD1f5w1cTLOE1DpS5w24Ut90GKZQgYvCsrIu7m8t6h490vp+HsNCUoxvhxCt2iOGE2hRl7NHhtmabtctt22cREbEs9xM41Ex9XzTyxJzZZMSJCNmufHUD02fLia0RcVCFq6RMN8J7BqmqkPfH0hRaBPHvE1flaoeciq4SO0nJxOTinfq77haldxSwxQHNrMYU958w3OZ90eA1EhnojVS/Ji4dZ6CaltGg=~-1~||-1||~-1; _uetsid=0e6bb9a0123311ed9caeb50473c8e362; _uetvid=f8fec750f47711ecbde22df4657c2c73; _clsk=1ja5xtn|1659424775741|6|0|d.clarity.ms/collect'
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
