<?php

namespace App\Http\Controllers;

use App\Models\LogEsign;
use Illuminate\Http\Request;
use App\Models\ProgresDocument;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class TrackingController extends Controller
{
  //
  public function index()
  {
    //$services = Service::all();
    $track = '';
    return view('tracking.index', [
      'track' => $track
    ]);
  }

  public function validasi()
  {
    //$services = Service::all();
    $track = '';
    return view('tracking.validasi', [
      'track' => $track
    ]);
  }

  public function validasi_pdf(Request $request)
  {
    $request->validate(
      [

        'signed_file' => 'required',
        'captcha' => ['required', 'captcha'],
      ],
    );
    $ESIGN_APP_URL = env('ESIGN_APP_URL');
        $ESIGN_APP_KEY = env('ESIGN_APP_KEY');

        $RealTitleID = $_FILES['signed_file']['name'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $ESIGN_APP_URL . '/api/sign/verify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('signed_file' => new \CurlFile($_FILES['signed_file']['tmp_name'], 'application/pdf', $RealTitleID)),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $ESIGN_APP_KEY,
                //'Cookie: JSESSIONID=B740A114A4CE1A3592F0B10265EF9946'
            ),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        //echo $response;
       
        if ($httpcode != 200) {
            $approval = LogEsign::create([
                'status' => $httpcode,
                'message' => $response, 'error'
            ]);
            $approval->save();
            admin_toastr($response, 'error');
        } else {
            $decoded = json_decode($response, true);
           // echo "<html>";
            //echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"';
            echo "<img src='/assets/img/logo_bsre.png' width='300' style='margin-left: auto;
            margin-right: auto;display: block;'>";
            echo '<h3 style="text-align:center">Hasil Validasi Dokumen Esign-BSSN</h3>';
            echo "<table style='border: 1px solid #ddd; text-align:left; width:100%; padding:10px;'>";
            foreach ($decoded as $d => $k) {
    
                //Print out the element if it isn't an array.
                if (!is_array($k)) {
                    echo "<tr><th> $d </th><td>: $k </td><tr>";
                }
            }
            echo "</table> <br>";
           
            
            
        }
  }

  public function cari(Request $request)
  {
    // menangkap data pencarian
    $cari = $request->cari;

    // mengambil data dari table progress sesuai pencarian data

    $track = ProgresDocument::where('no_invoice', $cari)->first();

    // mengirim data progress ke view index
    return view('tracking.cari', ['track' => $track]);
  }

  public function verification(Request $request)
  {
    // menangkap data pencarian
    $key = $request->key;
    try {
     // $decrypted = Crypt::decryptString($key);
      $track = ProgresDocument::where('id', $key)->first();

      // mengirim data progress ke view index
      return view('tracking.verification', ['track' => $track]);
    } catch (DecryptException $e) {
      return abort(404);
    }
  }
}
