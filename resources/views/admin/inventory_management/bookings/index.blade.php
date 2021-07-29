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
                        <div class="panel-heading panel-heading-divider">Create Booking
                            <span class="panel-subtitle">Fromhere you can create Booking</span>
                        </div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center>
                                    <h3>
                                        <b>Create New Booking</b>
                                    </h3>
                                </center>
                                <form class="user" action="{{ route('save.booking') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="day" class="text-primary">Date</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="date" value="{{ date('Y-m-d') }}" name="day" id="day" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <center>
                                        <h3 class="text-primary" style="font-family:emoji,serif;">Customer Information</h3>
                                    </center>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="tenant_id" class="text-primary">Select Customer <span class="text-danger">*</span></label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <select name="customer_id" required id="customer_id" class="select2">
                                                    <option value="">Select Customer</option>
                                                    @foreach($customers as $customer)
                                                        <option value="{{ $customer->id }}" dphone="{{ $customer->phone1 }}">
                                                            {{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tenant_id" class="text-primary">Customer Contact No.</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" placeholder="Contact NO." id="customer_contact"
                                                       name="customer_contact" value="{{old('customer_contact')}}"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <center>
                                        <h3 class="text-primary" style="font-family: emoji,serif;">Plot Selection</h3>
                                    </center>
                                    <br>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="project_id" class="text-primary">Select Project <span class="text-danger">*</span></label>
                                            <select name="project_id" onchange="getSectors(this.value)" id="project_id"
                                                    required class="select2">
                                                <option value="">Select Project</option>
                                                @foreach($projects as $project)
                                                    <option value="{{ $project->id }}" @if($project->GetAssignPartner)
                                                    partner_ID="{{ $project->GetAssignPartner->partner_id }}"
                                                            datapercent="{{ $project->GetAssignPartner->percentage_hold }}
                                                            @endif">{{ $project->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="sector_id" class="text-primary">Select Sector <span class="text-danger">*</span></label>
                                            <select name="sector_id" onchange="getBlocks(this.value)" id="sectors"
                                                    class="select2 " required>
                                                <option value="">Select Sector</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="block_id" class="text-primary">Select Block <span class="text-danger">*</span></label>
                                            <select name="block_id" onchange="getPlots(this.value)" id="block_id"
                                                    class="select2" required>
                                                <option value="">Select Block</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="plot_id" class="text-primary">Select Plot <span class="text-danger">*</span></label>
                                            <select name="plot_id" onchange="getPlotMarla(this.value)" id="plot_id"
                                                    class="select2" required>
                                                <option value="">Select Plot</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="size" class="text-primary">Size Marla <span class="text-danger">*</span></label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="hidden" class="form-control" id="size" name="size">
                                                <input type="text" readonly class="form-control" id="size_name">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <center>
                                        <h3 class="text-primary" style="font-family: emoji,serif;">Agreed Price </h3>
                                    </center>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="agreed_price" class="text-primary">Agreed Price <span class="text-danger">*</span></label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="number" onkeyup="calc()" step="any" placeholder="0" name="agreed_price"
                                                       id="agreed_price" class="form-control" value="{{old('agreed_price') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="rate_marla" class="text-primary">Rate/Marla <span class="text-danger">*</span></label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="hidden" placeholder="0" name="rate_marla" class="form-control"
                                                       id="rate_marla_hidden" value="">
                                                <input type="text" readonly placeholder="0" name="" class="form-control"
                                                       id="rate_marla" value="{{old('rate_marla')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="discount" class="text-primary">Discount Amount</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="number" step="any" onkeyup="calc()" placeholder="0" value="0"
                                                       class="form-control" id="discount" name="discount">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="total_amount" class="text-primary">Total Amount <span class="text-danger">*</span></label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" readonly id="total_amount" placeholder="0"
                                                       name="total_amount" class="form-control"
                                                       value="{{old('total_amount')}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="received" class="text-primary">Advance Received</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="number" step="any" onkeyup="calc()" placeholder="0" value="0"
                                                       class="form-control" id="received" name="received">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="remaining_amount" class="text-primary">Remaining Amount</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="hidden" placeholder="0" name="remaining_amount"
                                                       id="remaining_amount_hidden" class="form-control" value="0">
                                                <input type="text" readonly placeholder="0" name="" id="remaining_amount"
                                                       class="form-control" value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label for="" class="text-primary">Mode of Payment</label>
                                            <select name="advance_modeof_payment" class="select2"
                                                    id="advance_modeof_payment">
                                                <option value="">Select One</option>
                                                <option value="Cash In Hand">Cash In Hand</option>
                                                <option value="Cheque">Cheque</option>
                                                <option value="PO">PO</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row" style="display: none;" id="cheque_row">
                                        <div class="col-md-3">
                                            <label for="" class="text-primary">Bank Name</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" name="advance_bank_name"
                                                       value="{{ old('advance_bank_name') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="text-primary">Cheque No</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" name="advance_cheque_no"
                                                       value="{{ old('advance_cheque_no') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="text-primary">Account Title</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" class="form-control" name="advance_account_title"
                                                       value="{{ old('advance_account_title') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="text-primary">Date</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="date" class="form-control" name="advance_date"
                                                       value="{{ old('advance_date') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="display: none;" id="po_row">
                                        <div class="col-md-3">
                                            <label for="" class="text-primary">Bank Name</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" name="advance_bank_name"
                                                       value="{{ old('advance_bank_name') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="text-primary">PO No</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" name="advance_cheque_no"
                                                       value="{{ old('advance_cheque_no') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="text-primary">Account Title</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" class="form-control" name="advance_account_title"
                                                       value="{{ old('advance_account_title') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="text-primary">Date</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="date" class="form-control" name="advance_date"
                                                       value="{{ old('advance_date') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <center>
                                        <h3 class="text-primary" style="font-family: emoji,serif;">Installments</h3>
                                    </center>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="no_of_installments" class="text-primary">Start Date <span class="text-danger">*</span></label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="date" class="form-control" id="start_date" name="start_date"
                                                       value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="no_of_installments" class="text-primary">End Date <span class="text-danger">*</span></label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="date" onchange="diffInMonths(this.value)" class="form-control"
                                                       id="end_date" value="{{ old('end_date') }}" name="end_date" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="text-primary">Installment Head <span class="text-danger">*</span></label>
                                            <select onchange="MakingInstallments(0)" name="head_id" id="head_id"
                                                    class="select2">
                                                <option value="">Select One</option>
                                                {{--                                                <option value="8" selected  dmonths="1">Monthly</option>--}}
                                                @foreach($heads as $head)
                                                    @if($head->no_of_months!='-1')
                                                        <option value="{{ $head->id }}" dmonths="{{ $head->no_of_months }}">
                                                            {{ $head->head }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="" class="text-primary">Installment Amount <span class="text-danger">*</span></label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="number" step="any" class="form-control default_installment_amount"
                                                       onkeyup="MakingInstallments(0)" name="installment_amount"
                                                       placeholder="0" id="installment_amount"
                                                       value="{{ old('installment_amount') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="no_of_installments" class="text-primary">No. of Installments
                                                <span class="text-danger">*</span></label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="number" step="any" placeholder="0" class="form-control"
                                                       onkeyup="MakingInstallments(0)" value="{{ old('no_of_installments') }}"
                                                       id="no_of_installments" name="no_of_installments">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="text-primary">Possession</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="number" step="any" class="form-control" name="possession"
                                                       onkeyup="MakingInstallments(0)" placeholder="0" id="possession"
                                                       value="{{ old('possession') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="on_account_of" class="text-primary">On Account of <span class="text-danger">*</span></label>
                                            <select class="select2" required name="on_account_of" id="on_account_of">
                                                <option value="">Select Account</option>
                                                @foreach($accounts as $account)
                                                    <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <center>
                                        <h3 class="text-primary" style="font-family: emoji,serif;">Add Plans</h3>
                                    </center>
                                    <br>
                                    {{--here comes the plans rows--}}
                                    <div class="" id="plansrows">

                                    </div>
                                    {{--here end the plans rows--}}
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a class="btn btn-success btn-sm" onclick="addNewRow()">
                                                <i class="fa fa-plus"></i>
                                                Add Plan
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Installment#</th>
                                                <th class="text-center">Installment Amount</th>
                                                <th class="text-center">Remarks/Description</th>
                                                <th class="text-center" id="cheque_date"> Date</th>
                                            </tr>
                                            </thead>
                                            <tbody id="rowTable">
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <center>
                                        <h3 class="text-primary" style="font-family: emoji,serif;">Partner Amount</h3>
                                    </center>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="" class="text-primary">Partner Share %</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="" onkeyup="calc()" class="form-control" name="partner_percent" id="partner_percent">
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            {{-- <input type="hidden" id="partner_percent"> --}}
                                            <input type="hidden" id="partner_id" name="partner_id">
                                            <label for="partner_amount" class="text-primary">Partner Amount</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="" onkeyup="calc()" placeholder="0" value="0"
                                                       class="form-control" id="partner_amount" name="partner_amount">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="partner_amount_a" class="text-primary">Partner Amount (A)</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="hidden" placeholder="0" value="{{ old('partner_amount_a') }}"
                                                       class="form-control" id="partner_amount_a_hidden"
                                                       name="partner_amount_a">
                                                <input type="text" readonly placeholder="0"
                                                       value="{{ old('partner_amount_a') }}" class="form-control"
                                                       id="partner_amount_a" name="">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="equity_difference" class="text-primary">Equity (Diff)</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="hidden" placeholder="0" name="equity_difference"
                                                       id="equity_difference_hidden" class="form-control" value="">
                                                <input type="text" readonly placeholder="0" name="" id="equity_difference"
                                                       class="form-control" value="{{old('equity_difference')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="dp_per" class="text-primary">DP %</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" readonly placeholder="0" name="dp_per" id="dp_per"
                                                       class="form-control" value="{{old('dp_per')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <center>
                                        <h3 class="text-primary" style="font-family: emoji,serif;">Intiqal</h3>
                                    </center>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="size" class="text-primary">Intiqal# <span class="text-danger">*</span></label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text"  placeholder="0" value="{{ old('intiqal_no') }}"
                                                       class="form-control" id="intiqal_no" name="intiqal_no">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="size" class="text-primary">Intiqal (G)</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="number" step="any" placeholder="0" value="0"
                                                       class="form-control intiqal_given" id="intiqal_g" name="intiqal_g">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="size" class="text-primary">Intiqal (A)</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="hidden" placeholder="0" value="{{ old('intiqal_a') }}"
                                                       class="form-control" id="intiqal_a_hidden" name="intiqal_a">
                                                <input type="text" readonly placeholder="0" value="{{ old('intiqal_a') }}"
                                                       class="form-control" id="intiqal_a" name="">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="size" class="text-primary">Intiqal (Diff)</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="hidden" placeholder="0" value="{{ old('intiqal_diff') }}"
                                                       class="form-control" id="intiqal_diff_hidden" name="intiqal_diff">
                                                <input type="text" placeholder="0" value="{{ old('intiqal_diff') }}"
                                                       readonly class="form-control" id="intiqal_diff" name="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="text-primary">Intiqal Attachment</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="file"  class="form-control" name="intiqal_attachment">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    @if (\Auth::user()->role=='Super Admin')
                                        <center>
                                            <h3 class="text-primary" style="font-family: emoji,serif;">Marketers Commision</h3>
                                        </center>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="marketer_id" class="text-primary">Select Marketer</label>
                                                <select name="marketer_id" id="marketer_id" class="select2">
                                                    <option value="">Select Marketer</option>
                                                    @foreach($marketers as $marketer)
                                                        <option value="{{$marketer->id}}">{{ $marketer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="marketer_commision_per" class="text-primary">Marketer Commision
                                                    %</label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="number" step="any" class="form-control" id="marketer_commision_per"
                                                           onkeyup="calc()" name="marketer_commision_per" placeholder="0"
                                                           value="3">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="marketer_commision_value" class="text-primary">Marketer Commision
                                                    Value</label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="hidden" class="form-control"
                                                           id="marketer_commision_value_hidden" name="marketer_commision_value"
                                                           placeholder="0" value="{{ old('marketer_commision_value') }}">
                                                    <input type="text" readonly class="form-control"
                                                           id="marketer_commision_value" name="" placeholder="0"
                                                           value="{{ old('marketer_commision_value') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="marketer_coms_value_paid" class="text-primary">Marketer Comm Value
                                                    Paid</label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="number" step="any" class="form-control" name="marketer_coms_value_paid"
                                                           id="marketer_coms_value_paid" placeholder="0" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="marketer_coms_formula" class="text-primary">COMS Formula</label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="hidden" class="form-control" name="marketer_coms_formula"
                                                           id="marketer_coms_formula_hidden" placeholder="0"
                                                           value="{{ old('marketer_coms_formula') }}">
                                                    <input type="text" class="form-control" readonly name=""
                                                           id="marketer_coms_formula" placeholder="0"
                                                           value="{{ old('marketer_coms_formula') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="marketer_commision_due" class="text-primary">Remaining Marketer Due
                                                    Commision</label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="hidden" class="form-control" name="marketer_commision_due"
                                                           id="marketer_commision_due_hidden" placeholder="0"
                                                           value="{{ old('marketer_commision_due') }}">
                                                    <input type="text" class="form-control" readonly name=""
                                                           id="marketer_commision_due" placeholder="0"
                                                           value="{{ old('marketer_commision_due') }}">
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @can('Add New Booking','Marketers Commision')
                                            <center>
                                                <h3 class="text-primary" style="font-family: emoji,serif;">Marketers Commision</h3>
                                            </center>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="marketer_id" class="text-primary">Select Marketer</label>
                                                    <select name="marketer_id" id="marketer_id" class="select2">
                                                        <option value="">Select Marketer</option>
                                                        @foreach($marketers as $marketer)
                                                            <option value="{{$marketer->id}}">{{ $marketer->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="marketer_commision_per" class="text-primary">Marketer Commision
                                                        %</label>
                                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                        <input type="number" step="any" class="form-control" id="marketer_commision_per"
                                                               onkeyup="calc()" name="marketer_commision_per" placeholder="0"
                                                               value="3">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="marketer_commision_value" class="text-primary">Marketer Commision
                                                        Value</label>
                                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                        <input type="hidden" class="form-control"
                                                               id="marketer_commision_value_hidden" name="marketer_commision_value"
                                                               placeholder="0" value="{{ old('marketer_commision_value') }}">
                                                        <input type="text" readonly class="form-control"
                                                               id="marketer_commision_value" name="" placeholder="0"
                                                               value="{{ old('marketer_commision_value') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="marketer_coms_value_paid" class="text-primary">Marketer Comm Value
                                                        Paid</label>
                                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                        <input type="number" step="any" class="form-control" name="marketer_coms_value_paid"
                                                               id="marketer_coms_value_paid" placeholder="0" value="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="marketer_coms_formula" class="text-primary">COMS Formula</label>
                                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                        <input type="hidden" class="form-control" name="marketer_coms_formula"
                                                               id="marketer_coms_formula_hidden" placeholder="0"
                                                               value="{{ old('marketer_coms_formula') }}">
                                                        <input type="text" class="form-control" readonly name=""
                                                               id="marketer_coms_formula" placeholder="0"
                                                               value="{{ old('marketer_coms_formula') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="marketer_commision_due" class="text-primary">Remaining Marketer Due
                                                        Commision</label>
                                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                        <input type="hidden" class="form-control" name="marketer_commision_due"
                                                               id="marketer_commision_due_hidden" placeholder="0"
                                                               value="{{ old('marketer_commision_due') }}">
                                                        <input type="text" class="form-control" readonly name=""
                                                               id="marketer_commision_due" placeholder="0"
                                                               value="{{ old('marketer_commision_due') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    @endif
                                    @if(\Auth::user()->role=='Super Admin')
                                        <center>
                                            <h3 class="text-primary" style="font-family: emoji,serif;">Dealer Commission</h3>
                                        </center>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="dealer_id" class="text-primary">Select Dealer</label>
                                                <select name="dealer_id" id="dealer_id" class="select2">
                                                    <option value="">Select Dealer</option>
                                                    @foreach($dealers as $dealer)
                                                        <option value="{{$dealer->id}}">{{ $dealer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="dealer_commision_per" class="text-primary">Dealer Commission
                                                    %</label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="number" step="any" class="form-control" onkeyup="calc()"
                                                           name="dealer_commision_per" id="dealer_commision_per" placeholder="0"
                                                           value="3">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="dealer_commision_value" class="text-primary">Dealer Commission
                                                    Value</label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="hidden" class="form-control" name="dealer_commision_value"
                                                           id="dealer_commision_value_hidden" placeholder="0"
                                                           value="{{ old('dealer_commision_value') }}">
                                                    <input type="text" class="form-control" readonly name=""
                                                           id="dealer_commision_value" placeholder="0"
                                                           value="{{ old('dealer_commision_value') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="coms_formula" class="text-primary">COMS Formula</label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="hidden" class="form-control" name="coms_formula"
                                                           id="coms_formula_hidden" placeholder="0"
                                                           value="{{ old('coms_formula') }}">
                                                    <input type="text" class="form-control" readonly name="" id="coms_formula"
                                                           placeholder="0" value="{{ old('coms_formula') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="dealer_commision_due" class="text-primary">Dealer Due
                                                    Commission</label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="number" step="any" class="form-control" id="dealer_commision_due"
                                                           name="dealer_commision_due" placeholder="0"
                                                           value="{{ old('dealer_commision_due') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="rf" class="text-primary">Rf</label>
                                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                    <input type="text" class="form-control" name="rf" placeholder=""
                                                           value="{{ old('rf') }}">
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @can('Add New Booking','Dealer Commision')
                                            <center>
                                                <h3 class="text-primary" style="font-family: emoji,serif;">Dealer Commission</h3>
                                            </center>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="dealer_id" class="text-primary">Select Dealer</label>
                                                    <select name="dealer_id" id="dealer_id" class="select2">
                                                        <option value="">Select Dealer</option>
                                                        @foreach($dealers as $dealer)
                                                            <option value="{{$dealer->id}}">{{ $dealer->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="dealer_commision_per" class="text-primary">Dealer Commission
                                                        %</label>
                                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                        <input type="number" step="any" class="form-control" onkeyup="calc()"
                                                               name="dealer_commision_per" id="dealer_commision_per" placeholder="0"
                                                               value="3">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="dealer_commision_value" class="text-primary">Dealer Commission
                                                        Value</label>
                                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                        <input type="hidden" class="form-control" name="dealer_commision_value"
                                                               id="dealer_commision_value_hidden" placeholder="0"
                                                               value="{{ old('dealer_commision_value') }}">
                                                        <input type="text" class="form-control" readonly name=""
                                                               id="dealer_commision_value" placeholder="0"
                                                               value="{{ old('dealer_commision_value') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="coms_formula" class="text-primary">COMS Formula</label>
                                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                        <input type="hidden" class="form-control" name="coms_formula"
                                                               id="coms_formula_hidden" placeholder="0"
                                                               value="{{ old('coms_formula') }}">
                                                        <input type="text" class="form-control" readonly name="" id="coms_formula"
                                                               placeholder="0" value="{{ old('coms_formula') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="dealer_commision_due" class="text-primary">Dealer Due
                                                        Commission</label>
                                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                        <input type="number" step="any" class="form-control" id="dealer_commision_due"
                                                               name="dealer_commision_due" placeholder="0"
                                                               value="{{ old('dealer_commision_due') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="rf" class="text-primary">Rf</label>
                                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                        <input type="text" class="form-control" name="rf" placeholder=""
                                                               value="{{ old('rf') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    @endif

                                    <center>
                                        <h3 class="text-primary" style="font-family: emoji,serif;">Booking Attachments</h3>
                                    </center>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <table id="test-table" class="table table-condensed table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Attachments</th>
                                                        <th>Comment</th>
                                                        <th>-</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="test-body">
                                                    <tr id="row0">
                                                        <td>
                                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                <input name='attachments[]' type='file'
                                                                       class='form-control' />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                <input name='comments[]' placeholder="Comment"
                                                                       type='text' class='form-control input-md' />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button class='delete-rowatt btn btn-danger btn-sm'>
                                                                <i class="fa fa-trash  text-white"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <center>
                                                    <button id='add-row' class='btn btn-primary'>Add More <i
                                                            class="fa fa-plus"></i></button>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="customer_name">
                                    @if(\Auth::user()->role=='Super Admin')
                                        <button type="submit" name="" class="btn btn-primary ">Create</button>
                                    @else
                                        @can('Add New Booking','Create')
                                            <button type="submit" name="" class="btn btn-primary ">Create</button>
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
    <script type="text/javascript">
        const baseurl = "{{url('/')}}";
        var plancount = 1;




        function diffInMonths(enddate)
        {
            var head_months    = $("#head_id option:selected").attr("dmonths");
            if(head_months=="" || head_months==null || head_months==0)
            {
                // alert("Please Select Installment Head");
                return false;
            }
            console.log(enddate);
            var enddate = enddate.split("-");
            var to = new Date(enddate[0], enddate[1], enddate[2]);


            var start = $('#start_date').val();
            start = start.split("-");
            from = new Date(start[0], start[1], start[2]);

            var months = to.getMonth() - from.getMonth() + (12 * (to.getFullYear() - from.getFullYear()));

            if (to.getDate() < from.getDate())
            {
                var newFrom = new Date(to.getFullYear(), to.getMonth(), from.getDate());
                if (to < newFrom && to.getMonth() == newFrom.getMonth() && to.getYear() % 4 != 0)
                {
                    months--;
                }
            }
            console.log(months);
            $('#no_of_installments').val(months/head_months);
        }


        function addNewRow() {
            if ($('#end_date').val() == "" || $('#end_date').val() == null) {
                alert("Please Enter the Above Information First");
                return;
            }
            var new_row = `
            <div class="row full_div planRow" id="full_div${plancount}" >
           <div class="col-md-3">
              <label for="" class="text-primary">Installment Head</label>
                 <select  name="" id="sub_head_id${plancount}" class="select2 Installmentsplan">
                      <option value="">Select One</option>
                        @foreach($heads as $head)
            <option value="{{ $head->no_of_months }}" dmonths="{{ $head->no_of_months }}">{{ $head->head }}</option>
                        @endforeach
            </select>
      </div>
      <div class="plandecsion"></div>
              </div>`;
            plancount++;
            $('#plansrows').append(new_row);
            App.formElements();
        }

        /////////////////// deleting the rows //////////////////////////////////
        function delete_row(plancount_a) {
            console.log(plancount_a);
            if (plancount_a > 0) {
                /////////////// counter for the plans makinginstalments//////////
                c--;
                $('#full_div' + plancount_a).remove();
                plancount--;
                console.log(plancount);
            } else {
                plancount = 0;
            }
            // return false;
            MakingInstallments(0);
        }
        $('body').on('click', '.delete-row', function () {
            var parent = $(this).parent().parent().parent();
            parent.remove();
            ResetTable();
            ApplyPlans();
        });

        //// advance mode of payment here///////////////////////////////////////
        $('#advance_modeof_payment').change(function () {
            const mode = $(this).val();
            if (mode === "Cheque") {
                $('#cheque_row').show();
                $('#po_row').hide();
            } else if (mode === "PO") {
                $('#po_row').show();
                $('#cheque_row').hide();
            } else {
                $('#cheque_row').hide();
                $('#po_row').hide();
            }
        });

        var row= 1;
        $(document).on("click", "#add-row", function () {

            var new_row = `
      <tr id="row${row}">
       <td>
       <div class="col-md-12 input-group input-group-sm xs-mb-15">
         <input name="attachments[]" type="file" class="form-control" />
         </div>
       </td>
       <td>
       <div class="col-md-12 input-group input-group-sm xs-mb-15">
        <input name="comments[]" type="text" placeholder="Comment" class="form-control" />
        </div>
       </td>
       <td>
         <button class="delete-rowatt btn btn-danger btn-sm">
            <i class="fa fa-trash  text-white"></i>
         </button>
       </td>
      </tr>
    `;

            $('#test-body').append(new_row);
            row++;
            return false;
        });

        // Remove criterion
        $(document).on("click", ".delete-rowatt", function () {
            //  alert("deleting row#"+row);
            if(row>1) {
                $(this).closest('tr').remove();
                row--;
            }
            return false;
        });
    </script>
    <script src="{{ asset('/assets/js/booking/bookingcalculation.js') }}"></script>
    <script src="{{ asset('/assets/js/Master/master.js') }}"></script>
    <script src="{{ asset('/assets/js/booking/makinginatallments.js') }}"></script>
@endsection
