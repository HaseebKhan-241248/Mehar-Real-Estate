<?php

namespace App\Http\Controllers;

use App\Models\Bookings\Booking;
use App\Models\Customers\Customer;
use App\Rules\has;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd("fsa");
        if(FacadesAuth::user()->role=="Super Admin")
        {
            $data['customers'] = Customer::all()->count();
            $data['bookings']  = Booking::all()->count();
            $data['latest_bookings'] = Booking::orderBy('id', 'desc')->take(5)->get();
//            dd($data['latest_bookings']);
        }
        else
            {
                if (!has::permission('Dashboard','Read'))
                {
                    return redirect()->route('profile.page',[ FacadesAuth::User()->id ]);
                }
                    $data['customers'] = Customer::where('project_id',FacadesAuth::user()->project_id)->count();
                    $data['bookings']  = Booking::where('project_id',FacadesAuth::user()->project_id)->count();
            }

        return view('admin.dashboard.index',$data);
    }
}
