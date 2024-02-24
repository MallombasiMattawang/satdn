<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\LogEsign;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;
use App\Models\ProgresDocument;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;

class EsignController extends Controller
{
    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('API Tes Esign-BSSN');
            $content->description('Fitur API Esign Badan Siber dan Sandi Negara (BSSN) ');

            $content->body(view('admin.esign.index', []));
        });
    }

    public function esign_pdf(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('API Esign-BSSN');
            $content->description('Fitur API Esign Badan Siber dan Sandi Negara (BSSN) ');

            $content->body(view('admin.esign.esign_pdf', []));
        });
    }

    public function send_esign_pdf(Request $request)
    {

        $ESIGN_APP_URL = env('ESIGN_APP_URL');
        $ESIGN_APP_KEY = env('ESIGN_APP_KEY');
        $uploadDir = "/uploads/";
        $nik = $request->nik;
        $passphrase = $request->passphrase;
        $reason = $request->reason;
        $RealTitleID = $_FILES['signed_file']['name'];


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $ESIGN_APP_URL . '/api/sign/pdf',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('file' => new \CurlFile($_FILES['signed_file']['tmp_name'], 'application/pdf', $RealTitleID), 'nik' => $nik, 'passphrase' => $passphrase, 'tampilan' => 'invisible', 'reason' => $reason),

            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $ESIGN_APP_KEY,
                //'Cookie: JSESSIONID=128160A124E1ED1B4845EB493B9C0F36'
            ),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        echo $httpcode;
        //die();

        if ($httpcode == 200) {
            $replace = str_replace(' ', '_', $RealTitleID);
            $filename = "tte_$replace";
            $fp = fopen($filename, 'wb');
            curl_setopt($curl, CURLOPT_FILE, $fp);
            $response = curl_exec($curl);
            curl_close($curl);
            // tutup file hasil unduhan
            fclose($fp);

            //session()->flash('msg', 'Success: ' . $httpcode . '<br>File surat berhasil di tandatangani, dan anda bisa mendownload file tersebut');
            admin_toastr('File surat berhasil di tandatangani secara digital, dan anda bisa mendownload file tersebut', 'success');

            /* Store the path of source file */
            $filePath = $filename;

            /* Store the path of destination file */
            $destinationFilePath = 'uploads/file_permits/' . $filename;

            /* Move File from images to copyImages folder */
            if (!rename($filePath, $destinationFilePath)) {
                echo "File can't be moved!";
                session()->flash('msg', 'Gagal Mengunduh File, Error:500');
            } else {
                echo "File has been moved!";
                //session()->flash('msg', '<a href="'.url('uploads/file_permits/'.$filePath).'" target="_blank" class="btn btn-success btn-lg"> Download Dokumen </a>');    
                session()->flash('msg', '
                        <a href="' . url('uploads/file_permits/' . $filePath) . '" target="_blank" class="btn btn-success btn-block"> Download Dokumen </a>
                        <embed type="application/pdf" src="' . url('view-file?download_file=file_permits/' . $filename) . '"
                        width="100%" height="900"></embed>');
            }
        } else {
            $response = curl_exec($curl);
            curl_close($curl);
            $approval = LogEsign::create([
                'status' => $httpcode,
                'message' => $response, 'error'
            ]);
            $approval->save();
            session()->flash('msg', $response);
            admin_toastr($response, 'error');
        }

        return redirect()->back();
    }

    public function verify_pdf(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('API Verifikasi PDF Esign-BSSN');
            $content->description('Fitur API Esign Badan Siber dan Sandi Negara (BSSN) ');

            $content->body(view('admin.esign.verify_pdf', []));
        });
    }

    public function send_verify_pdf(Request $request)
    {
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
            echo '<form action="'.url('admin-panel/esigns').'">
                <button type="submit" value="Kembali"> Back</button>
            </form>';
            //echo "</html>";
            
            
        }
        

        //session()->flash('msg', $response);


        //return redirect()->back();
    }

    public function verify_user(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('API Verifikasi User Esign-BSSN');
            $content->description('Fitur API Esign Badan Siber dan Sandi Negara (BSSN) ');

            $content->body(view('admin.esign.verify_user', []));
        });
    }

    public function send_verify_user(Request $request)
    {
        $ESIGN_APP_URL = env('ESIGN_APP_URL');
        $ESIGN_APP_KEY = env('ESIGN_APP_KEY');
        $nik = $request->nik;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $ESIGN_APP_URL . '/api/user/status/' . $nik,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $ESIGN_APP_KEY,
                //'Cookie: JSESSIONID=B740A114A4CE1A3592F0B10265EF9946'
            ),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        echo $response;
        if ($httpcode != 200) {
            $approval = LogEsign::create([
                'status' => $httpcode,
                'message' => $response, 'error'
            ]);
            $approval->save();
            admin_toastr($response, 'error');
        }
        session()->flash('msg', $response);
        //admin_toastr($response, 'error');

        return redirect()->back();
    }

    public function regis_user(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('API Registrasi Esign-BSSN');
            $content->description('Fitur API Esign Badan Siber dan Sandi Negara (BSSN) ');

            $content->body(view('admin.esign.regis_user', []));
        });
    }

    public function send_regis_user(Request $request)
    {
    }
}
