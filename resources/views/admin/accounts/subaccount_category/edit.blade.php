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
                        <div class="panel-heading panel-heading-divider">Edit Sub Account Category
                            <span class="panel-subtitle">From here you can edit sub account category</span>
                        </div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center>
                                    <h3>
                                        <b>Edit Sub Account Category</b>
                                    </h3>
                                </center>
                                <form class="user" action="{{ route('save.subaccount_category') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
{{--                                    <input type="hidden" name="ac_id" value="{{ $category->id }}">--}}
                                    @if($category->account_type=="Income")
                                        <input type="hidden" id="type" value="1">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="text-primary">Account Type</label>
                                                <br>
{{--                                                <input type="hidden" name="ac_id" value="{{ $category->id }}">--}}
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

                                    @elseif($category->account_type=="Expense")
                                        <input type="hidden" id="type" value="2">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="text-primary">Account Type</label>
                                                <br>

{{--                                                <input type="hidden" name="ac_id" value="{{ $category->id }}">--}}
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

                                    @elseif($category->account_type=="Assets")
                                        <input type="hidden" id="type" value="3">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="text-primary">Account Type</label>
                                                <br>

{{--                                                <input type="hidden" name="ac_id" value="{{ $category->id }}">--}}
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

                                    @elseif($category->account_type=="Liabilities")
                                        <input type="hidden" id="type" value="4">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="text-primary">Account Type</label>
                                                <br>

