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
        return view('admin.inventory_management.bookings.intiqal.list',$data);
    }
    public function save_intiqal(Request $request)
    {
        $response = Intiqal::saveIntiqal($request);
        return back()->withstatus($response['message']);
    }
}
