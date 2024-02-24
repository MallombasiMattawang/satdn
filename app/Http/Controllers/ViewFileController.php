<?php

namespace App\Http\Controllers;

use App\Admin\Controllers\ApprovalController;
use App\Models\Service;
use App\Models\Document;
use App\Models\ProgresApproval;
//use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\ProgresDocument;
use PDF;

class ViewFileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/uploads/"; // change the path to fit your websites document structure
        $fullPath = $path . $_GET['download_file'];

        if ($fd = fopen($fullPath, "r")) {
            $fsize = filesize($fullPath);
            $path_parts = pathinfo($fullPath);
            $ext = strtolower($path_parts["extension"]);
            switch ($ext) {
                case "pdf":
                    header("Content-type: application/pdf"); // add here more headers for diff. extensions
                    header("Content-Disposition: inline; filename=\"" . $path_parts["basename"] . "\"");
                    break;
                default;
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: filename=\"" . $path_parts["basename"] . "\"");
            }
            header("Content-length: $fsize");
            header("Cache-control: private"); //use this to open files directly
            while (!feof($fd)) {
                $buffer = fread($fd, 2048);
                echo $buffer;
            }
        }
        fclose($fd);
        exit;
    }

    public function sk_pdf(Request $request)
    {
        $number = $_GET['number'];
        //$sk = ProgresDocument::findOrFail($id);
        $sk = ProgresDocument::where('no_invoice', $number)->firstOrFail();
        $note_doc = strip_tags($sk->note_verified_doc);
        $note_teknis = strip_tags($sk->note_verified_teknis);
        

        if ($sk->approval) {
           
                $approval = ProgresApproval::where('progres_document_id', $sk->id)->first();
                if ($approval) {
                    $pdf = PDF::loadview('print.sk_pdf', [
                        'sk' => $sk,
                        'note_teknis' => $note_teknis,
                        'note_doc' => $note_doc,
                        'approval' => $approval,
                    ]);                    
                    return $pdf->stream();
                } else {
                    $pdf = PDF::loadview('print.ver_pdf', [
                        'sk' => $sk,
                        'note_teknis' => $note_teknis,
                        'note_doc' => $note_doc,
                    ]);                    
                    return $pdf->stream();
                }
               
          
        } else {
            return abort(404, 'Page not found.');
        }
    }
}
