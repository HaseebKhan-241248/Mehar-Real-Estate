<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subaccount_category extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_type',
        'sub_account_type',
        'sub_account_category',
        'description',
        'type',
        'status',
    ];
    public static function  saveOrUpdateCategory($request)
    {
//dd($request->all());
        if ($request->update_id>0)
        {

            $type = $request->account_type;
            $acc_type="";
            $subacc_type="";
            ////////// for the account type 1
            if($type==1)
            {
                $acc_type = "Income";
                $subacc_type = $request->asset_liabilitie1;
            }
            else if($type==2){
                $acc_type = "Expense";
                $subacc_type = $request->asset_liabilitie2;
            }
            else if($type==3){
                $acc_type = "Assets";
                $subacc_type = $request->asset_liabilitie3;
            }
            else if($type==4){
                $acc_type = "Liabilities";
                $subacc_type = $request->asset_liabilitie4;
            }
            else if($type==5){
                $acc_type = "Capital";
                $subacc_type = $request->asset_liabilitie5;
            }
            parent::where('id',$request->update_id)->update([
                'account_type'         => $acc_type,
                'sub_account_type'     => $subacc_type,
                'sub_account_category' => $request->sub_account_category,
                'description'          => $request->description,
//                'status'               => 1,
//                'type'                 => 1,
            ]);
            return [
                'message' => "Sub Account Category Update Successfully!",
            ];
        }
        else
        {
            request()->validate([
                'asset_liabilitie'       => 'required',
                'sub_account_category'    => ['required','unique:subaccount_categories'],
            ]);
            $type = $request->account_type;
            $acc_type="";
            $subacc_type="";
            ////////// for the account type 1
            if($type==1)
            {
                $acc_type = "Income";
            }
            else if($type==2){
                $acc_type = "Expense";
            }
            else if($type==3){
                $acc_type = "Assets";
            }
            else if($type==4){
                $acc_type = "Liabilities";
            }
            else if($type==5){
                $acc_type = "Capital";
            }
            parent::create([
                'account_type'         => $acc_type,
                'sub_account_type'     => $request->asset_liabilitie,
                'sub_account_category' => $request->sub_account_category,
                'description'          => $request->description,
                'type'                 => 1,
                'status'               => 1,
            ]);
            return [
                'message' => "Sub Account Category Saved Successfully!",
            ];
        }
    }
}
