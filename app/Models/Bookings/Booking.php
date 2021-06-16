<?php

namespace App\Models\Bookings;

use App\Models\Blocks\Block;
use App\Models\Dealers\Dealer;
use App\Models\Installments\Installment;
use App\Models\Marla;
use App\Models\Plots\Plot;
use App\Models\Projects\Project;
use App\Models\Sectors\Sector;
use App\Models\Customers\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class Booking extends Model
{
    use HasFactory;
    protected $table    = "bookings";
    protected $fillable = [
        'day',
        'customer_id',
        'customer_contact',
        'project_id',
        'sector_id',
        'block_id',
        'plot_id',
        'size',
        'intiqal_g',
        'intiqal_a',
        'intiqal_diff',
        'received',
        'partner_amount',
        'partner_amount_a',
        'paid_to_partner',
        'equity_difference',
        'agreed_price',
        'remaining_amount',
        'rate_marla',
        'dp_per',
        'marketer_id',
        'marketer_commision_per',
        'marketer_commision_value',
        'marketer_coms_formula',
        'marketer_commision_due',
        'dealer_id',
        'dealer_commision_per',
        'dealer_commision_value',
        'coms_formula',
        'dealer_commision_due',
        'status',
        'type',
        'rf',
        'head_id',
        'mode_of_payment',
        'start_date',
        'end_date',
        'installment_amount',
        'possession',
        'no_of_installments',
        'marketer_coms_value_paid',
        'advance_modeof_payment',
        'user_id',
        'discount',
        'partner_id',
        'intiqal_attachment',
    ];
    public function Customer_Name()
    {
        return $this->hasOne(Customer::class,'id','customer_id');
    }
    public function MarlaSize()
    {
        return $this->hasOne(Marla::class,'id','size');
    }
    public function Dealer_Name()
    {
        return $this->hasOne(Dealer::class,'id','dealer_id');
    }
    public function Project_Name()
    {
        return $this->hasOne(Project::class,'id','project_id');
    }
    public function Sector_Name()
    {
        return $this->hasOne(Sector::class,'id','sector_id');
    }
    public function Block_Name()
    {
        return $this->hasOne(Block::class,'id','block_id');
    }
    public function Plot_Name()
    {
        return $this->hasOne(Plot::class,'id','plot_id');
    }
    public function BookingPlans()
    {
        return $this->hasMany(Plan::class,'booking_id','id');
    }
    public function Installments()
    {
        return $this->hasMany(Installment::class,'booking_id','id');
    }
    public static function saveBooking($request)
    {
        $old = Booking::where('sector_id',$request->sector_id)->where('plot_id',$request->plot_id)->count();
        if($old>0)
        {
            return [
                "status"  => 'danger',
                "message" => 'Cannot Create Booking Create Plot Already been sold!'
            ];
        }

     
        return parent::create([
            'day'                      => $request->day,
            'customer_id'              => $request->customer_id,
            'customer_contact'         => $request->customer_contact,
            'project_id'               => $request->project_id,
            'sector_id'                => $request->sector_id,
            'block_id'                 => $request->block_id,
            'plot_id'                  => $request->plot_id,
            'size'                     => $request->size,
            'intiqal_g'                => $request->intiqal_g,
            'intiqal_a'                => $request->intiqal_a,
            'intiqal_diff'             => $request->intiqal_diff,
            'received'                 => $request->received,
            'partner_amount'           => $request->partner_amount,
            'partner_amount_a'         => $request->partner_amount_a,
            'equity_difference'        => $request->equity_difference,
            'agreed_price'             => $request->agreed_price,
            'remaining_amount'         => $request->remaining_amount,
            'rate_marla'               => $request->rate_marla,
            'dp_per'                   => $request->dp_per,
            'dealer_id'                => $request->dealer_id,
            'dealer_commision_per'     => $request->dealer_commision_per,
            'dealer_commision_value'   => $request->dealer_commision_value,
            'coms_formula'             => $request->coms_formula,
            'dealer_commision_due'     => $request->dealer_commision_due,
            'status'                   => '0',
            'type'                     => $request->type,
            'rf'                       => $request->rf,
            'marketer_id'              => $request->marketer_id,
            'marketer_commision_per'   => $request->marketer_commision_per,
            'marketer_commision_value' => $request->marketer_commision_value,
            'marketer_coms_formula'    => $request->marketer_coms_formula,
            'marketer_commision_due'   => $request->marketer_commision_due,
            'head_id'                  => $request->head_id,
            'mode_of_payment'          => $request->mode_of_payment,
            'start_date'               => $request->start_date,
            'installment_amount'       => $request->installment_amount,
            'possession'               => $request->possession,
            'no_of_installments'       => $request->no_of_installments,
            'marketer_coms_value_paid' => $request->marketer_coms_value_paid,
            'advance_modeof_payment'   => $request->advance_modeof_payment,
            'end_date'                 => $request->end_date,
            'discount'                 => $request->discount,
            'user_id'                  => FacadesAuth::user()->id,
            'partner_id'               => $request->partner_id,
            
        ]);
    }
}
