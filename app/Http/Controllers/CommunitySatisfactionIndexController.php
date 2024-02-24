<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgresDocument;
use App\Models\CommunitySatisfactionIndex;

class CommunitySatisfactionIndexController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function store(Request $request){
        $request->validate([            
            'name' => 'required',
            'service' => 'required',
            'rate' => 'required',
            'testimony' => 'required',
        ]);

        $store = CommunitySatisfactionIndex::create([
            'name' => $request->name,
            'service' => $request->service,
            'rate' => $request->rate,
            'testimony' => $request->testimony
        ]);

        $store->save();

        ProgresDocument::where("id", $request->id)
            ->update([
                'ikm' => 'YES',
                'rate_ikm' => $request->rate,
                'note_ikm' => $request->testimony,
            ]);

        return redirect()->back()->with('message', 'Terimakasih Testimoni anda telah direkam');

    }
}
