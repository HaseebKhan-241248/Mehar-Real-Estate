<?php

namespace App\Http\Controllers\Marlas;

use App\Http\Controllers\Controller;
use App\Models\Plots\Plot;
use Illuminate\Http\Request;
use App\Models\Marla;
class MarlaController extends Controller
{
    public function list()
    {
    	$data['counter'] = 1;
    	$data['marlas']  = Marla::all();
    	return view('admin.master.marlas.list',$data);
    }
    public function store(Request $request)
    {
        $response= Marla::saveMarls($request);
        return back()->withStatus(__($response['message']));
    }
    public function getMarla($plot_id)
    {
        $plot = Plot::where('id','=',$plot_id)->first();
        $marla = Marla::where('id',$plot->marla_id)->first();
        echo $marla->id."**".$marla->marla;
    }
}
