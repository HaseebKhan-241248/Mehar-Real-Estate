<?php

namespace App\Http\Controllers;

use App\Models\InstallmentHead;
use Illuminate\Http\Request;

class InstallmentHeadController extends Controller
{
    public function list()
    {
        $data['counter'] = 1;
        $data['heads']   = InstallmentHead::all();
        return view('admin.master.installmentsheads.list',$data);
    }
    public function store(Request $request)
    {

        $response = InstallmentHead::saveInstallmentHead($request);
        return back()->withStatus(__($response['message']));
    }
}
