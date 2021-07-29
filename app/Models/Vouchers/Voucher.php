<?php

namespace App\Models\Vouchers;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Voucher extends Model
{
    protected $fillable = [
        'day',
        'particulars',
        'is_posted',
        'status',
        'type',
        'amount_in_words',
        'voucher_no',
        'total',
        'created_by',
    ];
    use HasFactory;

    public function  User_Name()
    {
        return $this->hasOne(User::class,'id','created_by');
    }
    public static function saveJournalVoucher($request)
    {
        if ($request->voucher_id>0)
        {
            return parent::where('id',$request->voucher_id)->update([
                'day'             => $request->day,
                'particulars'     => $request->particulars,
                'is_posted'       => $request->is_posted,
                'status'          => 1,
                'type'            => "Journal",
                'amount_in_words' => $request->amount_in_words,
                'voucher_no'      => $request->voucher_no,
                'total'           => $request->debit_total,
                'created_by'      => Auth::User()->id,
            ]);

        }
        else
        {
            return parent::create([
                'day'             => $request->day,
                'particulars'     => $request->particulars,
                'is_posted'       => $request->is_posted,
                'status'          => 1,
                'type'            => "Journal",
                'amount_in_words' => $request->amount_in_words,
                'voucher_no'      => $request->voucher_no,
                'total'           => $request->debit_total,
                'created_by'      => Auth::User()->id,
            ]);
        }
    }
    public static function saveBankReceiptsVoucher($request)
    {
        if($request->voucher_id>0)
        {
            return parent::where('id',$request->voucher_id)->update([
                'day'             => $request->day,
                'particulars'     => $request->particulars,
                'is_posted'       => $request->is_posted,
                'status'          => 1,
                'type'            => "Bank Receipt",
                'amount_in_words' => $request->amount_in_words,
                'voucher_no'      => $request->voucher_no,
                'total'           => $request->debit_total,
            ]);
        }
        else
        {
            return parent::create([
                'day'             => $request->day,
                'particulars'     => $request->particulars,
                'is_posted'       => $request->is_posted,
                'status'          => 1,
                'type'            => "Bank Receipt",
                'amount_in_words' => $request->amount_in_words,
                'voucher_no'      => $request->voucher_no,
                'total'           => $request->debit_total,
            ]);
        }
    }

    public static function saveCashVoucher($request)
    {
        if($request->voucher_id>0)
        {
            return parent::where('id',$request->voucher_id)->update([
                'day'             => $request->day,
                'particulars'     => $request->particulars,
                'is_posted'       => $request->is_posted,
                'status'          => 1,
                'type'            => "Cash Voucher",
                'amount_in_words' => $request->amount_in_words,
                'total'           => $request->credit_total,
            ]);
        }
        else
        {
            return parent::create([
                'day'             => $request->day,
                'particulars'     => $request->particulars,
                'is_posted'       => $request->is_posted,
                'status'          => 1,
                'type'            => "Cash Voucher",
                'amount_in_words' => $request->amount_in_words,
                'voucher_no'      => $request->voucher_no,
                'total'           => $request->credit_total,
            ]);
        }
    }
    public static function  saveDebitVoucher($request)
    {
        if($request->voucher_id>0)
        {
            return parent::where('id',$request->voucher_id)->update([
                'day'             => $request->day,
                'particulars'     => $request->particulars,
                'is_posted'       => $request->is_posted,
                'status'          => 1,
                'type'            => "Debit Voucher",
                'amount_in_words' => $request->amount_in_words,
                'total'           => $request->debit_total,
            ]);
        }
        else
        {
            return parent::create([
                'day'             => $request->day,
                'particulars'     => $request->particulars,
                'is_posted'       => $request->is_posted,
                'status'          => 1,
                'type'            => "Debit Voucher",
                'amount_in_words' => $request->amount_in_words,
                'voucher_no'      => $request->voucher_no,
                'total'           => $request->debit_total,
            ]);
        }
    }
}
