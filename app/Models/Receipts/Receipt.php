<?php

namespace App\Models\Receipts;

use App\Models\Accounts\Account;
use App\Models\Bookings\Plan;
use App\Models\Marla;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id',
        'draft_no',
        'drawn_bank',
        'account_id',
        'description',
        'type',
        'status',
        'amount',
        'day',
        'dated',
    ];

    public static function saveReceipt($request)
    {
        $receipt = parent::create([
            'booking_id'  => $request->booking_id,
            'amount'      => $request->amount_paid,
            'draft_no'    => $request->draft_no,
            'drawn_bank'  => $request->drawn_bank,
            'account_id'  => $request->account_id,
            'description' => $request->description,
            'type'        => "Receipt",
            'status'      => 0,
            'day'         => $request->day,
            'dated'       => $request->dated,
        ]);
        return $receipt->id;
    }
    public function Account_Name()
    {
        return $this->hasOne(Account::class,'id','account_id');
    }
    public function MarlaSize()
    {
        return $this->hasOne(Marla::class,'id','size');
    }
}
