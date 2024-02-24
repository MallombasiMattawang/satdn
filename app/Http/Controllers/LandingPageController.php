<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\LandingPageController;

class LandingPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = Service::where('active', 1)->paginate(100); 
        return view('landing-page', [
            'services' => $services
        ]);
    }

    public function getServices(Request $request){
        $id = $request->input('serviceId');
        $service = Service::find($id);
        $retribusi ='';
        $tim = '';
        if($service->retribution == 1) {
            $retribusi = '<li><i class="fa fa-check"></i>Ada Retribusi</li>';
        }
        if($service->tim_teknis == 1) {
            $tim = '<li><i class="fa fa-check"></i> Ada Pertimbangan dari Tim Teknis DPMPTSP Kabupaten Bulukumba</li>';
        }
        
        echo '
        <!-- Project details-->
        <h4 class="text-uppercase">'.$service->name.'</h4>        
        
        <p>'.$service->description.'</p>
        <ul class="list-inline">            
            
            '.$tim.'
            '.$retribusi.'
            
        </ul>
        <table class="table table-bordered">
            <tr>
                <th>Dokumen Persayaratan</th>
                <th>Jenis File</th>
                <th>Ukuran</th>
            </tr>';
            foreach ($service->documents as $doc) {
                //
                echo '
                <tr>
                    <td> '.$doc->name.' </td>
                    <td> '.$doc->type_file.' </td>
                    <td> '.$doc->max_file.' kb</td>
                </tr>';
            }
            echo '
        </table>
        ';
    }
}
