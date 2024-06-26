<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgresDocument;
use App\Models\TranSatdn;
use Illuminate\Support\Facades\Auth;

class HistoryServiceController extends Controller
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
        $historyServices = ProgresDocument::where('user_id', Auth::user()->id)->latest()->paginate(20);
        return view('user-page.history-page', [
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

    public function pemegangIzinDetail(Request $request, $id)
    {
        $disabled = 'disabled';
        $progresDocument = TranSatdn::findOrFail($id);

            return view('user-page.izin-edar.log-detail', [
                'progresDocument' => $progresDocument,
                'disabled' => $disabled
            ]);

    }


}
