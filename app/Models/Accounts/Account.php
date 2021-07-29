<?php

namespace App\Models\Accounts;

use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table    = "accounts";
    protected $fillable = [
        'account_name',
        'account_type',
        'sub_account_type',
        'description',
        'vat_code',
        'parent_id',
        'note',
        'open_bal',
        'day',
        'status',
        'fixed',
        'type',
        'project_id',
        'sub_account_type_category',
    ];

    public function Project_Name()
    {
        return $this->hasOne(Project::class,'id','project_id');
    }

    public static function savePlotAccount($plotid,$name)
    {
       return parent::create([
            'account_name'     => $plotid."-".$name,
            'account_type'     => "Income",
            'sub_account_type' => "Direct Income",
            'fixed'            => 1,
            'day'              => date('Y-m-d'),
            'type'             => "Plot",
            'status'           => "Active",
        ]);
    }
}
