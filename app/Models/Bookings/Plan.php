<?php

namespace App\Models\Bookings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'subplan',
        'booking_id',
        'customer_id',
        'months',
        'amount',
        'description',
        'type',
        'status',
    ];
    public static function savePlans($request)
    {
        foreach($request->months  as $key =>  $val)
        {
            parent::create([
                'subplan'     => $request->subplan[$key],
                'booking_id'  => $request->booking_id,
                'customer_id' => $request->customer_id,
                'months'      => $val,
                'amount'      => $request->amount[$key],
                'type'        => "Plan",
                'status' => 1,
            ]);
        }
        Booking::where('id',$request->booking_id)->update(['type'=>"Subplan"]);
        return [
          "message" =>'Plan Saved Successfully!'
        ];
    }
}
