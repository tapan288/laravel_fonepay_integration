<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        $MD = 'P';

        $AMT = '10';

        $CRN = 'NPR';

        $DT = date('m/d/Y');

        $R1 = 'test';

        $R2 = 'test';

        $RU = route('verifyPayment'); //fully valid verification page link

        $PRN = uniqid();


        $PID = 'NBQM';

        $sharedSecretKey = 'a7e3512f5032480a83137793cb2021dc';

        $DV = hash_hmac('sha512', $PID . ',' . $MD . ',' . $PRN . ',' . $AMT . ',' . $CRN . ',' . $DT . ',' . $R1 . ',' . $R2 . ',' . $RU, $sharedSecretKey);


        $paymentLiveUrl = 'https://clientapi.fonepay.com/api/merchantRequest';

        $paymentDevUrl = 'https://dev-clientapi.fonepay.com/api/merchantRequest';

        return view('welcome', compact('MD', 'AMT', 'CRN', 'DT', 'R1', 'R2', 'RU', 'PRN', 'PID', 'DV','paymentDevUrl'));
    }

    public function verifyPayment(Request $request)
    {
        $PID = 'NBQM';

        $sharedSecretKey = 'a7e3512f5032480a83137793cb2021dc';
        $prn = $request->PRN;
        $pid = $request->PID;
        $bid = $request->BID ?? '';
        $uid = $request->UID;
        $amount = 10;

        $requestData = [

            'PRN' => $prn,

            'PID' => $PID,

            'BID' => $bid,

            'AMT' => $amount, // original payment amount

            'UID' => $uid,

            'DV' => hash_hmac('sha512', $PID . ',' . $amount . ',' . $prn . ',' . $bid . ',' . $uid, $sharedSecretKey),

        ];


        // for test server

        $verifyDevUrl = 'https://dev-clientapi.fonepay.com/api/merchantRequest/verificationMerchant';

        // for live server

        $verifyLiveUrl = 'https://clientapi.fonepay.com/api/merchantRequest/verificationMerchant';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $verifyDevUrl . '?' . http_build_query($requestData));

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $responseXML = curl_exec($ch);


        if ($response = simplexml_load_string($responseXML)) {

            if ($response->success == 'true') {

                echo "Payment Verifcation Completed: " . $response->message;
            } else {

                echo "Payment Verifcation Failed: " . $response->message;
            }
        }
    }
}
