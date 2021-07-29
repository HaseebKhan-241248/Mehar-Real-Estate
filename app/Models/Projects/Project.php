<?php

namespace App\Models\Projects;

use App\Models\Accounts\Account;
use App\Models\AssignPartner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;


class Project extends Model
{
    use HasFactory;
    protected $table    = "projects";
    protected $fillable = [
        'name',
        'location',
        'description',
        'status',
        'logo',

    ];
    public function GetAssignPartner()
    {
        return $this->hasOne(AssignPartner::class,'project_id','id');
    }
    public static function createORupdateproject($request)
    {
        if($request->project_id>0)
        {
                request()->validate([
                    'name'       => 'required',
                    'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

            if ($request->logo)
            {
                $imageName = time().'.'.$request->logo->extension();
                $img =  $request->logo->move(public_path('images'), $imageName);
                if($request->old_logo!=""  && file_exists(public_path("images/$request->old_logo")) )
                {
                    unlink("images/$request->old_logo");
                }
            }
            else
                {
                    $imageName = $request->old_logo;
                }

           $pro_id = parent::where('id',$request->project_id)->update([
                'name'        => $request->name,
                'location'    => $request->location,
                'description' => $request->description,
                'status'      => $request->status,
                'logo'        => $imageName,
            ]);

            AssignPartner::where('project_id',$request->project_id)->delete();
            if ($request->partner_id>0) {
                AssignPartner::create([
                    'project_id'      => $request->project_id,
                    'partner_id'      => $request->partner_id,
                    'percentage_hold' => $request->percentage_hold,
                    'status'     => 1,
                ]);
            }
            return [
                "status"  => 'success',
                "message" => 'Project Updated Successfully!'
            ];

        }
        else
        {
            request()->validate([
                'name'       => ['required', 'unique:projects'],
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

          if ($request->logo)
          {
              $imageName = time().'.'.$request->logo->extension();
              $img =  $request->logo->move(public_path('images'), $imageName);
          }

            $pro_id = parent::create([
                'name'        => $request->name,
                'location'    => $request->location,
                'description' => $request->description,
                'status'      => "Active",
                'logo'        => $imageName,
            ]);

            if ($request->partner_id) {
                AssignPartner::create([
                    'project_id' => $pro_id->id,
                    'partner_id' => $request->partner_id,
                    'percentage_hold' => $request->percentage_hold,
                    'status'     => 1,
                ]);
            }

            ///////////////// creating accounts against project /////////////////
            Account::create([
                'account_name'     => "Cash In Hand",
                'account_type'     => "Assets",
                'sub_account_type' => "Cash & Bank",
                'project_id'       => $pro_id->id,
                'fixed'            => 0,
                'day'              => date('Y-m-d'),
                'type'             => "Main",
                'type2'             => "cashinhand",
                'status'           => "Active",
            ]);
            Account::create([
                'account_name'     => "Commission Expense Account",
                'account_type'     => "Expense",
                'sub_account_type' => "Cost of Goods Sold",
                'project_id'       => $pro_id->id,
                'fixed'            => 0,
                'day'              => date('Y-m-d'),
                'type'             => "Main",
                'type2'             => "commissionExpense",
                'status'           => "Active",
            ]);
            Account::create([
                'account_name'     => "Partner Share Payable",
                'account_type'     => "Capital",
                'sub_account_type' => "Partner Equity Account",
                'project_id'       => $pro_id->id,
                'fixed'            => 0,
                'day'              => date('Y-m-d'),
                'type'             => "Main",
                'type2'             => "partner_payable",
                'status'           => "Active",
            ]);


            return [
                "status"  => 'success',
                "message" => 'Project Created Successfully!'
            ];


        }
    }
}
