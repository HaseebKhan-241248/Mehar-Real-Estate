<?php

namespace App\Http\Controllers\Intiqal;

use App\Http\Controllers\Controller;
use App\Models\Intiqal\Intiqal;
use Illuminate\Http\Request;

class IntiqalController extends Controller
{
    public function update_intiqal($ID)
    {
        $data['booking_id'] = $ID;
        $data['intiqals']   = Intiqal::where('booking_id',$ID)->get();
        $data['counter']    = 1;
        return view('admin.inventory_management.bookings.intiqal.list',$data);
    }
    public function save_intiqal(Request $request)
    {
        $response = Intiqal::saveIntiqal($request);
        return back()->withstatus($response['message']);
    }
}
