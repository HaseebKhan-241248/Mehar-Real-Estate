<?php

namespace App\Models\Installments;

use App\Models\Bookings\Booking;
use App\Models\Ledger;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id',
        'installment_no',
        'installment_amount',
        'amount_check',
        'description',
        'cheque_no',
        'date',
        'cheque_bank',
        'party_name',
        'type',
        'status',
        'amount_paid',
        'user_id',
        'pay_to_partner',
    ];
    public static function saveInstallments($request,$booking_id)
    {
        foreach ($request->amount as $key => $value)
        {
            if($request->particular[$key]=="Booking")
            {
                $status =1;
                Ledger::saveAdvancedEntry($request,$booking_id);
            }
            else
                {
                    $status =0;
                }
            parent::create([
                'booking_id'         => $booking_id,
                'installment_amount' => $value,
                'amount_check'       => $value,
//                'amount_paid'        => $value,
                'description'        => $request->particular[$key],
                'cheque_no'          => $request->check_no[$key],
                'date'               => $request->check_date[$key],
                'cheque_bank'        => $request->check_issue[$key],
                'party_name'         => $request->party_name[$key],
                'type'               => 0,
                'status'             => $status,
            ]);
        }
        return [
            "status"  => 'success',
            "message" => 'Booking Saved Successfully!'
        ];
    }

    public static function saveInstallmentsPlans($request)
    {
        $installmentTotal = 0;
        $booking          = Booking::where('id',$request->booking_id)->first();
        $installmentrow   = Installment::where('booking_id',$request->booking_id)->get();
        /////////////////  calculating amount installments////////////////
        foreach ($installmentrow as $key => $value)
        {
            $installmentTotal += $value->installment_amount;
        }
        //dd($booking->agreed_price);
        $lastRecordDate   = Installment::where('booking_id',$request->booking_id)->max('date');
        $installment_date = Installment::where('booking_id',$request->booking_id)->first();

        $date             = new DateTime($installment_date->date);
        foreach($request->months  as $key =>  $val)
        {
            for($installment_date->date=0; $installment_date->date<=$lastRecordDate; $installment_date->date++)
            {
                $test="";
                if($installment_date->date==0)
                {
                    $test=$val-1;
                    $date->modify("+$test month");
                }
                else
                    {
                        $date->modify("+$val month");
                    }

                if($lastRecordDate >= $date->format('Y-m-d'))
                {
                    parent::create([
                        'booking_id'         => $request->booking_id,
                        'installment_amount' => $request->amount[$key],
                        'amount_check'       => $request->amount[$key],
                        'description'        => "Sub plans",
                        'cheque_no'          => "",
                        'date'               => $date->format('Y-m-d'),
                        'cheque_bank'        => "",
                        'party_name'         => "",
                        'type'               => 0,
                        'status'             => 0,
                    ]);
                }
            }
        }
        return;
    }
}
