<?php

namespace App\Http\Controllers;

use App\Models\PemegangIzin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IzinEdarController extends Controller
{
    public function index()
    {
        $data = PemegangIzin::where('user_id', Auth::user()->id)->latest()->paginate(20);
        return view('user-page.izin-edar.index', [
            'data' => $data
        ]);
    }

    public function form($id)
    {
        $data = PemegangIzin::where('id', $id)->first();
        return view('user-page.izin-edar.create', [
            'data' => $data
        ]);
    }
}
