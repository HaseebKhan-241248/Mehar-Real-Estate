<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Account;
use App\Models\Projects\Project;
use App\Models\Sectors\Sector;
use App\Models\Subaccount_category;
use Illuminate\Http\Request;
use Auth;

class AccountsController extends Controller
{
    public  function index()
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['accounts'] = Account::where('status','=','Active')->get();
            $data['projects'] = Project::all();
        }
        else
        {
            $data['accounts'] = Account::where('status','=','Active')->where('project_id',Auth::user()->project_id)->get();
            $data['projects'] = Project::where('id',Auth::user()->project_id)->get();
        }
        return view('admin.accounts.index',$data);
    }
    public function list()
    {
        $data['counter']  = 1;
        if((Auth::user()->role)=="Super Admin")
        {
            $data['accounts'] = Account::where('fixed',0)->get();
        }
        else
        {
            $data['accounts'] = Account::where('fixed',0)->where('project_id',Auth::user()->project_id)->get();
        }

        return view('admin.accounts.list',$data);
    }
    public function store(Request $request)
    {

        if($request->acc_id>0)
        {
//            dd($request->all());
            $type        = $request->account_type;
            $acc_type    ="";
            $subacc_type ="";
            $sub_cat     ="";
            ////////// for the account type 1
            if($type==1)
            {
                $acc_type = "Income";
                $sub_cat = $request->asset_liabilitie1;
            }
            else if($type==2){
                $acc_type = "Expense";
                $sub_cat = $request->asset_liabilitie2;
            }
            else if($type==3){
                $acc_type = "Assets";
                $sub_cat = $request->asset_liabilitie3;
            }
            else if($type==4){
                $acc_type = "Liabilities";
                $sub_cat = $request->asset_liabilitie4;
            }
            else if($type==5){
                $acc_type = "Capital";
                $sub_cat = $request->asset_liabilitie5;
            }
            //////  for the account type 2
            if($request->sub_account_type)
            {
                $subacc_type = "Subaccount";

            }
            else
            {
                $subacc_type = "Main";
            }

            Account::where('id',$request->acc_id)->update([
                'account_name'     => $request->account_name,
                'account_type'     => $acc_type,
                'sub_account_type' => $sub_cat,
                'description'      => $request->description,
                'vat_code'         => $request->vat_code,
                'parent_id'        => $request->sub_account_type,
                'note'             => $request->note,
                'open_bal'         => $request->open_bal,
                'day'              => $request->day,
                'status'           => $request->status,
                'fixed'            => 0,
                'type'             => $subacc_type,
                'project_id'          => $request->project_id,
                'sub_account_type_category' => $request->sub_account_type_category,
            ]);
            return back()->withStatus(__('Account Updated successfully.'));
        }
        else
        {
            $checking = Account::where('account_name',$request->account_name)->where('project_id',$request->project_id)->count();
            if($checking>0)
            {
                return redirect()->back()->withErrors([ 'This Account Already Exist against this Project']);
            }

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
            //////  for the account type 2
            if($request->sub_account_type)
            {
                $subacc_type = "Subaccount";

            }
            else
            {
                $subacc_type = "Main";
            }

            Account::create([
                'account_name'     => $request->account_name,
                'account_type'     => $acc_type,
                'sub_account_type' => $request->asset_liabilitie,
                'description'      => $request->description,
                'vat_code'         => $request->vat_code,
                'parent_id'        => $request->sub_account_type,
                'note'             => $request->note,
                'open_bal'         => $request->open_bal,
                'day'              => $request->day,
                'status'           => "Active",
                'fixed'            => 0,
                'type'             => $subacc_type,
                'project_id'          => $request->project_id,
                'sub_account_type_category' => $request->sub_account_type_category,
            ]);
            return back()->withStatus(__('Account Added successfully.'));
        }
    }

    public function  edit($id)
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['accounts'] = Account::where('status','=','Active')->get();
            $data['projects'] = Project::all();
        }
        else
        {
            $data['accounts'] = Account::where('status','=','Active')->where('project_id',Auth::user()->project_id)->get();
            $data['projects'] = Project::where('id',Auth::user()->project_id)->get();
        }
        $data['account']    = $account = Account::where('id',$id)->first();
        $data['categories'] = Subaccount_category::where('sub_account_type',$account->sub_account_type)->get();

//        dd($account->sub_account_type,$data['categories']);
        return view('admin.accounts.edit',$data);
    }

    public function  account_subcategory_list()
    {
        $data['categories'] = Subaccount_category::all();
        $data['counter']    = 1;
        return view('admin.accounts.subaccount_category.list',$data);
    }
    public function  create_account_subcategory()
    {
        return view('admin.accounts.subaccount_category.index');
    }
    public function  save_account_subcategory(Request  $request)
    {
        $response = Subaccount_category::saveOrUpdateCategory($request);
        return redirect()->route('account.subcategory')->withstatus($response['message']);
    }
    public function  delete_account_subcategory($id)
    {
        Subaccount_category::where('id',$id)->delete();
        return redirect()->back()->withstatus("Sub Account Category Deleted Successfully!");
    }
    public function  edit_account_subcategory($id)
    {
        $data['category'] = Subaccount_category::where('id',$id)->first();
//        dd($data['category']);
        return view('admin.accounts.subaccount_category.edit',$data);
    }
    public function  getSubacc_categories($id)
    {
        $categories = Subaccount_category::where('sub_account_type','=',$id)->get();
        return collect([
            'status' => true,
            'data'   => $categories,
        ]);
    }
}
