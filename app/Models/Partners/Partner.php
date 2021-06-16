<?php

namespace App\Models\Partners;

use App\Models\Accounts\Account;
use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hash;
class Partner extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'email',
        'address',
        'city',
        'phone1',
        'phone2',
        'password',
        'status',
        'account_id',
        'id_card_no',
        'project_id',
    ];

    public function Project_Name()
    {
        return $this->hasOne(Project::class, 'id' ,'project_id');
    }

    public static function savePartner($request)
    {
        if($request->partner_id>0)
        {
            request()->validate([
                'name'       => 'required',
                'id_card_no' => 'required',
                'phone1'     => 'required',
                'address'    => 'required',
                'project_id' => 'required',
            ]);
            parent::where('id',$request->partner_id)->update([
                'name'     => $request->name,
                'email'    => $request->email,
                'address'  => $request->address,
                'city'     => $request->city,
                'phone1'   => $request->phone1,
                'phone2'   => $request->phone2,
                'id_card_no' => $request->id_card_no,
                'project_id'=> $request->project_id,
            ]);
            return [
                "status"  => 'success',
                "message" => 'Partner Updated Successfully!'
            ];
        }
        else
        {
            request()->validate([
                'name'       => 'required',
                'id_card_no' => 'required',
                'phone1'     => 'required',
                'address'    => 'required',
                'project_id' => 'required',
            ]);

            $partner = parent::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'address'  => $request->address,
                'city'     => $request->city,
                'phone1'   => $request->phone1,
                'phone2'   => $request->phone2,
                'password' => Hash::make('12345678'),
                'id_card_no' => $request->id_card_no,
                'status'   => 1,
                'project_id'=> $request->project_id,
            ]);
            $p_id = $partner->id;
            $acc =  Account::create([
                'account_name'     => $p_id."".$request->name,
                'sub_account_type' => "Current Assets",
                'account_type'     => "Asset",
                'day'              => date('Y-m-d'),
                'status'           => "Active",
                'fixed'            => 1,
                'type'             => "Partner",
            ]);

            parent::where('id',$p_id)->update(['account_id'=>$acc->id]);
            return [
                "status"  => 'success',
                "message" => 'Partner Added Successfully!'
            ];
        }
    }
}
