<?php

namespace App\Http\Controllers\Marketers;

use App\Http\Controllers\Controller;
use App\Models\Marketers\Marketer;
use App\Models\Projects\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketerController extends Controller
{
    public function list()
    {
        if(Auth::user()->role=="Super Admin")
        {
            $data['marketers'] = Marketer::all();
        }
        else
        {
            $data['marketers'] = Marketer::where('project_id',Auth::user()->project_id)->get();
        }
        $data['counter']   = 1;        
        $data['projects']  = Project::all();
        return view('admin.inventory_management.marketers.list',$data);
    }
    public function store(Request $request)
    {
       $response = Marketer::saveMarketer($request);
        return back()->withStatus(__($response['message']));
    }
}
