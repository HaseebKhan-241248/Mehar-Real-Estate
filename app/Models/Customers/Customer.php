<?php

namespace App\Models\Customers;

use App\Models\Accounts\Account;
use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hash;

class Customer extends Model
{
    use HasFactory;
    protected $table    = "customers";
    protected $fillable = [
        'name',
        'father_name',
        'email',
        'address',
        'city',
        'phone1',
        'phone2',
        'password',
        'status',
        'account_id',
        'id_card_no',
        'image',
        'project_id'
    ];
    public function Project_Name()
    {
        return $this->hasOne(Project::class,'id','project_id');
    }
    public static function saveCustomer($request)
    {
        if($request->customer_id>0)
        {
            request()->validate([
                'name'       => 'required',
                'project_id' => 'required',
                'father_name'=> 'required',
                'id_card_no' => 'required',
                'address'    => 'required',
                'phone1'     => 'required',
                'image'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName="";
//            dd($request->old_image);
            if ($request->image!=null)
            {
                $imageName = time().'.'.$request->image->extension();
                $img =  $request->image->move(public_path('images'), $imageName);
                if($request->old_image!=""  && file_exists(public_path("images/$request->old_image")) )
                {
                    unlink("images/$request->old_image");
                }
            }
            else
            {
                $imageName = $request->old_image;
            }

            parent::where('id',$request->customer_id)->update([
                'name'       => $request->name,
                'father_name'=> $request->father_name,
                'email'      => $request->email,
                'address'    => $request->address,
                'city'       => $request->city,
                'phone1'     => $request->phone1,
                'phone2'     => $request->phone2,
                'id_card_no' => $request->id_card_no,
                'image'      => $imageName,
                'project_id' => $request->project_id,
            ]);
            return [
                "val"        => 0,
                "status"  => 'success',
                "message" => 'Customer Updated Successfully!'
            ];
        }
        else
        {
            request()->validate([
                'name'       => 'required',
                'project_id' => 'required',
                'father_name'=> 'required',
                'id_card_no' => 'required',
                'address'    => 'required',
                'phone1'     => 'required',
                'image'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName="";
            if ($request->image)
            {
                $imageName = time().'.'.$request->image->extension();
                $img =  $request->image->move(public_path('images'), $imageName);
            }

           $customer = parent::create([
                'name'      => $request->name,
                'father_name'=> $request->father_name,
                'email'     => $request->email,
                'address'   => $request->address,
                'city'      => $request->city,
                'phone1'    => $request->phone1,
                'phone2'    => $request->phone2,
                'password'  => Hash::make('12345678'),
                'id_card_no'=> $request->id_card_no,
                'image'     => $imageName,
                'project_id' => $request->project_id,
                'status'   => 1,
            ]);
            $c_id = $customer->id;
            $acc =  Account::create([
                'account_name'     => $c_id."".$request->name,
                'sub_account_type' => "Current Assets",
                'account_type'     => "Asset",
                'day'              => date('Y-m-d'),
                'status'           => "Active",
                'fixed'            => 1,
                'type'             => "Customer",
            ]);

            parent::where('id',$c_id)->update(['account_id'=>$acc->id]);

            return [
                "val"        => $c_id,
                "status"  => 'success',
                "message" => 'Customer Registered Successfully!'
            ];
        }
    }
}
