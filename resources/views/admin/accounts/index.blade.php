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
                        <div class="panel-heading panel-heading-divider">Add Account<span class="panel-subtitle">From here you can create account</span></div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center><h3><b>Add New Account</b></h3></center>
                                <form class="user" action="{{ route('save.account') }}" method="POST" enctype="multipart/form-data">
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
                                            <label class="text-primary">Sub Account type <small>(Optional)</small></label>
                                        </div>
                                        <div class="col-md-10">
                                            <!-- Icome  -->

                                            <select class="form-control getSubacc_category" id="Icome" style="display:none;" name="asset_liabilitie">
                                                <option value="" selected disabled>Select One</option>
                                                <option value="Direct Income">Direct Income</option>
                                                <option value="Other Income">Other Income</option>
                                            </select>
                                            <!-- expense  -->
                                            <select class="form-control   getSubacc_category" id="expense" style="display:none;" name="asset_liabilitie">
                                                <option value="" selected disabled>Select One</option>
                                                <option value="Administration">Administration</option>
                                                <option value="Cost of Goods Sold">Cost of Goods Sold</option>
                                                <option value="Indirect Expenses">Indirect Expenses</option>
                                            </select>
                                            <!-- assets  -->
                                            <select class=" form-control getSubacc_category" id="assets" style="display:none;" name="asset_liabilitie">
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
                                            <select class="form-control getSubacc_category" id="liabilities" style="display:none;" name="asset_liabilitie">
                                                <option value="" selected disabled>Select One</option>
                                                <option value="Long Term Liabilities">Long Term Liabilities</option>
                                                <option value="Current Liabilities">Current Liabilities</option>
                                                <option value="Short Term">Short Term</option>
                                                <!--<option value="Long Term">Long Term</option>-->
                                                <option value="Accounts Payable">Accounts Payable</option>
                                                <option value="Other Payable">Other Payable</option>
                                            </select>
                                            <!-- capital  -->

                                            <select class="form-control getSubacc_category" id="capital" style="display:none;" name="asset_liabilitie">
                                                <option value="" selected disabled>Select One</option>
                                                <option value="Partner Equity Account">Partner Equity Account</option>
                                                <option value="Partner Current Account">Partner Current Account</option>
                                                <option value="Retained Earnings">Retained Earnings</option>
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
{{--                                                <option value="">Select One</option>--}}
{{--                                                <option value="Accommodation Exp">Accommodation Exp</option>--}}
{{--                                                <option value="Administration Exp">Administration Exp</option>--}}
{{--                                                <option value="ALLAH's Name">ALLAH's Name</option>--}}
{{--                                                <option value="Architectural Services">Architectural Services</option>--}}
{{--                                                <option value="Banking Exp">Banking Exp</option>--}}
{{--                                                <option value="Communication Exp">Communication Exp</option>--}}
{{--                                                <option value="Director Remuneration">Director Remuneration</option>--}}
{{--                                                <option value="Electric Bill Exp">Electric Bill Exp</option>--}}
{{--                                                <option value="Land Exp">Land Exp</option>--}}
{{--                                                <option value="Legal Exp">Legal Exp</option>--}}
{{--                                                <option value="Lunger Exp">Lunger Exp</option>--}}
{{--                                                <option value="Marketing Exp">Marketing Exp</option>--}}
{{--                                                <option value="Misc Exp">Misc Exp</option>--}}
{{--                                                <option value="Parks & Horiticulture Exp">Parks & Horiticulture Exp</option>--}}
{{--                                                <option value="Pre Construction Exp">Pre Construction Exp</option>--}}
{{--                                                <option value="Revenue">Revenue</option>--}}
{{--                                                <option value="Road Exp">Road Exp</option>--}}
{{--                                                <option value="Travelling Exp">Travelling Exp</option>--}}
{{--                                                <option value="Sales FMR Exp">Sales FMR Exp</option>--}}
{{--                                                <option value="Model House Exp">Model House Exp</option>--}}
{{--                                                <option value="Project Designing Exp">Project Designing Exp</option>--}}
{{--                                                <option value="Mena Bibi Exp">Mena Bibi Exp</option>--}}
{{--                                                <option value="ERP System">ERP System</option>--}}
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class=" row">
                                        <div class="col-md-6">
                                            <label class="text-primary">Account Name</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" placeholder="Account Name" class="form-control" name="account_name" required="" value="{{old('account_name')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-primary">Select Project</label>
                                            <select name="project_id" required id="" class="select2">
                                                <option value="">Select Project</option>
                                                @foreach($projects as $project)
                                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-6">
                                            <label class="text-primary">Description</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <textarea name="description"  placeholder="Description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-primary">Sub-Account of</label>
                                            <select class=" select2 " style="" name="sub_account_type" id="sub_account_type">
                                                <option value="" >Select One</option>
                                                @foreach($accounts as $account)
                                                    <option value="{{$account->id}}">{{$account->account_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-6">
                                            <label class="text-primary">Note</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" placeholder="Note" class="form-control" name="note" required="" value="{{old('note')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-primary">Vat Code</label>
                                            <select class="select2" name="vat_code" >
                                                <option value="" selected disabled>Select Vat Type</option>
                                                <option value="Yes Vat Included">Yes Vat Included</option>
                                                <option value="Vat Not Included">No Vat Not Included</option>
                                                <!--<option value="No Vat">No Vat</option>-->
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-6">
                                            <label class="text-primary">Opening Balance</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="number" value="{{old('open_bal')}}" class="form-control" name="open_bal"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-primary">Date</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="date" class="form-control"  value="{{ date('Y-m-d')}}" name="day"/>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @if(\Auth::user()->role == 'Super Admin')
                                        <button  type="submit" name="" class="btn btn-primary ">
                                            Create
                                        </button>
                                    @else
                                        @can('Add New','Create')
                                            <button  type="submit" name="" class="btn btn-primary ">
                                                Create
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

