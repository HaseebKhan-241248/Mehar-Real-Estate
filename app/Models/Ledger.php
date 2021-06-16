<?php

namespace App\Models;

use App\Models\Accounts\Account;
use App\Models\Customers\Customer;
use App\Models\Dealers\Dealer;
use App\Models\Marketers\Marketer;
use App\Models\Partners\Partner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Ledger extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'jv_id',
        'booking_id',
        'plot_id',
        'day',
        'debit',
        'credit',
        'remarks',
        'type',
        'status',
        'user_id',
        'bank_name',
        'cheque_no',
        'account_title',
    ];
    public static function saveAdvancedEntry($request,$booking_id)
    {
        $customer_account = Customer::where('id',$request->customer_id)->first();
        if ($request->advance_modeof_payment=="Cheque")
        {
            parent::create([
                'account_id'    => $customer_account->account_id,
                'booking_id'    => $booking_id,
                'plot_id'       => $request->plot_id,
                'day'           => $request->start_date,
                'credit'        => $request->received,
                'debit'         => 0,
                'bank_name'     => $request->advance_bank_name,
                'cheque_no'     => $request->advance_cheque_no,
                'account_title' => $request->advance_account_title,
                'remarks'       => "Advance Payment of Booking",
                'type'          => "Booking",
                'status'        => 0,
                'user_id'       => Auth::user()->id,
            ]);
        }
        else
        {
            $cash_account = Account::where('type2','=','cashinhand')->first();
            parent::create([
                'account_id'    => $customer_account->account_id,
                'booking_id'    => $booking_id,
                'plot_id'       => $request->plot_id,
                'day'           => $request->start_date,
                'credit'        => $request->received,
                'debit'         => 0,
                'remarks'       => "Advance Payment of Booking",
                'type'          => "Booking",
                'status'        => 0,
                'user_id'       => Auth::user()->id,
            ]);
            parent::create([
                'account_id'    => $cash_account->id,
                'booking_id'    => $booking_id,
                'plot_id'       => $request->plot_id,
                'day'           => $request->start_date,
                'debit'         => $request->received,
                'credit'        => 0,
                'remarks'       => "Advance Payment of Booking",
                'type'          => "Booking",
                'status'        => 0,
                'user_id'       => Auth::user()->id,
            ]);
        }
    }
    public static function saveBookingEntry($request,$booking_id)
    {
        ///////////// agreed price debit entry //////////////////////////////////
        $customer_account = Customer::where('id',$request->customer_id)->first();
        parent::create([
            'account_id' => $customer_account->account_id,
            'booking_id' => $booking_id,
            'plot_id'    => $request->plot_id,
            'day'        => $request->start_date,
            'debit'      => $request->agreed_price,
            'credit'     => 0,
            'remarks'    => "Booking",
            'type'       => "Booking",
            'status'     => 0,
            'user_id'    => Auth::user()->id,
        ]);
        //////////// agreed price credit entry //////////////////////////////////
        if($request->on_account_of>0)
        {
            parent::create([
                'account_id' => $request->on_account_of,
                'booking_id' => $booking_id,
                'plot_id'    => $request->plot_id,
                'day'        => $request->start_date,
                'debit'      => 0,
                'credit'     => $request->agreed_price,
                'remarks'    => "Booking",
                'type'       => "Booking",
                'status'     => 0,
                'user_id'    => Auth::user()->id,
            ]);
        }
        ////////////////  for the marketer entry ///////////////////////////////
        if($request->marketer_id>0)
        {
            $marketer_account   = Marketer::where('id',$request->marketer_id)->first();
            $commission_account = Account::where('type2','commissionExpense')->first();
            ///////////// for the commision account ////////////////////////////
            parent::create([
                'account_id' => $commission_account->id,
                'booking_id' => $booking_id,
                'plot_id'    => $request->plot_id,
                'day'        => $request->start_date,
                'debit'      => $request->marketer_commision_value,
                'credit'     => 0,
                'remarks'    => "Booking",
                'type'       => "Booking",
                'status'     => 0,
                'user_id'    => Auth::user()->id,
            ]);
            parent::create([
                'account_id' => $marketer_account->account_id,
                'booking_id' => $booking_id,
                'plot_id'    => $request->plot_id,
                'day'        => $request->start_date,
                'debit'      => 0,
                'credit'     => $request->marketer_commision_value,
                'remarks'    => "Booking",
                'type'       => "Booking",
                'status'     => 0,
                'user_id'    => Auth::user()->id,
            ]);
            ///////// if amount is paid to marketer///////////
            if($request->marketer_coms_value_paid>0)
            {
                parent::create([
                    'account_id' => $commission_account->id,
                    'booking_id' => $booking_id,
                    'plot_id'    => $request->plot_id,
                    'day'        => $request->start_date,
                    'debit'      => 0,
                    'credit'     => $request->marketer_coms_value_paid,
                    'remarks'    => "Paid to Marketer",
                    'type'       => "Booking",
                    'status'     => 0,
                    'user_id'    => Auth::user()->id,
                ]);
                parent::create([
                    'account_id' => $marketer_account->account_id,
                    'booking_id' => $booking_id,
                    'plot_id'    => $request->plot_id,
                    'day'        => $request->start_date,
                    'debit'      => $request->marketer_coms_value_paid,
                    'credit'     => 0,
                    'remarks'    => "Paid to Marketer",
                    'type'       => "Booking",
                    'status'     => 0,
                    'user_id'    => Auth::user()->id,
                ]);
            }
            ////////////////// end of commisssion account////////////////
        }
    }
    public static function saveDealerCommission($request,$booking_id)
    {
        $dealer_account     = Dealer::where('id',$request->dealer_id)->first();
        $commission_account = Account::where('type2','commissionExpense')->first();
        parent::create([
            'account_id' => $dealer_account->account_id,
            'booking_id' => $booking_id,
            'plot_id'    => $request->plot_id,
            'day'        => $request->start_date,
            'debit'      => 0,
            'credit'     => $request->dealer_commision_value,
            'remarks'    => "Booking",
            'type'       => "Booking",
            'status'     => 0,
            'user_id'    => Auth::user()->id,
        ]);
        parent::create([
            'account_id' => $commission_account->id,
            'booking_id' => $booking_id,
            'plot_id'    => $request->plot_id,
            'day'        => $request->start_date,
            'debit'      => $request->dealer_commision_value,
            'credit'     => 0,
            'remarks'    => "Booking",
            'type'       => "Booking",
            'status'     => 0,
            'user_id'    => Auth::user()->id,
        ]);
        /////////// if amounmt is paid to dealer
        if($request->dealer_commision_due>0)
        {
            parent::create([
                'account_id' => $dealer_account->account_id,
                'booking_id' => $booking_id,
                'plot_id'    => $request->plot_id,
                'day'        => $request->start_date,
                'debit'      => $request->dealer_commision_due,
                'credit'     => 0,
                'remarks'    => "Paid to Marketer",
                'type'       => "Booking",
                'status'     => 0,
                'user_id'    => Auth::user()->id,
            ]);
            parent::create([
                'account_id' => $commission_account->id,
                'booking_id' => $booking_id,
                'plot_id'    => $request->plot_id,
                'day'        => $request->start_date,
                'debit'      => 0,
                'credit'     => $request->dealer_commision_due,
                'remarks'    => "Paid to Dealer",
                'type'       => "Booking",
                'status'     => 0,
                'user_id'    => Auth::user()->id,
            ]);
        }
    }

    public static function ReceiptEntry($request)
    {
        $customer_account = Customer::where('id',$request->customer_id)->first();
        parent::create([
           'account_id' => $request->account_id,
           'booking_id' => $request->booking_id,
           'plot_id'    => $request->plot_id,
           'day'        => $request->day,
           'debit'      => $request->amount_paid,
           'credit'     => 0,
           'remarks'    => "Paid By Customer",
           'type'       => "Receipt",
           'status'     => 0,
           'user_id'    => Auth::user()->id,
        ]);
        parent::create([
           'account_id' => $customer_account->account_id,
           'booking_id' => $request->booking_id,
           'plot_id'    => $request->plot_id,
           'day'        => $request->day,
           'debit'      => 0,
           'credit'     => $request->amount_paid,
           'remarks'    => "Paid By Customer",
           'type'       => "Receipt",
           'status'     => 0,
           'user_id'    => Auth::user()->id,
        ]);
    }

    public static function savePartnerEntry($request,$booking_id)
    {
        $partnerid = Partner::where('id',$request->partner_id)->first();
        $partner_payble = Account::where('type2','partner_payable')->first();
        if ($request->partner_amount_a>0)
        {
            parent::create([
                'account_id' => $partnerid->account_id,
                'booking_id' => $booking_id,
                'plot_id'    => $request->plot_id,
                'day'        => $request->day,
                'debit'      => $request->partner_amount_a,
                'credit'     => 0,
                'remarks'    => "Payable to  Partner",
                'type'       => "Partner",
                'status'     => 0,
                'user_id'    => Auth::user()->id,
            ]);
            parent::create([
                'account_id' => $partner_payble->id,
                'booking_id' => $booking_id,
                'plot_id'    => $request->plot_id,
                'day'        => $request->day,
                'debit'      => 0,
                'credit'     => $request->partner_amount_a,
                'remarks'    => "Payable to  Partner",
                'type'       => "Partner",
                'status'     => 0,
                'user_id'    => Auth::user()->id,
            ]);
        }
        if ($request->partner_amount>0)
        {
            parent::create([
                'account_id' => $partnerid->account_id,
                'booking_id' => $booking_id,
                'plot_id'    => $request->plot_id,
                'day'        => $request->day,
                'debit'      => $request->partner_amount,
                'credit'     => 0,
                'remarks'    => "Payable to  Partner",
                'type'       => "Partner",
                'status'     => 0,
                'user_id'    => Auth::user()->id,
            ]);
            parent::create([
                'account_id' => $partner_payble->id,
                'booking_id' => $booking_id,
                'plot_id'    => $request->plot_id,
                'day'        => $request->day,
                'debit'      => 0,
                'credit'     => $request->partner_amount,
                'remarks'    => "Payable to  Partner",
                'type'       => "Partner",
                'status'     => 0,
                'user_id'    => Auth::user()->id,
            ]);
        }
        return;
    }
}
