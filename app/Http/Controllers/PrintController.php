<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgresApproval;
use App\Models\ProgresDocument;
use App\Models\ProgresServiceDocument;
use App\Models\ProgresServiceInput;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use NcJoes\OfficeConverter\OfficeConverter;
use Illuminate\Support\Facades\Crypt;
//use App\Http\Controllers\PrintController;

class PrintController extends Controller
{
    //
    public function index()
    {
        // \PhpOffice\PhpWord\Settings::setPdfRendererPath('../vendor/dompdf/dompdf');
        // \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        $id = $_GET['id'];
        $data = ProgresDocument::findOrFail($id);
        $array_bln = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $tgl1 = date('Y-m-d'); // pendefinisian tanggal awal
        $tgl2 = date('Y-m-d', strtotime('+3 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 3 hari

        $bln = $array_bln[date('n', strtotime($tgl2))];
        $tgl =  date('d', strtotime($tgl2));
        $th =  date('Y', strtotime($tgl2));

        $terbit = $tgl . ' ' . $bln . ' ' . $th;

        $format = $data->service->format_number;
        $last_number = ProgresDocument::where('format_number', $format)
            ->where('approval', 5)
            ->count();
        $lastId = ProgresDocument::max('id');
        $invoice = sprintf('%03s', abs($last_number + 1));
        $array_bln_romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $bln_romawi = $array_bln_romawi[date('n')];

        $number_letter = $invoice . '/' . $format . '/' . $bln_romawi . '/' . $th;


        $name = $data->applicant_name;        
        $service = $data->service->name;
        $template_surat = $data->service->template_surat;
        $nik = $data->nik;
        $no_kk = $data->no_kk;
        $npwp = $data->npwp;
        $place_of_birth = $data->place_of_birth;
        $date_of_birth = $data->date_of_birth;
        $phone_number = $data->phone_number;
        $address_ktp = $data->address_ktp;
        $email = $data->user->email;
        //$date_end_progres = $data->date_end_progres;

        $template = new \PhpOffice\PhpWord\TemplateProcessor('uploads/' . $template_surat . '');
        //default dari tabel
        $template->setValue('nama_pemohon', $name);
        $template->setValue('number_letter', $number_letter);
        $template->setValue('nik', $nik);
        $template->setValue('no_kk', $no_kk);
        $template->setValue('npwp', $npwp);
        $template->setValue('place_of_birth', $place_of_birth);
        $template->setValue('date_of_birth', $date_of_birth);
        $template->setValue('phone_number', $phone_number);
        $template->setValue('address_ktp', $address_ktp);
        $template->setValue('nomor_pokok', $email);
        $template->setValue('terbit', $terbit);

        $encrypted = Crypt::encryptString($number_letter);

        $qrcode = 'data:image/png;base64,' . base64_encode(
            QrCode::format('png')->size(100)->generate(url('verification?key=' . $id)),
        );

        //$template->setImageValue('qrcode', 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://siap.bulukumbakab.go.id/verification/'.$number_letter.'');
        $template->setImageValue('qr_code', array('path' => $qrcode, 'width' => 100, 'height' => 100, 'ratio' => false));



        //form inputan
        $progresInput = ProgresServiceInput::where('progres_document_id', $data->id)->paginate(50);
        //dokumen inputan
        $progresDoc = ProgresServiceDocument::where('progres_document_id', $data->id)->where('document_name', 'Pas Foto 3x4')->get();
        $no = 0;
        foreach ($progresInput as $input) {
            $no++;
            $template->setValue($input->kode, $input->value);
        }
        foreach ($progresDoc as $doc) {
            $no++;
            $template->setImageValue('pas_foto', array('path' => 'uploads/'.$doc->file_document.'', 'width' => 100, 'height' => 100, 'ratio' => true));
            //$template->setImageValue('pas_foto', url('/uploads/'.$doc->file_document));
            $template->setValue('tes', $doc->file_document);
        }
        

        $filename = 'preview_' . $id . '-' . $nik . '.docx';
        $path = 'uploads/temp/' . $filename . '';
        $template->saveAs($path);
        //return response()->download($path);
        ProgresDocument::where("id", $data->id)
            ->update([
                'temp_file_permit' => $path,

            ]);
        return redirect('admin-panel/verifikasi_surat?to=1&id=' . $data->id);


        // header("Content-type: application/octet-stream"); // add here more headers for diff. extensions
        // header("Content-Disposition: attachment; filename=$filename");
        //$template->saveAs('php://output');        

        //$temp = \PhpOffice\PhpWord\IOFactory::load($path, 'Word2007');

        // $path = 'uploads/' . $template_surat . '';
        // $template->saveAs($path);
        // $temp = \PhpOffice\PhpWord\IOFactory::load($path, 'Word2007');
        //$phpWord = IOFactory::load('./mpol/Rechnung.docx', 'Word2007');
        // $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($temp, 'PDF');
        // $xmlWriter->save(storage_path('IZIN_PENELITIAN.pdf'), TRUE);

        // /*@ Remove temporarily created word file */
        // if (file_exists($path)) {
        //     unlink($path);
        // }

        // return response()->download(storage_path('IZIN_PENELITIAN.pdf'));

        // $converter = new OfficeConverter($path);
        // $converter->convertTo('../file_permits/' . $name_convert . $nik . '.pdf');
        // return redirect('view-file?download_file=file_permits/' . $name_convert . $nik . '.pdf');
        //return response()->download($nik.'.pdf');
    }



    public function convert()
    {

        $id = $_GET['id'];
        $data = ProgresDocument::findOrFail($id);
        $array_bln = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $bln = $array_bln[date('n', strtotime($data->date_start_progres))];
        $tgl =  date('d', strtotime($data->date_start_progres));
        $th =  date('Y', strtotime($data->date_start_progres));

        $terbit = ' ';
        $name_convert = $tgl . '-' . $bln . '-' . $th;

        $name = $data->applicant_name;
        $number_letter = '';
        $service = $data->service->name;
        $template_surat = $data->service->template_surat;
        $nik = $data->nik;
        $no_kk = $data->no_kk;
        $npwp = $data->npwp;
        $place_of_birth = $data->place_of_birth;
        $date_of_birth = $data->date_of_birth;
        $phone_number = $data->phone_number;
        $address_ktp = $data->address_ktp;
        $email = $data->user->email;
        //$date_end_progres = $data->date_end_progres;

        $template = new \PhpOffice\PhpWord\TemplateProcessor('uploads/' . $template_surat . '');
        //default dari tabel
        $template->setValue('nama_pemohon', $name);
        $template->setValue('number_letter', $number_letter);
        $template->setValue('nik', $nik);
        $template->setValue('no_kk', $no_kk);
        $template->setValue('npwp', $npwp);
        $template->setValue('place_of_birth', $place_of_birth);
        $template->setValue('date_of_birth', $date_of_birth);
        $template->setValue('phone_number', $phone_number);
        $template->setValue('address_ktp', $address_ktp);
        $template->setValue('nomor_pokok', $email);
        $template->setValue('terbit', $terbit);
        $qrcode = '';
        // $qrcode = 'data:image/png;base64,' . base64_encode(
        //     QrCode::format('png')->size(100)->generate(url('verification/number_letter=' . $data->number_letter)),
        // );


        //$template->setImageValue('qrcode', array('path' => $qrcode, 'width' => 100, 'height' => 100, 'ratio' => false));

        //form inputan
        $progresInput = ProgresServiceInput::where('progres_document_id', $data->id)->paginate(20);
        $no = 0;
        foreach ($progresInput as $input) {
            $no++;
            $template->setValue($input->kode, $input->value);
        }

        // $filename = $nik.'.docx';
        // header("Content-type: application/octet-stream"); // add here more headers for diff. extensions
        // header("Content-Disposition: attachment; filename=$filename");
        // $template->saveAs('php://output');

        $path = 'uploads/' . $template_surat . '';
        $template->saveAs($path);
        $temp = \PhpOffice\PhpWord\IOFactory::load($path, 'Word2007');

        $converter = new OfficeConverter($path);
        $converter->convertTo('../file_permits/preview_' . $name_convert . $nik . '.pdf');
        return redirect('view-file?download_file=file_permits/preview_' . $name_convert . $nik . '.pdf');
        //return response()->download($nik.'.pdf'); 
    }
}
