<?php

namespace App\Http\Controllers\Sector;

use App\Http\Controllers\Controller;
use App\Models\Projects\Project;
use App\Models\Sectors\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectorController extends Controller
{
    public function list()
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['sectors']  = Sector::all();
            $data['projects'] = Project::all();
        }
        else
        {
            $data['sectors']  = Sector::where('project_id',Auth::user()->project_id)->get();
            $data['projects'] = Project::where('id',Auth::user()->project_id)->get();
        }
        $data['counter']  = 1;                
        return view('admin.inventory_management.sectors.sector',$data);
    }
    public function store(Request $request)
    {
        $response = Sector::createORupdateSector($request);
        return back()->withStatus(__($response['message']));
    }

     public function get_sectors($project)
    {
        $sectors = Sector::where('project_id','=',$project)->get();
        return collect([
            'status' => true,
            'data'   => $sectors
        ]);
    }

}
