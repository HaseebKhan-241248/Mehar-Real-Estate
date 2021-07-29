<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Account;
use App\Models\Bookings\Booking;
use App\Models\Ledger;
use Illuminate\Http\Request;

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
}
