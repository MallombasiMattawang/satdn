<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgresDocument;
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

}
