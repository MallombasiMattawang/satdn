<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\UploadedFile;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    //
    public function status_user()
    {
        //print_r($_GET);
        $apiURL = 'http://36.91.14.246/api/user/status/0803202100007062';
        // $postInput = [
        //     'first_name' => '0803202100007062',
        //     'last_name' => 'Savani',
        //     'email' => 'example@gmail.com'
        // ];

        $headers = [
            'X-header' => 'value',
            'Authorization' => 'Basic ZXNpZ246ZXNpZ25AMjAyMg=='
        ];

        $response = Http::withBasicAuth('esign', 'esign@2022')->get($apiURL);

        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);

        dd($responseBody);
    }

    public function signPdf(Request $request)
    {
        $curl = curl_init();
        $uploadDir = "/uploads/";
        $RealTitleID = $_FILES['signed_file']['name'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://36.91.14.246/api/sign/pdf',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('file' => new \CurlFile($_FILES['signed_file']['tmp_name'], 'application/pdf', $RealTitleID), 'nik' => '0803202100007062', 'passphrase' => '!Bsre1221*', 'tampilan' => 'invisible'),

            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ZXNpZ246ZXNpZ25AMjAyMg==',
                //'Cookie: JSESSIONID=128160A124E1ED1B4845EB493B9C0F36'
            ),
        ));
        $filename = "file-ku.pdf";
        $fp = fopen($filename, 'wb');
        curl_setopt($curl, CURLOPT_FILE, $fp);
        $response = curl_exec($curl);

        curl_close($curl);
        // tutup file hasil unduhan
        fclose($fp);
        echo $response;
        // $responseBody = json_decode($response->getBody(), true);

        dd($response);
    }
}
