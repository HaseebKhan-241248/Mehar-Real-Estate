<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Account;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public  function index()
    {
        $data['accounts'] = Account::where('status','=','Active')->get();
        return view('admin.accounts.index',$data);
    }
    public function list()
    {
        $data['counter']  = 1;
        $data['accounts'] = Account::where('fixed',0)->get();
        return view('admin.accounts.list',$data);
    }
    public function store(Request $request)
    {
        request()->validate([
            'account_name'       => ['required', 'unique:accounts'],
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
        ]);
        return back()->withStatus(__('Account Added successfully.'));
    }
}
