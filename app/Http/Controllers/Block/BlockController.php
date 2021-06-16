<?php

namespace App\Http\Controllers\Block;

use App\Http\Controllers\Controller;
use App\Models\Blocks\Block;
use App\Models\Projects\Project;

use App\Models\Sectors\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{
    public function list()
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['sectors']   = Sector::all();
            $data['blocks']    = Block::all();
            $data['projects']  = Project::all();
        }
        else
        {
            $data['sectors']   = Sector::where('project_id',Auth::user()->project_id)->get();
            $data['blocks']    = Block::where('project_id',Auth::user()->project_id)->get();
            $data['projects']  = Project::where('id',Auth::user()->project_id)->get();
        }
        $data['counter']   = 1;        
        return view('admin.inventory_management.blocks.block',$data);
    }
    public function store(Request $request)
    {
        $response = Block::createORupdateBlock($request);
        return back()->withStatus(__($response['message']));
    }

    public function get_blocks($sector)
    {
         $blocks = Block::where('sector_id','=',$sector)->get();
        return collect([
            'status' => true,
            'data' => $blocks
        ]);
    }
}
