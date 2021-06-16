<?php

namespace App\Http\Controllers\Plots;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Account;
use App\Models\Blocks\Block;
use App\Models\Bookings\Booking;
use App\Models\Contracts\Contract;
use App\Models\InstallmentHead;
use App\Models\Installments\Installment;
use App\Models\Plots\Plot;
use App\Models\Sectors\Sector;
use App\Models\Marla;
use App\Models\Projects\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PlotController extends Controller
{
    public function list()
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['blocks']   = Block::all();
            $data['plots']    = Plot::all();
            $data['sectors']  = Sector::all();
            $data['projects'] = Project::all();
        }
        else
        {
            $data['blocks']   = Block::where('project_id',Auth::user()->project_id)->get();
            $data['plots']    = Plot::where('project_id',Auth::user()->project_id)->get();
            $data['sectors']  = Sector::where('project_id',Auth::user()->project_id)->get();
            $data['projects'] = Project::where('id',Auth::user()->project_id)->get();
        }
        $data['counter']  = 1;        
        $data['sizes']    = Marla::all();
        return view('admin.inventory_management.plots.plot',$data);
    }
    public function store(Request $request)
    {
        $response = Plot::createORupdatePlot($request);
        return back()->withStatus(__($response['message']));
    }
    public function get_plots($plot_id)
    {
        $plots = Plot::where('block_id','=',$plot_id)->where('status','=',1)->get();
        return collect([
            'status' => true,
            'data'   => $plots
        ]);
    }
    public function plot_detail($id)
    {
        $data['counter']      = 1;
        $data['booking']      = Booking::where('id',$id)->first();
        $data['installments'] = Installment::where('booking_id',$id)->get();
        $data['accounts']     = Account::all();
//        $data['accounts']     = Account::where()->get();
        return view('admin.inventory_management.plots.plot_detail',$data);
    }
}
