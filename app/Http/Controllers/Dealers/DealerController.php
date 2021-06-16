<?php

namespace App\Http\Controllers\Dealers;

use App\Http\Controllers\Controller;
use App\Models\Dealers\Dealer;
use App\Models\Projects\Project;
use App\Models\Tenants\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealerController extends Controller
{
    public function list()
    {
        if(Auth::user()->role=="Super Admin")
        {
            $data['dealers']  = Dealer::all();
        }
        else
        {
            $data['dealers']  = Dealer::where('project_id',Auth::user()->project_id)->get();
        }
        $data['counter']  = 1;        
        $data['projects'] = Project::all(); 
        return view('admin.inventory_management.dealers.list',$data);
    }
    public function store(Request $request)
    {
        $response = Dealer::saveDealers($request);
        return back()->withStatus(__($response['message']));
    }}
