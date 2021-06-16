<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Bookings\Booking;
use App\Models\Customers\Customer;
use App\Models\Projects\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function list()
    {
        if(Auth::user()->role=="Super Admin")
        {
            $data['customers'] = Customer::all(); 
        }
        else
        {
            $data['customers'] = Customer::where('project_id',Auth::user()->project_id)->get();
        }
        $data['counter']   = 1;        
        $data['projects']  = Project::all();
        return view('admin.inventory_management.customers.list',$data);
    }
    public function store(Request $request)
    {
        $response = Customer::saveCustomer($request);
//        if($response['val']>0)
//        {
//            return redirect()->route('customer.id_card_print',$response['val']);
//        }
        return back()->withStatus(__($response['message']));
    }
    public function id_card_print($id)
    {
        $data['customer'] = Customer::where('id',$id)->first();
        return view('admin.inventory_management.customers.customer_idcard_print',$data);
    }
    public function customer_detail($id)
    {
        $data['customer'] = Customer::where('id',$id)->first();
        $data['bookings'] = Booking::where('customer_id',$id)->get();
        return view('admin.inventory_management.customers.customer_detail',$data);
    }
}
