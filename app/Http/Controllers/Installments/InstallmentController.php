<?php

namespace App\Http\Controllers\Installments;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Account;
use App\Models\Bookings\Booking;
use App\Models\Installments\Installment;
use App\Models\Ledger;
use App\Models\Receipts\Receipt;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function paid_installment(Request $request)
    {
//        echo $request->installment_id;intallmentAmount
//        'amount_paid'        => $installment->amount_paid+$paid,
//                            'installment_amount' => $installment->installment_amount-$paid,
        Installment::where('id',$request->installment_id)->update([
            'status' => 1,
        ]);
    }
    public function pay_installment($booking_id)
    {
        $installments     = Installment::where('booking_id',$booking_id)->where('status',0)->get();
        $remaining_amount = 0;
        foreach($installments as $key =>  $installment)
        {
            $remaining_amount += $installment->installment_amount;
        }
        $data['Remainingamount'] = $remaining_amount;
        $data['booking']         = Booking::where('id',$booking_id)->first();
        $data['installments']    = Installment::where('booking_id',$booking_id)->get();
        $data['counter']         = 1;
        $data['accounts']        = Account::where('fixed',0)->get();
        return view('admin.inventory_management.bookings.pay_amount',$data);
    }

    public function save_paid_installment(Request $request)
    {

        $installments      = Installment::where('booking_id',$request->booking_id)->where('description','!=','Booking-1')->where('installment_amount','>',0)->get();
    //    dd($installments);
        $paid              = $request->amount_paid;
        $amount_to_be_paid = 0;
        $receiptId         = Receipt::saveReceipt($request);
        ////// accounting entry for receipts ////////////
        Ledger::ReceiptEntry($request);
        ///////// end accounting entry for receipts//////

        $count  = 0;
        $count1 = 0;
        foreach ($installments as $key => $installment)
        {
            if ($count < $request->installment_amount_count)
            {
                    
                if($paid > 0)
                {
                    if($paid < $installment->installment_amount)
                    { 
                        // dd($installment->installment_amount);
                        Installment::where('id',$installment->id)->update([
                            'status'             => 1,
                            'amount_paid'        => $installment->amount_paid+$paid,
                            'installment_amount' => $installment->installment_amount-$paid,
                        ]);
                        $count1++;
                    }
                    else
                    {
                        // dd($installment->installment_amount,12);
                        Installment::where('id',$installment->id)->update([
                            'status'             => 1,
                            'amount_paid'        => $installment->amount_paid+$installment->installment_amount,
                            'installment_amount' => $installment->installment_amount-$installment->installment_amount,
                        ]);
                        $count1++;
                    }
                }
                $paid -= $installment->installment_amount;
                $amount_to_be_paid = $installment->installment_amount;

            }
            $count++;
        }
        return back()->withstatus(__('Amount Paid Successfully!'));
    }
}
