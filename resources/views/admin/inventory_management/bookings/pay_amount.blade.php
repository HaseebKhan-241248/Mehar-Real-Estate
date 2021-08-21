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
                        <div class="panel-heading panel-heading-divider">
                            Pay Amount
                            <span class="panel-subtitle"></span>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('save.installmentamount') }}" onsubmit="return validateForm()" name="myForm" method="post">
                                @csrf
                                <input type="hidden" value="{{ $booking->id }}" name="booking_id">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="" class="text-primary">Date</label>
                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                            <input type="date" class="form-control" name="day">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="text-primary">Plot No.</label>
                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                            <input type="hidden" value="{{ $booking->plot_id }}" name="plot_id">
                                            <input type="hidden" value="{{ $booking->customer_id }}" name="customer_id">
                                            <input type="text" class="form-control" @if($booking->Plot_Name) value="{{ $booking->Plot_Name->name }}" @endif readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="text-primary">Customer Name</label>
                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                            <input type="text" class="form-control" readonly @if($booking->Customer_Name) value="{{ $booking->Customer_Name->name }}" @endif />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="text-primary">Installment Amount</label>
                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                            <input type="hidden" value="{{ $booking->installment_amount }}" id="installment_amount">
                                            <input type="hidden" value="" name="installment_amount_count" id="installment_amount_count">
                                            <input type="text"  class="form-control" readonly value="{{ number_format($booking->installment_amount,2) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="" class="text-primary">Remaining Amount</label>
                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                            <input type="text" class="form-control" readonly @if($Remainingamount) value="{{ number_format($Remainingamount,2) }}" @else  @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="text-primary">Amount Pay</label>
                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                            <input type="text" name="amount_paid" id="amount_paid" class="form-control amount_paid" value="{{ $booking->installment_amount }}">
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="" class="text-primary">Through Pay Order/Bank Draft No./Cash</label>
                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                            <input type="text" class="form-control" value="{{ old('draft_no') }}" name="draft_no">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="text-primary">Dated</label>
                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                            <input type="date" name="dated" value="{{ old('dated') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="text-primary">Drawn Bank</label>
                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                            <input type="text" class="form-control" value="{{ old('drawn_bank') }}" name="drawn_bank">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="text-primary">On Account Of</label>
                                        <select name="account_id" required id="" class="select2">
                                            <option value="">Select Account</option>
                                            @foreach($accounts as $account)
                                                <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row " >
                                    <div class="col-md-3 ">
                                        <button class="btn btn-primary btn-sm btnsave">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-body">
                            <div class="row" style="display: flex;">
                                <div class="col-md-6 " style="width: 50%;margin-top: 45px;">
                                    <h1 class="" style="color: black;font-family: Emoji,serif;font-weight: bold;">
                                        @if($booking->Project_Name)
                                            {{ $booking->Project_Name->name }}
                                        @endif
                                    </h1>
                                </div>
                                <div class="col-md-6 " style="width: 50%;">
                             <span style="display: flex;justify-content: flex-end;">
 <img  class="thumbnail" width="100" style="margin-bottom: 0px;margin-right: 15px;" height="100" @if($booking->Project_Name) src="{{ asset('') }}images/{{ $booking->Project_Name->logo }}" @endif alt="">
                    </span>

                                </div>
                            </div>
                            <hr color="customHr" style="height: 4px !important;background-color: #1572E8 !important;margin-top: auto !important;">
{{--                          <center>--}}
{{--                              <h1 style="font-family: Emoji,serif;  background-color: #1572e8;color: white;" class="test text-uppercase">Payment Schedule</h1>--}}
{{--                          </center>--}}
                        <div class="row invoice-data" style="margin-bottom:0;">
                            <div class="col-xs-12 invoice-person">
                                <table width="70%" class="  table-borderless">
                                    <tr class="test1" style="">
                                        <th class="  test1 text-uppercase " style="color: #1572E8;padding:1px;padding-left: 5px;font-family: ui-rounded;">Client Name</th>
                                        <th class=" test1" style="color: #1572E8;padding:1px;font-family: ui-rounded;">
                                            @if($booking->Customer_Name)
                                                {{$booking->Customer_Name->name}}
                                            @endif
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class=" text-uppercase" style="color: black;padding:1px;padding-left: 5px;font-family: ui-rounded;">Booking No</th>
                                        <th class=" text"  style="color: black;padding:1px;font-family: ui-rounded;">{{ $booking->id }}</th>
                                    </tr>
                                    <tr>
                                        <th class=" text-uppercase" style="color: black;padding:1px;padding-left: 5px;font-family: ui-rounded;">Sector</th>
                                        <th class="" style="color: black;padding:1px;font-family: ui-rounded;">
                                            @if($booking->Sector_Name)
                                                {{ $booking->Sector_Name->name }}
                                            @endif
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class=" text-uppercase" style="color: black;padding:1px;padding-left: 5px;font-family: ui-rounded;">Block</th>
                                        <th class="" style="color: black;padding:1px;font-family: ui-rounded;">
                                            @if($booking->Block_Name)
                                                {{ $booking->Block_Name->name }}
                                            @endif
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class=" text-uppercase" style="color: black;padding:1px;padding-left: 5px;font-family: ui-rounded;">Plot no</th>
                                        <th class="" style="color: black;padding:1px;font-family: ui-rounded;">
                                            @if($booking->Plot_Name)
                                                {{ $booking->Plot_Name->name }}
                                            @endif
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class=" text-uppercase" style="color: black;padding:1px;padding-left: 5px;font-family: ui-rounded;">Area Size</th>
                                        <th class="" style="color: black;padding:1px;font-family: ui-rounded;">
                                            @if($booking->Plot_Name)
                                                {{ $booking->MarlaSize->marla }}  -Marla
                                            @endif
                                        </th>
                                    </tr>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            <h1 style="font-family: Emoji,serif;  background-color: #1572e8;color: white;" class="test text-uppercase">Payment Schedule</h1>
                                        </center>
                                        <table class="table table-striped table-hover table-bordered" style="border-collapse: collapse;width:100%;margin-top:-10px;">
                                            <thead>
                                            <tr style="font-size: 11px;background-color: #1572e8;color: white;" class="text-uppercase ">
                                                <th class="text-center test1" style="padding:1px;">SR#</th>
                                                <th class="text-center test1" style="padding:1px;">Due Date</th>
                                                <th class="text-center test1" style="padding:1px;">Mode of Payment</th>
                                                <th class="text-center test1" style="padding:1px;">Installment Amount</th>
                                                <th class="text-center test1" style="padding:1px;">Status</th>
                                                <th class="text-center test1" style="padding:1px;">Receipt#</th>
                                                <th class="text-center test1" style="padding:1px;">Amount Paid</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                            $subtotal= 0;
                                            $rece    = 0;
                                            $total_installment_received=0;
                                            @endphp
                                            @foreach($installments as $installment)
                                                <tr style="color:black;">
                                                    <td class="text-center test" style="padding:1px;">{{ $counter++ }}</td>
                                                    <td class="text-center" style="padding:1px;">{{ \Carbon\Carbon::parse($installment->date)->format('d M Y') }}</td>
                                                    <td class="text-center" style="padding:1px;">{{ $installment->description }}</td>
                                                    <td class="text-center" style="padding:1px;">{{ number_format($installment->amount_check,2) }}</td>
                                                    <td class="text-center" style="padding:1px;">
                                                        @if($installment->status==0)
                                                            @if($installment->description=="Booking-1")
                                                                <font style="color: #00b777">Paid</font>
                                                            @else
                                                                @if($installment->installment_amount>0 && $installment->amount_paid>0)
                                                                    <font style="color:red;">Pending</font>
                                                                @else
                                                                    Pending
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if($installment->description=="Booking-1")
                                                                <font style="color: #00b777">Paid</font>
                                                            @else
                                                                @if($installment->installment_amount>0 && $installment->amount_paid>0)
                                                                    <font style="color:red;">Pending</font>
                                                                @else
                                                                    <font style="color: #00b777">Paid</font>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td class="text-center" style="padding:1px;"></td>
                                                    <td class="text-center" style="padding:1px;">
                                                        @if($installment->description=="Booking")
                                                            {{ number_format($installment->amount_check,2) }}
                                                        @else
                                                            {{ number_format($installment->amount_paid,2) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @php
                                                    $subtotal += $installment->installment_amount;
                                                    if($installment->status==1)
                                                    {
                                                        $rece +=$installment->installment_amount;
                                                    }
                                                    if($installment->description!="Booking" && $installment->amount_paid>0)
                                                    {
                                                        $total_installment_received += $installment->amount_paid;
                                                    }
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <th class="summary total text-center"  style="padding:1px;">Total Agreed Amount</th>
                                                <th class="amount total-value text-center"  style="padding:1px;">{{ number_format($booking->agreed_price,2) }}</th>
                                                <td style="padding:1px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <th class="summary total text-center"  style="padding:1px;">Discount</th>
                                                <th class="amount total-value text-center"  style="padding:1px;">{{ number_format($booking->discount,2) }} -</th>
                                                <td style="padding:1px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <th class="summary total text-center"  style="padding:1px;">Remaining Amount</th>
                                                <th class="amount total-value text-center"  style="padding:1px;">{{ number_format($booking->agreed_price-$booking->discount,2) }}</th>
                                                <td style="padding:1px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <th class="summary text-center" style="padding:1px;">Advance Amount</th>
                                                <th class="amount text-center" style="padding:1px;">{{ number_format($booking->received,2) }} -</th>
                                                <td style="padding:1px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <th class="summary text-center" style="padding:1px;">Total Installments Amount</th>
                                                <th class="amount text-center" style="padding:1px;">{{ number_format($booking->agreed_price-$booking->discount-$booking->received,2) }} </th>
                                                <td style="padding:1px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <th class="summary text-center" style="padding:1px;">Installment Amount Received</th>
                                                <th class="amount text-center" style="padding:1px;">{{number_format($total_installment_received,2)}} -</th>
                                                <td style="padding:1px;"></td>
                                            </tr>

                                            <tr>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <td style="padding:1px;"></td>
                                                <th class="summary text-center" style="padding:1px;">Remaining Amount </th>
                                                <th class="amount text-center" style="padding:1px;">{{ number_format(($booking->agreed_price-$booking->discount-$booking->received)-$total_installment_received,2) }}
                                                    <input type="hidden" id="checking" value="{{ ($booking->agreed_price-$booking->discount-$booking->received)-$total_installment_received }}">
                                                </th>
                                                <td style="padding:1px;"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
        $(document).ready(function(){
            //initialize the javascript
            // App.init();
            App.dataTables();
            App.formElements();

            let amount = $('#checking').val();

            if(amount=="0" || amount==0)
            {
                $(".btnsave").attr("disabled", true);
                // $('.btnsave').disabled();
            }
        });
        function validateForm()
        {
            const amount      = $('#amount_paid').val();
            const installment = $('#installment_amount').val();
            if(amount<=0)
            {
                $('#amount_paid').focus();
                $('#amount_paid').css('border-color','red');
                console.log('amount');
                console.log(amount);
                return false;
            }
            else
            {
                const result = Math.ceil(amount/installment);
                $('#installment_amount_count').val(result);
                return true;
            }
        }
    </script>
@endsection
