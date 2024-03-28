<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use App\Models\PemegangIzin;
use App\Models\TranSatdn;
use App\Models\TranSatdnLampiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IzinEdarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $data = PemegangIzin::where('user_id', Auth::user()->id)->latest()->paginate(20);
        return view('user-page.izin-edar.index', [
            'data' => $data
        ]);
    }

    public function form($id)
    {
        $data = PemegangIzin::findOrFail($id);
        if (Auth::user()->id != $data->user_id) {
            return redirect('/home');
        }

        $admin_teknis = AdminUser::where('id', '>', '25')->get();
        return view('user-page.izin-edar.create', [
            'data' => $data,
            'admin_teknis' => $admin_teknis
        ]);
    }

    public function store(Request $request)
    {
        $data = PemegangIzin::findOrFail($request->pemegang_izin_id);
        if (Auth::user()->id != $data->user_id) {
            return redirect('/home');
        }
        $validatedData = $request->validate([
            'no_permohonan_angkut' => 'required',
            'nama_penerima' => 'required',
            'telepon_penerima' => 'required',
            'alamat_lengkap_penerima' => 'required',
            'alat_angkut' => 'required',
            'dari' => 'required',
            'ke' => 'required',
            'admin_teknis' => 'required',
            'jumlah_kirim' => 'required|numeric|max:' . ($data->kuota - $data->kuota_digunakan),
            'file_permohonan' => 'required|mimes:pdf|max:2048',
            'nama_indonesia.*' => 'required|string',
            'nama_latin.*' => 'required|string',
            'jumlah.*' => 'required|integer',
            'keterangan.*' => 'nullable|string',
        ], [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus berupa angka',
            'jumlah_kirim.max' => 'Jumlah kirim tidak boleh melebihi kuota (' . ($data->kuota - $data->kuota_digunakan) . ')',
            'file_permohonan.max' => 'Ukuran file maksimal adalah 2048 KB atau 2 MB',
            'file_permohonan.mimes' => 'Jenis file harus PDF',
        ]);

         // Filter array yang memiliki setidaknya satu input dengan nilai
         $filteredData = array_filter($validatedData['nama_indonesia'], function($key) use ($validatedData) {
            return $validatedData['nama_indonesia'][$key] !== '';
        }, ARRAY_FILTER_USE_KEY);

        $file = $request->file('file_permohonan');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        // File extension
        $extension = $file->getClientOriginalExtension();

        // File upload location
        $location = 'uploads/files';

        // Upload file
        $file->move($location, $filename);

        // File path
        $filepath = 'uploads/files/' . $filename;

        $awal = 'KSDA';
        $lastId = TranSatdn::max('id');
        $invoice = sprintf("%03s",  abs($lastId + 1) . '-' . $awal . '/' . $data->id . '/' . date('Y'));

        $progresDocument = TranSatdn::create([
            'user_id' => Auth::user()->id,
            'pemegang_izin_id' => $data->id,
            'no_permohonan_angkut' => $request->no_permohonan_angkut,
            'tgl_permohonan_angkut' => $request->tgl_permohonan_angkut,
            'no_satdn_asal' => $request->no_satdn_asal,
            'tgl_satdn_asal' => $request->tgl_satdn_asal,
            'file_permohonan' => $filepath,
            'nama_penerima' => $request->nama_penerima,
            'telepon_penerima' => $request->telepon_penerima,
            'fax_penerima' => $request->fax_penerima,
            'alamat_lengkap_penerima' => $request->alamat_lengkap_penerima,
            'alat_angkut' => $request->alat_angkut,
            'dari' => $request->dari,
            'ke' => $request->ke,
            'jumlah_kirim' => $request->jumlah_kirim,
            'jenis_tsl' => $data->jenis_tsl,
            'satuan' => $data->satuan,
            'invoice' => $invoice,
            'admin_teknis' => $request->admin_teknis,
            'status' => 'VERIFIKASI TEKNIS',
            'posisi' => '-'
        ]);
        $progresDocument->save();

        $tranSatdnId = $progresDocument->getKey();

        foreach ($filteredData as $key => $value) {
            TranSatdnLampiran::create([
                'tran_satdn_id' => $tranSatdnId,
                'nama_indonesia' => $validatedData['nama_indonesia'][$key],
                'nama_latin' => $validatedData['nama_latin'][$key],
                'jumlah' => $validatedData['jumlah'][$key],
                'keterangan' => $validatedData['keterangan'][$key] ?? null,
            ]);
        }

        PemegangIzin::where("id",  $data->id,)
            ->update([
                'kuota_digunakan' => $data->kuota_digunakan + $request->jumlah_kirim,
                'kuota_sisa' => $data->kuota - $request->jumlah_kirim,
            ]);

            return redirect()->route('home')->with('message', 'Permohonan Sats-DN Berhasil Dikirim, silahkan monitoring pada Tracking Izin');
    }
}
