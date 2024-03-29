<?php

namespace App\Http\Controllers;

use App\Models\TranSatdn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class historySatdnController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $historyServices = TranSatdn::where('user_id', Auth::user()->id)->latest()->paginate(20);
        return view('user-page.history-page.satsdn', [
            'historyServices' => $historyServices
        ]);
    }
    public function pemegangIzin()
    {
        $historyServices = TranSatdn::where('user_id', Auth::user()->id)->latest()->paginate(20);
        return view('user-page.izin-edar.log', [
            'historyServices' => $historyServices
        ]);
    }

}

