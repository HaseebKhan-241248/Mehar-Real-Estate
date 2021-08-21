<?php

namespace App\Models\Marketers;

use App\Models\Accounts\Account;
use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hash;
class Marketer extends Model
{
    use HasFactory;
    protected $table    = "marketers";
    protected $fillable = [
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
    public static  function saveMarketer($request)
    {

        if($request->marketer_id>0)
        {
            request()->validate([
                'name'       => 'required',
                'address'    => 'required',
                'phone1'     => 'required',
                'id_card_no' => 'required',
                'project_id' => 'required',
            ]);
            parent::where('id',$request->marketer_id)->update([
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
                "message" => 'Marketer Updated Successfully!'
            ];
        }
        else
        {
            request()->validate([
                'name'       => 'required',
                'address'    => 'required',
                'phone1'     => 'required',
                'id_card_no' => 'required',
                'project_id' => 'required',
            ]);
           $marketer = parent::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'address'  => $request->address,
                'city'     => $request->city,
                'phone1'   => $request->phone1,
                'phone2'   => $request->phone2,
                'password' => Hash::make('12345678'),
               'id_card_no' => $request->id_card_no,
               'project_id' => $request->project_id,
                'status'   => 1,
            ]);
            $m_id = $marketer->id;
            $acc =  Account::create([
                'account_name'     => $m_id."".$request->name,
                'sub_account_type' => "Current Assets",
                'account_type'     => "Asset",
                'day'              => date('Y-m-d'),
                'status'           => "Active",
                'fixed'            => 1,
                'type'             => "Marketer",
                'project_id'       => $request->project_id,
            ]);

            parent::where('id',$m_id)->update(['account_id'=>$acc->id]);
            return [
                "status"  => 'success',
                "message" => 'Marketer Registered Successfully!'
            ];
        }
    }
}
