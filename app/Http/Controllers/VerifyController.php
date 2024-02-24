<?php

namespace App\Http\Controllers;

use App\Models\ProgresDocument;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
  //
  public function index()
  {
    //$services = Service::all();
    $track = '';
    return view('verify.index', [
      'track' => $track
    ]);
  }

  public function cari(Request $request)
  {
    // menangkap data pencarian
    $cari = $request->cari;

    // mengambil data dari table progress sesuai pencarian data

    $track = ProgresDocument::where('no_invoice', $cari)->first();

    // mengirim data progress ke view index
    return view('verify.cari', ['track' => $track]);
  }
}
