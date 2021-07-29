<?php

namespace App\Http\Controllers\Voucher;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Account;
use App\Models\Ledger;
use App\Models\Projects\Project;
use App\Models\Vouchers\Voucher;
use Illuminate\Http\Request;
use Auth;

class VoucherController extends Controller
{
    public function  journal_voucher()
    {
        $data['vouchers'] = Voucher::where('type',"Journal")->get();
        $data['counter']  = 1;
        return view('admin.vouchers.journalvouchers.list',$data);
    }
    public function  create_journal_voucher()
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['accounts'] = Account::all();
        }
        else
        {
            $data['accounts'] = Account::where('project_id',Auth::user()->project_id)->get();
        }
        $voucher = Voucher::where('type','Journal')->max('voucher_no');
//        dd($voucher);
        if($voucher)
        {
            $data['voucher_no'] = $voucher+1;
        }
        else
        {
            $data['voucher_no'] =1;
        }

        return view('admin.vouchers.journalvouchers.create',$data);
    }
    public function  save_journal_voucher(Request $request)
    {
        request()->validate([
            'day'         => 'required',
            'particulars' => 'required',
            'account_id'  => 'required',
            'debit'       => 'required',
            'credit'      => 'required',
        ]);
//        dd($request->all());
        $voucher  = Voucher::saveJournalVoucher($request);
        $response = Ledger::saveJournalVoucherEntry($request,$voucher->id);
        return redirect()->route('journal.voucher')->withstatus($response['message']);
    }

    public function delete_journal_voucher($id)
    {
        Voucher::where('id',$id)->delete();
        Ledger::where('jv_id',$id)->delete();
        return redirect()->route('journal.voucher')->withstatus("Journal Voucher Deleted Successfully!");
    }
    public function edit_journal_voucher($id)
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['accounts'] = Account::all();
        }
        else
        {
            $data['accounts'] = Account::where('project_id',Auth::user()->project_id)->get();
        }
        $data['voucher'] = Voucher::where('id',$id)->first();
        $data['entries'] = Ledger::where('jv_id',$id)->get();
        return view('admin.vouchers.journalvouchers.edit',$data);
    }

    public function update_journal_voucher(Request $request)
    {
        $voucher  = Voucher::saveJournalVoucher($request);
        Ledger::where('jv_id',$request->voucher_id)->delete();
        $response = Ledger::saveJournalVoucherEntry($request,$request->voucher_id);
        return redirect()->route('journal.voucher')->withstatus("Journal Voucher Updated Successfully!");
    }

    public function bank_receipt_voucherr()
    {
//        dd("f");
        $data['vouchers'] = Voucher::where('type',"Bank Receipt")->get();
        $data['counter']  = 1;
        return view('admin.vouchers.bank_receipt_vouchers.list',$data);
    }
    public function  create_bank_receipt_voucher()
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['accounts'] = Account::all();
        }
        else
        {
            $data['accounts'] = Account::where('project_id',Auth::user()->project_id)->get();
        }
        $voucher = Voucher::where('type','Bank Receipt')->max('voucher_no');
        if($voucher)
        {
            $data['voucher_no'] = $voucher+1;
        }
        else
        {
            $data['voucher_no'] =1;
        }
        return view('admin.vouchers.bank_receipt_vouchers.create',$data);
    }

    public function  save_bank_receipt_voucher(Request  $request)
    {
        request()->validate([
            'day'         => 'required',
            'particulars' => 'required',
            'account_id'  => 'required',
            'debit'       => 'required',
            'credit'      => 'required',
        ]);
        $voucher  = Voucher::saveBankReceiptsVoucher($request);
        $response = Ledger::BankReceiptEntry($request,$voucher->id);
        return redirect()->route('bank-receipt.voucher')->withstatus($response['message']);
    }

    public function  edit_bank_receipt_voucher($id)
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['accounts'] = Account::all();
        }
        else
        {
            $data['accounts'] = Account::where('project_id',Auth::user()->project_id)->get();
        }
        $data['voucher'] = Voucher::where('id',$id)->first();
        $data['entries'] = Ledger::where('jv_id',$id)->get();
        return view('admin.vouchers.bank_receipt_vouchers.edit',$data);
    }
    public function update_bank_receipt_voucher(Request  $request)
    {
        $voucher  = Voucher::saveBankReceiptsVoucher($request);
        Ledger::where('jv_id',$request->voucher_id)->delete();
        $response = Ledger::BankReceiptEntry($request,$request->voucher_id);
        return redirect()->route('bank-receipt.voucher')->withstatus("Bank Receipt Voucher Updated Successfully!");
    }

    public function delete_bank_receipt_voucher($id)
    {
        Voucher::where('id',$id)->delete();
        Ledger::where('jv_id',$id)->delete();
        return redirect()->route('bank-receipt.voucher')->withstatus("Bank Receipt Voucher Deleted Successfully!");
    }
    public function  cash_voucher_list()
    {
        $data['vouchers'] = Voucher::where('type',"Cash Voucher")->get();
        $data['counter']  = 1;
        return view('admin.vouchers.cash_vouchers.list',$data);
    }
    public function  create_cash_voucher()
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['accounts'] = Account::all();
        }
        else
        {
            $data['accounts'] = Account::where('project_id',Auth::user()->project_id)->get();
        }
        $voucher = Voucher::where('type','Cash Voucher')->max('voucher_no');
        if($voucher)
        {
            $data['voucher_no'] = $voucher+1;
        }
        else
        {
            $data['voucher_no'] =1;
        }
        return view('admin.vouchers.cash_vouchers.create',$data);
    }
    public function save_cash_voucher(Request $request)
    {
        request()->validate([
            'day'         => 'required',
            'particulars' => 'required',
        ]);
        $voucher  = Voucher::saveCashVoucher($request);
        $response = Ledger::CashReceiptEntry($request,$voucher->id);
        return redirect()->route('cash.voucher')->withstatus($response['message']);
    }
    public function delete_cash_voucher($id)
    {
        Voucher::where('id',$id)->delete();
        Ledger::where('jv_id',$id)->delete();
        return redirect()->route('cash.voucher')->withstatus("Cash Receipt Voucher Deleted Successfully!");
    }
    public function edit_cash_voucher($id)
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['accounts'] = Account::all();
        }
        else
        {
            $data['accounts'] = Account::where('project_id',Auth::user()->project_id)->get();
        }
        $data['voucher'] = Voucher::where('id',$id)->first();
        $data['entries'] = Ledger::where('jv_id',$id)->where('credit','>',0)->get();
        return view('admin.vouchers.cash_vouchers.edit',$data);
    }
    public function update_cash_voucher(Request $request)
    {
        Voucher::saveCashVoucher($request);
        Ledger::where('jv_id',$request->voucher_id)->delete();
        $response = Ledger::CashReceiptEntry($request,$request->voucher_id);
        return redirect()->route('cash.voucher')->withstatus("Cash Receipt Voucher Updated Successfully!");
    }
    public function debit_voucher_list()
    {
        $data['vouchers'] = Voucher::where('type',"Debit Voucher")->get();
        $data['counter']  = 1;
        return view('admin.vouchers.debit_vouchers.list',$data);
    }
    public function  create_debit_voucher()
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['accounts'] = Account::all();
        }
        else
        {
            $data['accounts'] = Account::where('project_id',Auth::user()->project_id)->get();
        }
        $voucher = Voucher::where('type','Debit Voucher')->max('voucher_no');
        if($voucher)
        {
            $data['voucher_no'] = $voucher+1;
        }
        else
        {
            $data['voucher_no'] =1;
        }
        return view('admin.vouchers.debit_vouchers.create',$data);
    }
    public function  save_debit_voucher(Request $request)
    {
        request()->validate([
            'day'         => 'required',
            'particulars' => 'required',
        ]);
        $voucher  = Voucher::saveDebitVoucher($request);
        $response = Ledger::DebitVoucherEntry($request,$voucher->id);
        return redirect()->route('debit.voucher')->withstatus($response['message']);
    }
    public function  delete_debit_voucher($id)
    {
        Voucher::where('id',$id)->delete();
        Ledger::where('jv_id',$id)->delete();
        return redirect()->route('debit.voucher')->withstatus("Debit Voucher Deleted Successfully!");
    }
    public function  edit_debit_voucher($id)
    {
        if((Auth::user()->role)=="Super Admin")
        {
            $data['accounts'] = Account::all();
        }
        else
        {
            $data['accounts'] = Account::where('project_id',Auth::user()->project_id)->get();
        }
        $data['voucher'] = Voucher::where('id',$id)->first();
        $data['entries'] = Ledger::where('jv_id',$id)->where('debit','>',0)->get();
        return view('admin.vouchers.debit_vouchers.edit',$data);
    }
    public function  update_debit_voucher(Request  $request)
    {
        Voucher::saveDebitVoucher($request);
        Ledger::where('jv_id',$request->voucher_id)->delete();
        $response = Ledger::DebitVoucherEntry($request,$request->voucher_id);
        return redirect()->route('debit.voucher')->withstatus("Debit Voucher Updated Successfully!");
    }
    public function  journal_voucher_print($id)
    {
        date_default_timezone_set("Asia/Karachi");
        $data['time']    = date("h:i-a");
        $data['journal'] = Voucher::where('id',$id)->first();
        $data['entries'] = $entry = Ledger::where('jv_id',$id)->get();
        $acc             = Account::where('id',$entry[0]->account_id)->first();
        $data['project'] = Project::where('id',$acc->project_id)->first();
        $data['counter'] = 1;
        return view('admin.vouchers.journalvouchers.print',$data);
    }
    public function  bank_receipt_voucher_print($id)
    {
        date_default_timezone_set("Asia/Karachi");
        $data['time']    = date("h:i-a");
        $data['journal'] = Voucher::where('id',$id)->first();
        $data['entries'] = $entry = Ledger::where('jv_id',$id)->get();
        $acc             = Account::where('id',$entry[0]->account_id)->first();
        $data['project'] = Project::where('id',$acc->project_id)->first();
        $data['counter'] = 1;
        return view('admin.vouchers.bank_receipt_vouchers.print',$data);
    }
}
