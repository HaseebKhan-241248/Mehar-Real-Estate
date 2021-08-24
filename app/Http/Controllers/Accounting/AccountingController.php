<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Account;
use App\Models\Bookings\Booking;
use App\Models\Ledger;
use App\Models\Projects\Project;
use Illuminate\Http\Request;
use DB;

class AccountingController extends Controller
{
    public function  general_journal()
    {
        return view('reports.accountingreports.general_journal');
    }
    public function  get_general_journal(Request $request)
    {
        $start     = $request->start;
        $end       = $request->end;
        $projectId = $request->project_id;
        $accounts  = Account::where('project_id',$projectId)->pluck('id');
        $data['journals'] = Ledger::whereBetween('day', [$start, $end])->whereIn('account_id',$accounts)->where('status',0)->get();
        $result           = view('reports.accountingreports.general_journal_render',$data)->render();
        return response()->json([
            'result' => $result
        ]);
    }
    public function  general_ledger()
    {
        return view('reports.accountingreports.general_ledger');
    }
    public function  get_general_ledger(Request $request)
    {
        $start     = $request->start;
        $end       = $request->end;
        $projectId = $request->project_id;
        $accounts  = Account::where('project_id',$projectId)->pluck('id');

        $data['ledgers'] = Ledger::whereBetween('day', [$start, $end])->whereIn('account_id',$accounts)->where('status',0)
            ->select([DB::raw("SUM(debit) as debit"), DB::raw("SUM(credit) as credit"),'account_id'])
            ->groupBy('account_id')
            ->get();
        $data['startdate'] = $start;
        $data['enddate']   = $end;
        $data['project']   = Project::where('id',$projectId)->first();
        $result           = view('reports.accountingreports.general_ledger_render',$data)->render();
        return response()->json([
            'result' => $result,
        ]);
    }

    public function  account_ledger(Request $request,$id)
    {
//        dd($id);
        $data['ledgers']      = Ledger::where('account_id',$id)->where('status',0)->get();
        $data['account']      = Account::where('id',$id)->first();
        $data['startdate']    = $request->start;
        $data['enddate']      = $request->end;
        $data['project_name'] = $request->project_name;
        return view('reports.accountingreports.account_ledger',$data);
    }
}
