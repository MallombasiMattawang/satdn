<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\Service;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Else_;
use App\Models\ProgresApproval;
use App\Models\ProgresDocument;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Controllers\Dashboard;
use Illuminate\Support\Facades\Redirect;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;
use File;

class ApprovalController extends Controller
{
    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('Persetujuan Pimpinan');
            $content->description('Halaman Persetujuan Izin');

            $role = Auth::user()->roles->first()->name;
            $content->body(view('admin.approval.index', [
                'role' => $role,

            ]));
        });
    }

    public function approval_1(Content $content)
    {
        return Admin::content(function (Content $content) {
            $to = $_GET['to'];
            switch ($to) {
                case "1":
                    $to = 1;
                    $to_name = "KEPALA SEKSI";
                    break;
                case "2":
                    $to = 2;
                    $to_name = "KEPALA BIDANG";
                    break;
                case "3":
                    $to = 3;
                    $to_name = "SEKRETARIS";
                    break;
                default:
                    $to = 4;
                    $to_name = "KEPALA DINAS";
            }
            $content->header('Persetujuan ' . $to_name);
            $content->description('Halaman Persetujuan ' . $to_name);

            $data = ProgresDocument::where('approval', $to)->latest()->paginate(20);
            $content->body(view('admin.approval.1', [
                'data' => $data,
                'to' => $to,
                'to_name' => $to_name
            ]));
        });
    }

    public function getApproval_1(Content $content)
    {
        return Admin::content(function (Content $content) {
            $to = $_GET['to'];
            $id = $_GET['id'];
            $idTo = $_GET['to'];

            switch ($to) {
                case "1":
                    $from = "VERIFIKATOR";
                    $to = "KEPALA SEKSI";
                    break;
                case "2":
                    $from = "KEPALA SEKSI";
                    $to = "KEPALA BIDANG";
                    break;
                case "3":
                    $from = "KEPALA BIDANG";
                    $to = "SEKRETARIS";
                    break;
                default:
                    $from = "SEKRETARIS";
                    $to = "KEPALA DINAS";
            }

            $content->header('Persetujuan ' . $to);
            $content->description('Halaman Persetujuan ' . $to);

            $data = ProgresDocument::findOrFail($id);
            $content->body(view('admin.approval.get_1', [
                'from' => $from,
                'to' => $to,
                'idTo' => $idTo,
                'data' => $data,
            ]));
        });
    }

    public function verifikasi_surat(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('Generator Surat');
            $content->description('Halaman Pembuatan Format Surat Izin');

            //$role = Auth::user()->roles->first()->name;
            $to = $_GET['to'];
            $id = $_GET['id'];
            $idTo = $_GET['to'];
            $data = ProgresDocument::findOrFail($id);

            $content->body(view('admin.approval.verifikasi_surat', [
                //'role' => $role,
                'to' => $to,
                'idTo' => $idTo,
                'data' => $data,

            ]));
        });
    }

    public function kirim_surat(Request $request)
    {
        $request->validate([
            'temp_file_permit' => 'required|mimes:pdf',
            'number_letter' => 'required',
            'date_letter' => 'required',

        ]);

        $file = $request->file('temp_file_permit');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        // File extension
        $extension = $file->getClientOriginalExtension();

        // File upload location
        $location = 'uploads/temp';

        // Upload file
        $file->move($location, $filename);

        // File path
        $filepath = 'uploads/temp/' . $filename;

        //remove old file
        $progresDocument = ProgresDocument::findOrFail($request->id);
        if ($progresDocument->temp_file_permit) {

            $filePath = "uploads/$progresDocument->temp_file_permit";

            if (file_exists(public_path($filePath))) {

                unlink('uploads/' . $progresDocument->temp_file_permit);
            }
        }
        ProgresDocument::where("id", $request->id)
            ->update([
                'approval' => 1,
                'number_letter' => $request->number_letter,
                'date_letter' => $request->date_letter,
                'temp_file_permit' => 'temp/' . $filename,
            ]);
        return Redirect::to('admin-panel/historyTeknis');
    }

    public function setApproval_1(Request $request)
    {
        
        
            

        if ($request->to == 'KEPALA SEKSI') {
            $revisi = ProgresApproval::where("progres_document_id", $request->progres_document_id)->get();
            if ($revisi) {
                ProgresApproval::where("progres_document_id", $request->progres_document_id)
                    ->update([
                        'approval_ka_seksi' => now(),
                        'name_ka_seksi' => Auth::user()->name,
                        'note_ka_seksi' => $request->note_pimpinan,
                    ]);
            } else {
                $approval = ProgresApproval::create([
                    'progres_document_id' => $request->progres_document_id,
                    'approval_ka_seksi' => now(),
                    'name_ka_seksi' => Auth::user()->name,
                    'note_ka_seksi' => $request->note_pimpinan,
                ]);
                $approval->save();
            }
            if ($request->hasil == 1) {
                ProgresDocument::where("id", $request->progres_document_id)
                    ->update([
                        'approval' => 2,
                    ]);
            } else {
                ProgresDocument::where("id", $request->progres_document_id)
                    ->update([
                        'approval' => 0,
                    ]);
            }
        } elseif ($request->to == 'KEPALA BIDANG') {
            if ($request->hasil == 1) {
                ProgresApproval::where("progres_document_id", $request->progres_document_id)
                    ->update([
                        'approval_ka_bidang' => now(),
                        'name_ka_bidang' => Auth::user()->name,
                        'note_ka_bidang' => $request->note_pimpinan,
                    ]);
                ProgresDocument::where("id", $request->progres_document_id)
                    ->update([
                        'approval' => 3,
                    ]);
            } else {
                ProgresApproval::where("progres_document_id", $request->progres_document_id)
                    ->update([
                        'name_ka_bidang' => Auth::user()->name,
                        'note_ka_bidang' => $request->note_pimpinan,
                    ]);
                ProgresDocument::where("id", $request->progres_document_id)
                    ->update([
                        'approval' => 0,
                    ]);
            }
        } elseif ($request->to == 'SEKRETARIS') {
            if ($request->hasil == 1) {
                ProgresApproval::where("progres_document_id", $request->progres_document_id)
                    ->update([
                        'apporval_sekretaris' => now(),
                        'name_sekretaris' => Auth::user()->name,
                        'note_sekretaris' => $request->note_pimpinan,
                    ]);

                ProgresDocument::where("id", $request->progres_document_id)
                    ->update([
                        'approval' => 4,
                        //'number_letter' => $request->number_letter,
                        // 'file_permit' => 'sk/' . $filename,
                    ]);
            } else {
                ProgresApproval::where("progres_document_id", $request->progres_document_id)
                    ->update([

                        'name_sekretaris' => Auth::user()->name,
                        'note_sekretaris' => $request->note_pimpinan,
                    ]);
                ProgresDocument::where("id", $request->progres_document_id)
                    ->update([
                        'approval' => 0,
                    ]);
            }
        } elseif ($request->to == 'KEPALA DINAS') {
           
            if ($request->hasil == 1) {
                $rootPath  = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $request->signed_file;
                $filename = str_replace('/', '_', $request->signed_file);

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://36.91.14.246/api/sign/pdf',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('file' => new \CurlFile($rootPath, 'application/pdf', 'file'), 'nik' => '0803202100007062', 'passphrase' => '!Bsre1221*', 'tampilan' => 'invisible'),

                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic ZXNpZ246ZXNpZ25AMjAyMg==',
                        //'Cookie: JSESSIONID=128160A124E1ED1B4845EB493B9C0F36'
                    ),
                ));
                $filename = "permit_$filename";
                $fp = fopen($filename, 'wb');
                curl_setopt($curl, CURLOPT_FILE, $fp);
                $response = curl_exec($curl);

                curl_close($curl);
                // tutup file hasil unduhan
                fclose($fp);
                echo $response;
                // $responseBody = json_decode($response->getBody(), true);
                /* Store the path of source file */
                $filePath = $filename;

                /* Store the path of destination file */
                $destinationFilePath = 'uploads/file_permits/' . $filename;

                /* Move File from images to copyImages folder */
                if (!rename($filePath, $destinationFilePath)) {
                    echo "File can't be moved!";
                } else {
                    echo "File has been moved!";
                }
                //dd($response);
                //die();
                ProgresApproval::where("progres_document_id", $request->progres_document_id)
                    ->update([
                        'approval_ka_dinas' => now(),
                        'name_ka_dinas' => Auth::user()->name,
                        'note_ka_dinas' => $request->note_pimpinan,
                    ]);
                ProgresDocument::where("id", $request->progres_document_id)
                    ->update([
                        'approval' => 5,
                        'date_end_progres' => now(),
                        'file_permit' => $destinationFilePath
                    ]);
            } else {
                ProgresApproval::where("progres_document_id", $request->progres_document_id)
                    ->update([

                        'name_ka_dinas' => Auth::user()->name,
                        'note_ka_dinas' => $request->note_pimpinan,
                    ]);
                ProgresDocument::where("id", $request->progres_document_id)
                    ->update([
                        'approval' => 0,
                    ]);
            }



            //$user = User::findOrFail($request->user_id);
            // $details = [
            //     'title' => 'Approval Kepala Dinas',
            //     'body' => 'Permohonan izin anda sudah disetujui dan siap diterbitkan. silahkan download surat keterangan izin terbit ditautan ini :
            //     '.url("view-file/sk_pdf?number=" . $request->no_invoice).' Selanjutnya anda bisa ke Kantor DPMPTS Bulukumba untuk mencetak blanko izin ',
            // ];
            // Mail::to($user->email)->send(new \App\Mail\MyTestMail($details));
        }

        session()->flash('msg', 'Successfully done the operation.');
        //return redirect()->back();      
        //return redirect()->url('approval_1');
        //return Redirect::to('admin-panel/approval_1?to=' . $request->idTo);
        return response()->json(['pesan', $request->no_invoice]);
    }
}
