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

    public function setApproval_1(Request $request)
    {
        $request->validate([
            'progres_document_id' => 'required|exists:progres_documents,id',
            'note_pimpinan' => 'required',
        ]);

        if ($request->to == 'KEPALA SEKSI') {
            $approval = ProgresApproval::create([
                'progres_document_id' => $request->progres_document_id,
                'approval_ka_seksi' => now(),
                'name_ka_seksi' => Auth::user()->name,
                'note_ka_seksi' => $request->note_pimpinan,
            ]);
            $approval->save();
            ProgresDocument::where("id", $request->progres_document_id)
                ->update([
                    'approval' => 2,
                ]);
            
        } elseif ($request->to == 'KEPALA BIDANG') {
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
           
        } elseif ($request->to == 'SEKRETARIS') {
            ProgresApproval::where("progres_document_id", $request->progres_document_id)
                ->update([
                    'apporval_sekretaris' => now(),
                    'name_sekretaris' => Auth::user()->name,
                    'note_sekretaris' => $request->note_pimpinan,
                ]);
            // $file = $request->file('file');
            // $filename = time() . '.' . $file->getClientOriginalExtension();

            // // File extension
            // $extension = $file->getClientOriginalExtension();

            // // File upload location
            // $location = 'uploads/sk';

            // // Upload file
            // $file->move($location, $filename);

            // // File path
            // $filepath = 'uploads/sk/' . $filename;

            // //remove old file
            // $progresDocument = ProgresDocument::findOrFail($request->progres_document_id);
            // if ($progresDocument->file_permit) {

            //     $filePath = "uploads/$progresDocument->file_permit";

            //     if (file_exists(public_path($filePath))) {

            //         unlink('uploads/' . $progresDocument->file_permit);
            //     }
            // }
            ProgresDocument::where("id", $request->progres_document_id)
                ->update([
                    'approval' => 4,
                    'number_letter' => $request->number_letter,
                   // 'file_permit' => 'sk/' . $filename,
                ]);
        } elseif ($request->to == 'KEPALA DINAS') {
            // ProgresApproval::where("progres_document_id", $request->progres_document_id)
            //     ->update([
            //         'approval_ka_dinas' => now(),
            //         'name_ka_dinas' => Auth::user()->name,
            //         'note_ka_dinas' => $request->note_pimpinan,
            //     ]);
            // ProgresDocument::where("id", $request->progres_document_id)
            //     ->update([
            //         'approval' => 5,
            //         'date_end_progres' => now(),
            //     ]);


            //$user = User::findOrFail($request->user_id);
            // $details = [
            //     'title' => 'Approval Kepala Dinas',
            //     'body' => 'Permohonan izin anda sudah disetujui dan siap diterbitkan. silahkan download surat keterangan izin terbit ditautan ini :
            //     '.url("view-file/sk_pdf?number=" . $request->no_invoice).' Selanjutnya anda bisa ke Kantor DPMPTS Bulukumba untuk mencetak blanko izin ',
            // ];
            // Mail::to($user->email)->send(new \App\Mail\MyTestMail($details));
        } 

        //return redirect()->back();   
        //return redirect()->url('approval_1');
        return Redirect::to('admin-panel/approval_1?to=' . $request->idTo);
    }
}
