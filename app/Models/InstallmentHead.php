<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentHead extends Model
{
    use HasFactory;
    protected $table    = "installment_heads";
    protected $fillable = ['head','no_of_months','description','status'];
    public static function saveInstallmentHead($request)
    {
//        dd($request->all());
        if($request->head_id>0)
        {
            request()->validate([
                'head'       => 'required',
            ]);
            parent::where('id',$request->head_id)->update([
                'head'         => $request->head,
                'no_of_months' => $request->no_of_months,
                'description'  => $request->description,
//                'status'       => $request->status
            ]);


            return [
                "status"  => 'success',
                "message" => 'Installment Head Updated Successfully!'
            ];
        }
        else
        {
            request()->validate([
                'head'       => ['required', 'unique:installment_heads'],
            ]);
            parent::create([
                'head'         => $request->head,
                'no_of_months' => $request->no_of_months,
                'description'  => $request->description,
                'status'       => $request->status
            ]);
            return [
                "status"  => 'success',
                "message" => 'Installment Head Created Successfully!'
            ];
        }
    }
}