{{--                                                <input type="hidden" name="ac_id" value="{{ $category->id }}">--}}
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
                                    @elseif($category->account_type=="Capital")
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
                                            <select class="form-control" id="Icome" style="display:none;" name="asset_liabilitie1">
                                                @if($category->sub_account_type == "Direct Income")
                                                    <option selected value="Direct Income">Direct Income</option>
                                                    <option value="Other Income">Other Income</option>
                                                @elseif($category->sub_account_type == "Other Income")
                                                    <option value="Direct Income">Direct Income</option>
                                                    <option selected value="Other Income">Other Income</option>
                                                @else
                                                    <option value="" >Select One</option>
                                                    <option value="Direct Income">Direct Income</option>
                                                    <option value="Other Income">Other Income</option>
                                                @endif
                                            </select>
                                            <!-- expense  -->
                                            <select class="form-control" id="expense" style="display:none;" name="asset_liabilitie2">
                                                @if($category->sub_account_type == "Cost of Goods Sold")
                                                    <option value="Administration">Administration</option>
                                                    <option selected value="Cost of Goods Sold">Cost of Goods Sold</option>
                                                    <option value="Indirect Expenses">Indirect Expenses</option>
                                                @elseif($category->sub_account_type == "Indirect Expenses")
                                                    <option value="Administration">Administration</option>
                                                    <option value="Cost of Goods Sold">Cost of Goods Sold</option>
                                                    <option selected value="Indirect Expenses">Indirect Expenses</option>
                                                @elseif($category->sub_account_type == "Administration")
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
                                            <select class="form-control" id="assets" style="display:none;" name="asset_liabilitie3">
                                                @if($category->sub_account_type == "Fixed Assets")
                                                    <option selected value="Fixed Assets">Fixed Assets</option>
                                                    <option value="Current Asstes">Current Assets</option>
                                                    <option value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Prepayments">Prepayments</option>
                                                    <option value="Deposits">Deposits</option>
                                                    <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($category->sub_account_type == "Current Assets")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option selected value="Current Assets">Current Assets</option>
                                                    <option value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Prepayments">Prepayments</option>
                                                    <option value="Deposits">Deposits</option>
                                                    <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($category->sub_account_type == "Accounts Receivable")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option  value="Current Asstes">Current Assets</option>
                                                    <option selected value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Prepayments">Prepayments</option>
                                                    <option value="Deposits">Deposits</option>
                                                    <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($category->sub_account_type == "Cash & Bank")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option  value="Current Asstes">Current Assets</option>
                                                    <option  value="Accounts Receivable">Accounts Receivable</option>
                                                    <option selected value="Cash & Bank">Cash & Bank</option>
                                                    <option value="Prepayments">Prepayments</option>
                                                    <option value="Deposits">Deposits</option>
                                                    <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($category->sub_account_type == "Prepayments")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option  value="Current Asstes">Current Assets</option>
                                                    <option  value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option selected value="Prepayments">Prepayments</option>
                                                    <option value="Deposits">Deposits</option>
                                                    <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($category->sub_account_type == "Deposits")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option  value="Current Asstes">Current Assets</option>
                                                    <option  value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option  value="Prepayments">Prepayments</option>
                                                    <option selected value="Deposits">Deposits</option>
                                                    <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($category->sub_account_type == "Accumulated Depreciation")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option  value="Current Asstes">Current Assets</option>
                                                    <option  value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option  value="Prepayments">Prepayments</option>
                                                    <option  value="Deposits">Deposits</option>
                                                    <option selected value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option value="Employee Advances">Employee Advances</option>
                                                @elseif($category->sub_account_type == "Employee Advances")
                                                    <option value="Fixed Assets">Fixed Assets</option>
                                                    <option  value="Current Asstes">Current Assets</option>
                                                    <option  value="Accounts Receivable">Accounts Receivable</option>
                                                    <option value="Cash & Bank">Cash & Bank</option>
                                                    <option  value="Prepayments">Prepayments</option>
                                                    <option  value="Deposits">Deposits</option>
                                                    <option  value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                    <option selected value="Employee Advances">Employee Advances</option>
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
                                            <select class="form-control" id="liabilities" style="display:none;" name="asset_liabilitie4">
                                                @if($category->sub_account_type == "Long Term Liabilities")
                                                    <option selected value="Long Term Liabilities">Long Term Liabilities</option>
                                                    <option value="Current Liabilities">Current Liabilities</option>
                                                    <option value="Short Term">Short Term</option>
                                                    <option value="Accounts Payable">Accounts Payable</option>
                                                    <option value="Other Payable">Other Payable</option>
                                                @elseif($category->sub_account_type == "Current Liabilities")
                                                    <option value="Long Term Liabilities">Long Term Liabilities</option>
                                                    <option selected value="Current Liabilities">Current Liabilities</option>
                                                    <option value="Short Term">Short Term</option>
                                                    <option value="Accounts Payable">Accounts Payable</option>
                                                    <option value="Other Payable">Other Payable</option>
                                                @elseif($category->sub_account_type == "Short Term")
                                                    <option value="Long Term Liabilities">Long Term Liabilities</option>
                                                    <option  value="Current Liabilities">Current Liabilities</option>
                                                    <option selected value="Short Term">Short Term</option>
                                                    <option value="Accounts Payable">Accounts Payable</option>
                                                    <option value="Other Payable">Other Payable</option>
                                                @elseif($category->sub_account_type == "Accounts Payable")
                                                    <option value="Long Term Liabilities">Long Term Liabilities</option>
                                                    <option  value="Current Liabilities">Current Liabilities</option>
                                                    <option  value="Short Term">Short Term</option>
                                                    <option selected value="Accounts Payable">Accounts Payable</option>
                                                    <option value="Other Payable">Other Payable</option>
                                                @elseif($category->sub_account_type == "Other Payable")
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
                                            <select class="form-control" id="capital" style="display:none;" name="asset_liabilitie5">
                                                @if($category->sub_account_type == "Partner Equity Account")
                                                    <option selected value="Partner Equity Account">Partner Equity Account</option>
                                                    <option value="Partner Current Account">Partner Current Account</option>
                                                    <option value="Retained Earnings">Retained Earnings</option>
                                                @elseif($category->sub_account_type == "Partner Current Account")

                                                    <option value="Partner Equity Account">Partner Equity Account</option>
                                                    <option selected value="Partner Current Account">Partner Current Account</option>
                                                    <option value="Retained Earnings">Retained Earnings</option>
                                                @elseif($category->sub_account_type == "Retained Earnings")
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
                                    <hr>
                                    <div class=" row">
                                        <div class="col-md-6">
                                            <label class="text-primary">Sub Account Category</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" placeholder="Sub Account Category" class="form-control" name="sub_account_category" required value="{{$category->sub_account_category}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-primary">Description</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <textarea name="description"  placeholder="Description" class="form-control">{{ $category->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="update_id" value="{{ $category->id }}">
                                    <button  type="submit" name="" class="btn btn-primary ">Update</button>
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

        $(document).ready(function() {

            // $('.select2').select2();
            // selectAccountType('1');


            let  type = $('#type').val();
            // alert(type);
            selectAccountType(type);
            App.formElements();
        });
    </script>
@endsection

