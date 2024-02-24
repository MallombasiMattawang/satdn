<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ProgresDocument;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgresServiceDocument;
use App\Models\ProgresServiceInput;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProgresDocumentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function getService(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        return view('user-page.get-service-page', [
            'service' => $service
        ]);
    }

    public function storeService(Request $request)
    {

       //print_r($_POST);
        //die();
        $request->validate(
            [
                //'user_id' => 'required|exists:users,id',
                'service_id' => 'required|exists:services,id',
                'nik' => 'required|numeric|digits:16',
                //'no_kk' => 'required|numeric|digits:16',
                //'npwp' => 'required|numeric|min:16',
                'date_of_birth' => 'required',
                'place_of_birth' => 'required',
                'applicant_name' => 'required',
                'gender' => 'required',
                'phone_number' => 'required',
                'address_ktp' => 'required',

            ],
            [
                'required' => ':attribute harus diisi',
                'nik.digits' => 'Nik Harus 16 karakter ',
                //'no_kk.digits' => 'Nomor KK Harus 16 karakter ',
                //'npwp.min' => 'Nik Harus 16 karakter',
                'numeric' => ':attribute harus berupa angka '
            ]
        );
        $awal = 'SIAP';
        $lastId = ProgresDocument::max('id');
        $invoice = sprintf("%03s",  abs($lastId + 1) . '/' . $awal . '/' . date('n') . '/' . date('Y'));

        $progresDocument = ProgresDocument::create([
            'user_id' => Auth::user()->id,
            'service_id' => $request->service_id,
            'nik' => $request->nik,
            // 'no_kk' => $request->no_kk,
            // 'npwp' => $request->npwp,
            'date_of_birth' => $request->date_of_birth,
            'place_of_birth' => $request->place_of_birth,
            'applicant_name' => $request->applicant_name,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'address_ktp' => $request->address_ktp,
            'no_invoice' => $invoice,
            'status' => 'UPLOAD DOC.',
            'date_start_progres' => now(),
            'format_number' => $request->format_number,
            'admin_teknis' => $request->admin_teknis,
        ]);
        $progresDocument->save();
        $lastInsert = $progresDocument->id;

        $service = Service::findOrFail($progresDocument->service_id);
        foreach ($service->documents as $doc) {
            $progresServiceDocument = ProgresServiceDocument::create([
                'progres_document_id' => $lastInsert,
                'document_id' => $doc->id,
                'document_name' => $doc->name,
                'document_type' => $doc->type_file,
                'document_max' => $doc->max_file,
                'required' => $doc->required,
            ]);
            $progresServiceDocument->save();            
        }

       // $service_input = Service::findOrFail($progresDocument->service_id);
        foreach ($service->inputs as $input) {
            $value = $input->id;
            $progresServiceInput = progresServiceInput::create([
                'progres_document_id' => $lastInsert,
                'service_input_id' => $input->id,
                'kode' => $input->kode,
                'input_name' => $input->input,
                'value' => $request->$value,
                
            ]);
            $progresServiceInput->save();            
        }
        

        return redirect()->route('getDocument', $lastInsert);
    }

    public function getDocument(Request $request, $id)
    {
        $biodata = ProgresDocument::findOrFail($id);
        $service = Service::findOrFail($biodata->service_id);
        $progresDocument = ProgresServiceDocument::where('progres_document_id', $biodata->id)->get();
        $countDoc = ProgresServiceDocument::where('progres_document_id', $biodata->id)->where('required', 1)->count();
        $countDocNull = ProgresServiceDocument::where('progres_document_id', $biodata->id)->where('required', 1)->whereNotNull('file_document')->count();

        if ($biodata->status == 'UPLOAD DOC.' || $biodata->status == 'VERIFIKASI DOKUMEN DITOLAK') {
            return view('user-page.get-document-page', [
                'biodata' => $biodata,
                'service' => $service,
                'progresDocument' => $progresDocument,
                'countDoc' => $countDoc,
                'countDocNull' => $countDocNull,
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function updateBiodata(Request $request)
    {
        $request->validate(
            [
                'id' => 'required|exists:progres_documents,id',
                'nik' => 'required|numeric|digits:16',
                //'no_kk' => 'required|numeric|digits:16',
                //'npwp' => 'required|numeric|min:16',
                'date_of_birth' => 'required',
                'place_of_birth' => 'required',
                'applicant_name' => 'required',
                'gender' => 'required',
                'phone_number' => 'required',
                'address_ktp' => 'required',
            ],
            [
                'required' => ':attribute harus diisi',
                'nik.digits' => 'Nik Harus 16 karakter ',
                //'no_kk.digits' => 'Nomor KK Harus 16 karakter ',
                //'npwp.min' => 'Npwp Harus 16 karakter',
                'numeric' => ':attribute harus berupa angka '
            ]
        );

        ProgresDocument::where("id", $request->id)
            ->update([
                'nik' => $request->nik,
                //'no_kk' => $request->no_kk,
                //'npwp' => $request->npwp,
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => $request->place_of_birth,
                'applicant_name' => $request->applicant_name,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'address_ktp' => $request->address_ktp,
            ]);

        return redirect()->route('getDocument', $request->id)->with('message', 'Data Berhasil diubah');
    }

    public function uploadDocument(Request $request)
    {
        $data = array();

        //data file
        $progresDocument = ProgresServiceDocument::findOrFail($request->id);

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:' . $progresDocument->document_type . '|max:' . $progresDocument->document_max . '',
            'id' => 'required|exists:progres_service_documents,id'
        ], [
            'max' => 'Ukuran file maksimal ' . $progresDocument->document_max . 'kb',
            'mimes' => 'jenis file harus ' . $progresDocument->document_type . '',
        ]);

        if ($validator->fails()) {

            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('file'); // Error response

        } else {
            if ($request->file('file')) {

                $file = $request->file('file');
                $filename = time() . '.' . $file->getClientOriginalExtension();

                // File extension
                $extension = $file->getClientOriginalExtension();

                // File upload location
                $location = 'uploads/files';

                // Upload file
                $file->move($location, $filename);

                // File path
                $filepath = 'uploads/files/' . $filename;

                //remove old file
                $progresDocument = ProgresServiceDocument::findOrFail($request->id);
                if ($progresDocument->file_document) {

                    $filePath = "uploads/$progresDocument->file_document";

                    if (file_exists(public_path($filePath))) {

                        unlink('uploads/' . $progresDocument->file_document);
                    }
                }

                //update db
                ProgresServiceDocument::where("id", $request->id)
                    ->update([
                        'file_document' => 'files/' . $filename,
                    ]);

                // Response
                $data['success'] = 1;
                $data['message'] = 'Uploaded Successfully!';
                $data['filepath'] = $filepath;
                $data['extension'] = $extension;
            } else {
                // Response
                $data['success'] = 2;
                $data['message'] = 'File not uploaded.';
            }
        }

        return response()->json($data);
    }

    public function updateToVerified(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:progres_documents,id',
            'pernyataan' => 'required',
        ]);

        ProgresDocument::where("id", $request->id)
            ->update([
                'status' => 'PROSES VERIFIKASI DOKUMEN',
                'date_verified_doc' => null,
                'note_verified_doc' => null,
            ]);
        return redirect()->route('getVerified', $request->id);
    }

    public function getVerified(Request $request, $id)
    {
        $disabled = 'disabled';
        $progresDocument = ProgresDocument::findOrFail($id);
        if ($progresDocument->status != 'UPLOAD DOC.') {
            return view('user-page.get-verified-page', [
                'progresDocument' => $progresDocument,
                'disabled' => $disabled
            ]);
        } else {
            return redirect()->route('getDocument', $id);
        }
    }
}
