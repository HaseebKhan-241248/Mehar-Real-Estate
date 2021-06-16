<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\Projects\Project;
use App\Models\Projects\AssignPartner;
use App\Models\Partners\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function list()
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['projects'] = Project::all();
        }
        else
        {
            $data['projects'] = Project::where('id',Auth::user()->project_id)->get();
        }
        $data['counter']  = 1;        
        $data['partners'] = Partner::all();
        return view('admin.inventory_management.projects.list',$data);
    }
    public function store(Request $request)
    {
        $response = Project::createORupdateproject($request);
       
        return back()->withStatus(__($response['message']));
    }
}
