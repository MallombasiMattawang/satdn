<?php

namespace App\Admin\Controllers;

use Encore\Admin\Layout\Row;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use App\Models\ProgresDocument;
use App\Models\Service;
use App\Models\User;
use Encore\Admin\Controllers\Dashboard;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {

            $countUploadDoc = ProgresDocument::where("status", 'UPLOAD DOC.')->count();
            $countVerifikasiDoc = ProgresDocument::where("status", 'PROSES VERIFIKASI DOKUMEN')->count();
            $countVerifikasiTeknis = ProgresDocument::where("status", 'VERIFIKASI DOKUMEN BERHASIL')->count();
            $countVerifikasiSignature = ProgresDocument::where("status", 'VERIFIKASI TEKNIS BERHASIL')->where('number_letter', '=', null)->count();
            
            $countDocDiterima = ProgresDocument::where("status", 'VERIFIKASI DOKUMEN DITERIMA')->orwhere('date_verified_teknis', '!=', null)->count();
            $countDocDitolak = ProgresDocument::where("status", 'VERIFIKASI DOKUMEN DITOLAK')->count();

            $countTeknisDiterima = ProgresDocument::where("status", 'VERIFIKASI TEKNIS DITERIMA')->orwhere('number_letter', '!=', null)->count();
            $countTeknisDitolak = ProgresDocument::where("status", 'VERIFIKASI TEKNIS DITOLAK')->count();
            $countTeknisKonsultasi = ProgresDocument::where("status", 'PANGGILAN KONSULTASI')->count();

            $countKasi = ProgresDocument::where("approval", '1')->count();
            $countKabid = ProgresDocument::where("approval", '2')->count();
            $countSekretaris = ProgresDocument::where("approval", '3')->count();
            $countKadis = ProgresDocument::where("approval", '4')->count();
            

            $countUser = User::whereNotNull("email_verified_at")->count();
            $countService = Service::where("active", '1')->count();
            $countIzinTerbit = ProgresDocument::whereNotNull("number_letter")->count();


            $content->header('Summary Report');
            $content->description('Grafik Pelayanan Perizinan');

            $content->body(view('admin.charts.bar', [
                'countUploadDoc' => $countUploadDoc,
                'countVerifikasiDoc' => $countVerifikasiDoc,
                'countVerifikasiTeknis' => $countVerifikasiTeknis,
                'countVerifikasiSignature' => $countVerifikasiSignature,
                'countDocDiterima' => $countDocDiterima,
                'countDocDitolak' => $countDocDitolak,
                'countTeknisDiterima' => $countTeknisDiterima,
                'countTeknisDitolak' => $countTeknisDitolak,
                'countTeknisKonsultasi' => $countTeknisKonsultasi,
                'countKasi' => $countKasi,
                'countKabid' => $countKabid,
                'countSekretaris' => $countSekretaris,
                'countKadis' => $countKadis,
                'countUser' => $countUser,
                'countService' => $countService,
                'countIzinTerbit' => $countIzinTerbit
            ]));
        });
    }
}
