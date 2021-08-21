<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bookings\Booking;
use App\Models\Customers\Customer;
use App\Rules\has;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {

        if(Auth::user()->role=="Super Admin")
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
                    return redirect()->route('profile.page',[ Auth::User()->id ]);
                }

                    $data['customers'] = Customer::where('project_id',Auth::user()->project_id)->count();
                    $data['bookings']  = Booking::where('project_id',Auth::user()->project_id)->count();
            }
        return view('admin.dashboard.index',$data);
    }
}
