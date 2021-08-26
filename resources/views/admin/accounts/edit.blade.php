@extends('admin.layouts.app')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('password_status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('password_status') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! Session('error') !!}</strong>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-sm-12">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">Edit Account
                            <span class="panel-subtitle">From here you can edit account</span>
                        </div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center><h3><b>Edit Account</b></h3></center>
                                <form class="user" action="{{ route('save.account') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="acc_id" value="{{ $account->id }}">
                                    @if($account->account_type=="Income")
                                        <input type="hidden" id="type" value="1">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="text-primary">Account Type</label>
                                                <br>
                                            </div>
                                            <input type="hidden" name="account_type" id="account_type_e">
                                            <div class="col-md-2">

                                                <input type="radio" checked class="" onclick="selectAccountType('1')"  id="male" name="gender" value="male">
                                                <label for="male">Income</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"   onclick="selectAccountType('2')" id="years" name="gender" value="female">
                                                <label for="female">Expense</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"  onclick="selectAccountType('3')" id="as" name="gender" value="female">
                                                <label for="female">Assets</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"  onclick="selectAccountType('4')" id="liab" name="gender" value="female">
                                                <label for="female">Liabilities</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"  onclick="selectAccountType('5')" id="cap" name="gender" value="female">
                                                <label for="female">Capital</label>
                                            </div>
                                        </div>

                                    @elseif($account->account_type=="Expense")
                                        <input type="hidden" id="type" value="2">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="text-primary">Account Type</label>
                                                <br>

                                                {{--                                                <input type="hidden" name="ac_id" value="{{ $account->id }}">--}}
                                            </div>
                                            <input type="hidden" name="account_type" id="account_type_e">
                                            <div class="col-md-2">

                                                <input type="radio"  class="" onclick="selectAccountType('1')"  id="male" name="gender" value="male">
                                                <label for="male">Income</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio" checked  onclick="selectAccountType('2')" id="years" name="gender" value="female">
                                                <label for="female">Expense</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"  onclick="selectAccountType('3')" id="as" name="gender" value="female">
                                                <label for="female">Assets</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"  onclick="selectAccountType('4')" id="liab" name="gender" value="female">
                                                <label for="female">Liabilities</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"  onclick="selectAccountType('5')" id="cap" name="gender" value="female">
                                                <label for="female">Capital</label>
                                            </div>
                                        </div>

                                    @elseif($account->account_type=="Assets")
                                        <input type="hidden" id="type" value="3">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="text-primary">Account Type</label>
                                                <br>

                                                {{--                                                <input type="hidden" name="ac_id" value="{{ $account->id }}">--}}
                                            </div>
                                            <input type="hidden" name="account_type" id="account_type_e">
                                            <div class="col-md-2">

                                                <input type="radio"  class="" onclick="selectAccountType('1')"  id="male" name="gender" value="male">
                                                <label for="male">Income</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"   onclick="selectAccountType('2')" id="years" name="gender" value="female">
                                                <label for="female">Expense</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio" checked  onclick="selectAccountType('3')" id="as" name="gender" value="female">
                                                <label for="female">Assets</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"  onclick="selectAccountType('4')" id="liab" name="gender" value="female">
                                                <label for="female">Liabilities</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"  onclick="selectAccountType('5')" id="cap" name="gender" value="female">
                                                <label for="female">Capital</label>
                                            </div>
                                        </div>

                                    @elseif($account->account_type=="Liabilities")
                                        <input type="hidden" id="type" value="4">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="text-primary">Account Type</label>
                                                <br>

                                                {{--                                                <input type="hidden" name="ac_id" value="{{ $account->id }}">--}}
                                            </div>
                                            <input type="hidden" name="account_type" id="account_type_e">
                                            <div class="col-md-2">

                                                <input type="radio"  class="" onclick="selectAccountType('1')"  id="male" name="gender" value="male">
                                                <label for="male">Income</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"   onclick="selectAccountType('2')" id="years" name="gender" value="female">
                                                <label for="female">Expense</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"  onclick="selectAccountType('3')" id="as" name="gender" value="female">
                                                <label for="female">Assets</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio" checked onclick="selectAccountType('4')" id="liab" name="gender" value="female">
                                                <label for="female">Liabilities</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"  onclick="selectAccountType('5')" id="cap" name="gender" value="female">
                                                <label for="female">Capital</label>
                                            </div>
                                        </div>
                                    @elseif($account->account_type=="Capital")
                                        <input type="hidden" id="type" value="5">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="text-primary">Account Type</label>
                                                <br>


                                            </div>
                                            <input type="hidden" name="account_type" id="account_type_e">
                                            <div class="col-md-2">

                                                <input type="radio"  class="" onclick="selectAccountType('1')"  id="male" name="gender" value="male">
                                                <label for="male">Income</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"   onclick="selectAccountType('2')" id="years" name="gender" value="female">
                                                <label for="female">Expense</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"  onclick="selectAccountType('3')" id="as" name="gender" value="female">
                                                <label for="female">Assets</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio"  onclick="selectAccountType('4')" id="liab" name="gender" value="female">
                                                <label for="female">Liabilities</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio" checked onclick="selectAccountType('5')" id="cap" name="gender" value="female">
                                                <label for="female">Capital</label>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <label class="text-primary">Sub Account type <small>(Optional)</small></label>
                                        </div>
                                        <div class="col-md-10">
                                            <!-- Icome  -->
                                            <select class="form-control getSubacc_category" id="Icome" style="display:none;" name="asset_liabilitie1">
                                                @if($account->sub_account_type == "Direct Income")
                                                    <option selected value="Direct Income">Direct Income</option>
                                                    <option value="Other Income">Other Income</option>
                                                @elseif($account->sub_account_type == "Other Income")
                                                    <option value="Direct Income">Direct Income</option>
                                                    <option selected value="Other Income">Other Income</option>
                                                @else
                                                    <option value="" >Select One</option>
                                                    <option value="Direct Income">Direct Income</option>
                                                    <option value="Other Income">Other Income</option>
                                                @endif
                                            </select>
                                            <!-- expense  -->
                                            <select class="form-control getSubacc_category" id="expense" style="display:none;" name="asset_liabilitie2">
                                                @if($account->sub_account_type == "Cost of Goods Sold")
                                                    <option value="Administration">Administration</option>
                                                    <option selected value="Cost of Goods Sold">Cost of Goods Sold</option>
                                                    <option value="Indirect Expenses">Indirect Expenses</option>
                                                @elseif($account->sub_account_type == "Indirect Expenses")
                                                    <option value="Administration">Administration</option>
                                                    <option value="Cost of Goods Sold">Cost of Goods Sold</option>
                                                    <option selected value="Indirect Expenses">Indirect Expenses</option>
                                                @elseif($account->sub_account_type == "Administration")
                                                    <option selected value="Administration">Administration</option>
                                                    <option value="Cost of Goods Sold">Cost of Goods Sold</option>
                                                    <option  value="Indirect Expenses">Indirect Expenses</option>
                                                @else
                                                    <option value="" >Select One</option>
                                                    <option value="Administration">Administration</option>
                                                    <option value="Cost of Goods Sold">Cost of Goods Sold</option>
                                                    <option  value="Indirect Expenses">Indirect Expenses</option>
                                                @endif
                                            </select>
                                            <!-- assets  -->
                                            <select class="form-control getSubacc_category" id="assets" style="display:none;" name="asset_liabilitie3">
                                                @if($account->sub_account_type == "Fixed Assets")
                                                    <option selected value="Fixed Assets">Fixed Assets</option>
                                                    <option value="Current Asstes">Current Assets</option>
                                                    <option value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Revenues">Revenues</option>
                                                    <option value="Prepayments">Prepayments</option>
                                                    <option value="Deposits">Deposits</option>
                                                    <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($account->sub_account_type == "Current Assets")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option selected value="Current Assets">Current Assets</option>
                                                    <option value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Revenues">Revenues</option>
                                                    <option value="Prepayments">Prepayments</option>
                                                    <option value="Deposits">Deposits</option>
                                                    <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($account->sub_account_type == "Accounts Receivable")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option  value="Current Asstes">Current Assets</option>
                                                    <option selected value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Revenues">Revenues</option>
                                                    <option value="Prepayments">Prepayments</option>
                                                    <option value="Deposits">Deposits</option>
                                                    <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($account->sub_account_type == "Cash & Bank")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option  value="Current Asstes">Current Assets</option>
                                                    <option  value="Accounts Receivable">Accounts Receivable</option>
                                                    <option selected value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Revenues">Revenues</option>
                                                    <option value="Prepayments">Prepayments</option>
                                                    <option value="Deposits">Deposits</option>
                                                    <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($account->sub_account_type == "Prepayments")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option  value="Current Asstes">Current Assets</option>
                                                    <option  value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Revenues">Revenues</option>
                                                    <option selected value="Prepayments">Prepayments</option>
                                                    <option value="Deposits">Deposits</option>
                                                    <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($account->sub_account_type == "Deposits")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option  value="Current Asstes">Current Assets</option>
                                                    <option  value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Revenues">Revenues</option>
                                                    <option  value="Prepayments">Prepayments</option>
                                                    <option selected value="Deposits">Deposits</option>
                                                    <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($account->sub_account_type == "Accumulated Depreciation")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option  value="Current Asstes">Current Assets</option>
                                                    <option  value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Revenues">Revenues</option>
                                                    <option  value="Prepayments">Prepayments</option>
                                                    <option  value="Deposits">Deposits</option>
                                                    <option selected value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($account->sub_account_type == "Employee Advances")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option  value="Current Asstes">Current Assets</option>
                                                    <option  value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Revenues">Revenues</option>
                                                    <option  value="Prepayments">Prepayments</option>
                                                    <option  value="Deposits">Deposits</option>
                                                    <option  value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option selected value="Employee Advances">Employee Advances</option>
                                                @elseif($account->sub_account_type == "Revenues")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option  value="Current Asstes">Current Assets</option>
                                                    <option  value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Revenues" selected>Revenues</option>
                                                    <option  value="Prepayments">Prepayments</option>
                                                    <option  value="Deposits">Deposits</option>
                                                    <option  value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option  value="Employee Advances">Employee Advances</option>
                                                @else
                                                    <option value="" >Select One</option>
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option value="Current Asstes">Current Assets</option>
                                                    <option value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Prepayments">Prepayments</option>
                                                    <option value="Deposits">Deposits</option>
                                                    <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @endif
                                            </select>
                                            <!-- liabilities  -->
                                            <select class="form-control getSubacc_category" id="liabilities" style="display:none;" name="asset_liabilitie4">
                                                @if($account->sub_account_type == "Long Term Liabilities")
                                                    <option selected value="Long Term Liabilities">Long Term Liabilities</option>
                                                    <option value="Current Liabilities">Current Liabilities</option>
                                                    <option value="Short Term">Short Term</option>
                                                    <option value="Accounts Payable">Accounts Payable</option>
                                                    <option value="Other Payable">Other Payable</option>
                                                @elseif($account->sub_account_type == "Current Liabilities")
                                                    <option value="Long Term Liabilities">Long Term Liabilities</option>
                                                    <option selected value="Current Liabilities">Current Liabilities</option>
                                                    <option value="Short Term">Short Term</option>
                                                    <option value="Accounts Payable">Accounts Payable</option>
                                                    <option value="Other Payable">Other Payable</option>
                                                @elseif($account->sub_account_type == "Short Term")
                                                    <option value="Long Term Liabilities">Long Term Liabilities</option>
                                                    <option  value="Current Liabilities">Current Liabilities</option>
                                                    <option selected value="Short Term">Short Term</option>
                                                    <option value="Accounts Payable">Accounts Payable</option>
                                                    <option value="Other Payable">Other Payable</option>
                                                @elseif($account->sub_account_type == "Accounts Payable")
                                                    <option value="Long Term Liabilities">Long Term Liabilities</option>
                                                    <option  value="Current Liabilities">Current Liabilities</option>
                                                    <option  value="Short Term">Short Term</option>
                                                    <option selected value="Accounts Payable">Accounts Payable</option>
                                                    <option value="Other Payable">Other Payable</option>
                                                @elseif($account->sub_account_type == "Other Payable")
                                                    <option value="Long Term Liabilities">Long Term Liabilities</option>
                                                    <option  value="Current Liabilities">Current Liabilities</option>
                                                    <option  value="Short Term">Short Term</option>
                                                    <option  value="Accounts Payable">Accounts Payable</option>
                                                    <option selected value="Other Payable">Other Payable</option>
                                                @else
                                                    <option value="" >Select One</option>
                                                    <option value="Long Term Liabilities">Long Term Liabilities</option>
                                                    <option value="Current Liabilities">Current Liabilities</option>
                                                    <option value="Short Term">Short Term</option>
                                                    <option value="Accounts Payable">Accounts Payable</option>
                                                    <option value="Other Payable">Other Payable</option>
                                                @endif
                                            </select>
                                            <!-- capital  -->
                                            <select class="form-control getSubacc_category" id="capital" style="display:none;" name="asset_liabilitie5">
                                                @if($account->sub_account_type == "Partner Equity Account")
                                                    <option selected value="Partner Equity Account">Partner Equity Account</option>
                                                    <option value="Partner Current Account">Partner Current Account</option>
                                                    <option value="Retained Earnings">Retained Earnings</option>
                                                @elseif($account->sub_account_type == "Partner Current Account")

                                                    <option value="Partner Equity Account">Partner Equity Account</option>
                                                    <option selected value="Partner Current Account">Partner Current Account</option>
                                                    <option value="Retained Earnings">Retained Earnings</option>
                                                @elseif($account->sub_account_type == "Retained Earnings")
                                                    <option value="Partner Equity Account">Partner Equity Account</option>
                                                    <option  value="Partner Current Account">Partner Current Account</option>
                                                    <option selected value="Retained Earnings">Retained Earnings</option>
                                                @else
                                                    <option value="" >Select One</option>
                                                    <option value="Partner Equity Account">Partner Equity Account</option>
                                                    <option value="Partner Current Account">Partner Current Account</option>
                                                    <option value="Retained Earnings">Retained Earnings</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row adminexp" >
                                        <div class="col-md-2">
                                            <label for="" class="text-primary">Sub Account Category</label>
                                        </div>
                                        <div class="col-md-10">
                                            <select name="sub_account_type_category" id="sub_account_type_category" class="select2">
                                                @forelse($categories as $category)
                                                    <option @if($category->id == $account->sub_account_type_category) selected @endif value="{{ $category->id }}">{{ $category->sub_account_category }}</option>
                                                @empty
                                                    <option value="">No Data Availible</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class=" row">
                                        <div class="col-md-6">
                                            <label class="text-primary">Account Name</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" placeholder="Account Name" class="form-control"  name="account_name" required="" value="{{$account->account_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-primary">Select Project</label>
                                            <select name="project_id" required id="" class="select2">
                                                <option value="">Select Project</option>
                                                @foreach($projects as $project)
                                                    <option @if($project->id == $account->project_id) selected @endif value="{{ $project->id }}">{{ $project->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-6">
                                            <label class="text-primary">Description</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <textarea name="description"  placeholder="Description" class="form-control">{{ $account->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-primary">Sub-Account of</label>
                                            <select class=" select2 " style="" name="sub_account_type" id="sub_account_type">
                                                <option value="" >Select One</option>
                                                @foreach($accounts as $acc)
                                                    <option @if($acc->id == $account->parent_id) selected @endif value="{{$acc->id}}">{{$acc->account_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-6">
                                            <label class="text-primary">Note</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" placeholder="Note" class="form-control" name="note" required="" value="{{ $account->note }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-primary">Vat Code</label>
                                            <select class="select2" name="vat_code" >
                                                @if($account->vat_code=="Yes Vat Included")
                                                    <option value="Yes Vat Included" selected>Yes Vat Included</option>
                                                    <option value="Vat Not Included">No Vat Not Included</option>
                                                @elseif($account->vat_code=="Vat Not Included")
                                                    <option value="Yes Vat Included">Yes Vat Included</option>
                                                    <option value="Vat Not Included" selected>No Vat Not Included</option>
                                                @else
                                                    <option value="" >Select Vat Type</option>
                                                    <option value="Yes Vat Included">Yes Vat Included</option>
                                                    <option value="Vat Not Included">No Vat Not Included</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-6">
                                            <label class="text-primary">Opening Balance</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="number" value="{{$account->open_bal}}" class="form-control" name="open_bal"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-primary">Date</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="date" class="form-control"  value="{{ $account->day}}" name="day"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="" class="text-primary">Status</label>
                                            <select   name="status" id="" class="select2">
                                                @if($account->status == "Active")
                                                    <option  selected value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                @elseif($account->status == "Inactive")
                                                    <option value="Active">Active</option>
                                                    <option selected value="Inactive">Inactive</option>
                                                @else
                                                    <option value="">Select Status</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    @if(\Auth::user()->role == 'Super Admin')
                                        <button  type="submit" name="" class="btn btn-primary ">
                                            Update
                                        </button>
                                    @else
                                        @can('Manage Accounts','Update')
                                            <button  type="submit" name="" class="btn btn-primary ">
                                                Update
                                            </button>
                                        @endcan
                                    @endif

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" defer>
        $(document).ready(function() {

            let  type = $('#type').val();
            // alert(type);
            selectAccountType(type);
            App.formElements();
        });
        function selectAccountType(val){
            if(val == '1') {
                $('#Icome').show();
                $('#expense').hide();
                $('#assets').hide();
                $('#liabilities').hide();
                $('#capital').hide();
                $('#account_type_e').val(val);

            }
            if(val == '2') {
                $('#Icome').hide();
                $('#expense').show();
                $('#assets').hide();
                $('#liabilities').hide();
                $('#capital').hide();
                $('#account_type_e').val(val);
            }
            if(val == '3') {
                console.log('333333');
                $('#Icome').hide();
                $('#expense').hide();
                $('#assets').show();
                $('#liabilities').hide();
                $('#capital').hide();
                $('#account_type_e').val(val);
            }
            if(val == '4') {
                $('#Icome').hide();
                $('#expense').hide();
                $('#assets').hide();
                $('#liabilities').show();
                $('#capital').hide();
                $('#account_type_e').val(val);
            }
            if(val == '5') {
                $('#Icome').hide();
                $('#expense').hide();
                $('#assets').hide();
                $('#liabilities').hide();
                $('#capital').show();
                $('#account_type_e').val(val);
            }
        }

        const baseurl = "{{url('/')}}";
        $("body").on('change','.getSubacc_category',function (){
            let acc_category = $(this).val();
            $('#sub_account_type_category').html('');
            $('#sub_account_type_category').append('');
            {{--var a = @php   Str::slug(acc_category); @endphp;--}}
            var b = "baseurl/getSubacc_categories/'+acc_category+'";
            // alert(b);
            $.ajax({
                url:`${baseurl}/getSubacc_categories/${acc_category}`,
                method:'GET',
                success: function (response) {
                    console.log(response);
                    $('#sub_account_type_category').append('<option value="">Select One</option>');
                    response.data.map(function (data){
                        let  html = '<option value="'+ data.id +'">'+data.sub_account_category+'</option>'
                        $('#sub_account_type_category').append(html);
                    });
                },
                error: function (error) {
                    console.log('error');
                    console.log(error);
                }
            })
        });

    </script>
@endsection

