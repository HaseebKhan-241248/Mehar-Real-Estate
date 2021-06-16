<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Account;
use App\Models\Bookings\Booking;
use App\Models\Installments\Installment;
use App\Models\Ledger;
use Illuminate\Http\Request;
use App\Models\Partners\Partner;
use App\Models\Projects\Project;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PartnerController extends Controller
{
    public function list()
    {
        if(FacadesAuth::user()->role=="Super Admin")
        {
            $data['partners'] = Partner::all();
        }
        else
        {
            $data['partners'] = Partner::where('project_id',FacadesAuth::user()->project_id)->get();
        }
        $data['counter']  = 1;    
        $data['projects'] = Project::all();
        return view('admin.partners.list',$data);
    }
    public function store(Request $request)
    {
        $response = Partner::savePartner($request);
        return back()->withStatus(__($response['message']));
    }
    public function partners_share()
    {
        if(FacadesAuth::user()->role=="Super Admin")
        {
            $data['partners'] = Partner::all();
        }
        else
        {
            $data['partners'] = Partner::where('project_id',FacadesAuth::user()->project_id)->get();
        }
        $data['accounts'] = Account::where('fixed',0)->get();        
        return view('admin.partners.partner_detail',$data);
    }
    public function partner_amount_detail(Request $request)
    {
        $data['bookings'] = Booking::where('partner_id',$request->partnerid)->get();
        $data['counter']  = 1;
        $result           = view('admin.partners.partner_detail_render',$data)->render();
        return response()->json([
            'result' => $result
        ]);
    }
    public function payToPartner(Request $request)
    {
       $partner_account = Partner::where('id',$request->partner_id)->first();

        foreach($request->amount_pay as $key => $amount)
        {
            if($amount>0)
            {
                $oldBooking = Booking::where('id',$request->booking_id[$key])->first();
                Booking::where('id',$request->booking_id[$key])->update([
                    'paid_to_partner' => $oldBooking->paid_to_partner + $amount,
                ]);
                Installment::where('id',$request->booking_id[$key])->update([
                    'pay_to_partner' => "Paid",
                ]);
                
                
                ////////////   entry in ledger table of  debit ////////////////////
                Ledger::create([
                    'account_id' => $partner_account->account_id,
                    'booking_id' => $request->booking_id[$key],
                    'plot_id'    => $request->plot_id[$key],
                    'day'        => $request->day,
                    'debit'      => $request->amount_paid_to_partner,
                    'credit'     => 0,
                    'remarks'    => "Pay to Partner",
                    'type'       => "Plot Payment",
                    'status'     => "Paid",
                    'user_id'    => Auth::user()->id,
                ]);

                ////////////   entry in ledger table of  Credit ////////////////////
                Ledger::create([
                    'account_id' => $request->account_id,
                    'booking_id' => $request->booking_id[$key],
                    'plot_id'    => $request->plot_id[$key],
                    'day'        => $request->day,
                    'debit'      => 0,
                    'credit'     => $amount,
                    'remarks'    => "Pay to Partner",
                    'type'       => "Plot Payment",
                    'status'     => "Paid",
                    'user_id'    => Auth::user()->id,
                ]);
            }
        }
        return back()->withstatus(__("Amount Paid to Partner Successfully!"));
    }
}
