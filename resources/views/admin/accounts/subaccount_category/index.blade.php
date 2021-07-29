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
                        <div class="panel-heading panel-heading-divider">Add Sub Account Category
                            <span class="panel-subtitle">From here you can create sub account category</span>
                        </div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center>
                                    <h3>
                                        <b>Add Sub Account Category</b>
                                    </h3>
                                </center>
                                <form class="user" action="{{ route('save.subaccount_category') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class=" row">
                                        <div class="col-md-2">
                                            <label class="text-primary">Account Type</label>
                                            <br>
                                        </div>
                                        <input type="hidden" name="account_type" id="account_type_e">
                                        <div class="col-md-2">
                                            <input type="radio" class="" onclick="selectAccountType('1')" checked id="male" name="gender" value="male">
                                            <label for="male">Income</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio"  onclick="selectAccountType('2')" id="years" name="gender" value="female">
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
                                    <div class=" row">
                                        <div class="col-md-2">
                                            <label class="text-primary">Sub Account type
                                                <small>(Optional)</small>
                                            </label>
                                        </div>
                                        <div class="col-md-10">
                                            <!-- Icome  -->

                                            <select class="form-control" id="Icome" style="display:none;" name="asset_liabilitie">
                                                <option value="" selected disabled>Select One</option>
                                                <option value="Direct Income">Direct Income</option>
                                                <option value="Other Income">Other Income</option>
                                            </select>
                                            <!-- expense  -->
                                            <select class="form-control expense" id="expense" style="display:none;" name="asset_liabilitie">
                                                <option value="" selected disabled>Select One</option>
                                                <option value="Administration">Administration</option>
                                                <option value="Cost of Goods Sold">Cost of Goods Sold</option>
                                                <option value="Indirect Expenses">Indirect Expenses</option>
                                            </select>
                                            <!-- assets  -->
                                            <select class=" form-control" id="assets" style="display:none;" name="asset_liabilitie">
                                                <option value="" selected disabled>Select One</option>
                                                <option value="Fixed Assets">Fixed Assets</option>
                                                <option value="Current Assets">Current Assets</option>

                                                <option value="Accounts Receivable">Accounts Receivable</option>
                                                {{--                                                <option value="Bank">Bank</option>--}}
                                                <option value="Cash & Bank">Cash & Bank</option>
                                                <option value="Prepayments">Prepayments</option>
                                                <option value="Deposits">Deposits</option>
                                                <option value="Accumulated Depreciation">Accumulated Depreciation</option>
                                                <option value="Employee Advances">Employee Advances</option>
                                            </select>
                                            <!-- liabilities  -->
                                            <select class="form-control" id="liabilities" style="display:none;" name="asset_liabilitie">
                                                <option value="" selected disabled>Select One</option>
                                                <option value="Long Term Liabilities">Long Term Liabilities</option>
                                                <option value="Current Liabilities">Current Liabilities</option>
                                                <option value="Short Term">Short Term</option>
                                                <!--<option value="Long Term">Long Term</option>-->
                                                <option value="Accounts Payable">Accounts Payable</option>
                                                <option value="Other Payable">Other Payable</option>
                                            </select>
                                            <!-- capital  -->

                                            <select class="form-control" id="capital" style="display:none;" name="asset_liabilitie">
                                                <option value="" selected disabled>Select One</option>
                                                <option value="Partner Equity Account">Partner Equity Account</option>
                                                <option value="Partner Current Account">Partner Current Account</option>
                                                <option value="Retained Earnings">Retained Earnings</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>

                                    <hr>
                                    <div class=" row">
                                        <div class="col-md-6">
                                            <label class="text-primary">Sub Account Category</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" placeholder="Sub Account Category" class="form-control" name="sub_account_category" required value="{{old('sub_account_category')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-primary">Description</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <textarea name="description"  placeholder="Description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="update_id" value="0">
                                    <button  type="submit" name="" class="btn btn-primary ">
                                        Create
                                    </button>
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

            // $('.select2').select2();
            selectAccountType('1');
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


    </script>
@endsection

