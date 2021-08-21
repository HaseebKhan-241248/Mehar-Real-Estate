<?php

namespace App\Models\Dealers;

use App\Models\Accounts\Account;
use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hash;

class Dealer extends Model
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
        return $this->hasOne(Project::class,'id','project_id');
    }
    public static function saveDealers($request)
    {
        if($request->dealer_id>0)
        {
            request()->validate([
                'name'       => 'required',
                'project_id'       => 'required',
                'id_card_no' => 'required',
                'address'    => 'required',
                'phone1'     => 'required',
            ]);
            parent::where('id',$request->dealer_id)->update([
                'name'     => $request->name,
                'email'    => $request->email,
                'address'  => $request->address,
                'city'     => $request->city,
                'phone1'   => $request->phone1,
                'phone2'   => $request->phone2,
                'id_card_no' => $request->id_card_no,
                'project_id' => $request->project_id,
            ]);
            return [
                "status"  => 'success',
                "message" => 'Dealer Updated Successfully!'
            ];
        }
        else
        {
            request()->validate([
                'name'       => 'required',
                'project_id'       => 'required',
                'id_card_no' => 'required',
                'address'    => 'required',
                'phone1'     => 'required',
            ]);
           $dealer = parent::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'address'  => $request->address,
                'city'     => $request->city,
                'phone1'   => $request->phone1,
                'phone2'   => $request->phone2,
                'password' => Hash::make('12345678'),
               'id_card_no'=> $request->id_card_no,
                'status'   => 1,
                'project_id' => $request->project_id,
            ]);
            $d_id = $dealer->id;
            $acc =  Account::create([
                'account_name'     => $d_id."".$request->name,
                'sub_account_type' => "Current Assets",
                'account_type'     => "Asset",
                'day'              => date('Y-m-d'),
                'status'           => "Active",
                'fixed'            => 1,
                'type'             => "Dealer",
                'project_id'       => $request->project_id,

            ]);

            parent::where('id',$d_id)->update(['account_id'=>$acc->id]);
            return [
                "status"  => 'success',
                "message" => 'Dealer Registered Successfully!'
            ];
        }
    }
}
