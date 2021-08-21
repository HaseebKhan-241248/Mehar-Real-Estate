<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Account;
use App\Models\Ledger;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public  function  total_receiveable()
    {
        return view('reports.general_reports.total_receivable');
    }
    public function get_total_receiveable(Request $request)
    {
        if($request->plot_id=="All")
        {
            $accounts         = Account::where('project_id',$request->project_id)->pluck('id');
            $data['journals'] = Ledger::whereIn('account_id',$accounts)->where('status',0)->get();
            $result = view('reports.general_reports.total_receivable_render',$data)->render();
            return response()->json([
                'result' => $result,
            ]);
        }
        else
        {

        }
    }
}
