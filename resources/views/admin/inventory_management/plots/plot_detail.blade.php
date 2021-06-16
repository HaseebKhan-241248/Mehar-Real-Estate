<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-fav.png') }}">
    <title>Real Estate</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/material-design-icons/css/material-design-iconic-font.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/select2/css/select2.min.css') }}"/>
</head>
<style media="print">
    @media print {
        body {
            -webkit-print-color-adjust: exact !important;
            /*background-color: #f5f5f5 !important;*/

        }
        .test
        {
            font-family: Emoji,serif !important;
            background-color: lightgray !important;
            color: black !important;
        }
        tr th.test1
        {
            font-size: 11px !important;background-color: lightgray !important;color: black !important;
        }
        .customCheck{
            color:green !important;
            font-size: 30px !important;
        }

    }


    @media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
        /* IE10+ CSS print styles go here */
        @page {
            size: auto;   /* auto is the initial value */
            margin: 0;  /* this affects the margin in the printer settings */
            border: 1px solid red;  /* set a border for all printed pages */
        }
    }
    td
    {
        height:10px;
    }

    .customHeading{
        text-align: center !important;
        background-color: lightgray !important;
        font-weight: bold !important;
        padding: 12px !important;
        border: 1px solid black !important;
        margin-top: 0 !important;
    }
    .customModal{
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }


</style>
<body>
<div class="container" id="print_summery">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{--                <div class="panel">--}}
                {{--                   --}}
                {{--                </div>--}}
                <div class="invoice" style="margin-top: 0;">
                    <button class="btn btn-success" style="margin:10px; " id="buttonPrint1" onClick="test()">Print</button>
                    <div class="row">

                        <div class="col-md-12 ">
                            <h1 class="test" style="text-align: center;color: black;font-family: Emoji,serif;background-color: lightgray;font-weight: bold;padding: 12px;border: 1px solid black;margin-top: 0;">
                                @if($booking->Project_Name)
                                    {{ $booking->Project_Name->name }}
                                @endif
                            </h1>
                        </div>
                    </div>
                    <div class="row invoice-data" style="margin-bottom:0;">
                        <div class="col-xs-12 invoice-person">
                            <table class="table table-bordered">
                                <tr class="test1" style="background-color:lightgray;">
                                    <th class="text-center  test1 text-uppercase " style="color: black;padding:1px;">Client Name</th>
                                    <th class="text-center test1" style="color: black;padding:1px;">
                                        @if($booking->Customer_Name)
                                            {{$booking->Customer_Name->name}}
                                        @endif
                                    </th>

                                </tr>
                                <tr>
                                    <th class="text-center text-uppercase" style="color: black;padding:1px;">Booking No</th>
                                    <th class="text-center text"  style="color: black;padding:1px;">{{ $booking->id }}</th>
                                </tr>
                                <tr>
                                    <th class="text-center text-uppercase" style="color: black;padding:1px;">Sector</th>
                                    <th class="text-center" style="color: black;padding:1px;">
                                        @if($booking->Sector_Name)
                                            {{ $booking->Sector_Name->name }}
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center text-uppercase" style="color: black;padding:1px;">Block</th>
                                    <th class="text-center" style="color: black;padding:1px;">
                                        @if($booking->Block_Name)
                                            {{ $booking->Block_Name->name }}
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center text-uppercase" style="color: black;padding:1px;">Plot no</th>
                                    <th class="text-center" style="color: black;padding:1px;">
                                        @if($booking->Plot_Name)
                                            {{ $booking->Plot_Name->name }}  -Marla
                                        @endif
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <h1 style="font-family: Emoji,serif;  background-color: lightgray;color: black;" class="test text-uppercase">Payment Schedule</h1>
                            </center>

                            <table class="table table-striped table-hover table-bordered" style="border-collapse: collapse;width:100%;margin-top:-10px;">
                                <thead>
                                <tr style="font-size: 11px;background-color: lightgray;color: black;" class="text-uppercase ">
                                    <th class="text-center test1" style="padding:1px;">SR#</th>
                                    <th class="text-center test1" style="padding:1px;">Due Date</th>
                                    <th class="text-center test1" style="padding:1px;">Mode of Payment</th>
                                    <th class="text-center test1" style="padding:1px;">Installment Amount</th>
                                    <th class="text-center test1" style="padding:1px;">Status</th>
                                    <th class="text-center test1" style="padding:1px;">Receipt#</th>
                                    <th class="text-center test1" style="padding:1px;">Amount Paid</th>
                                    {{--                                    <th class="text-center test1" style="padding:1px;">Action</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $subtotal=0;
                                $rece=0;
                                ?>
                                @foreach($installments as $installment)
                                    <tr style="color:black;">
                                        <td class="text-center test" style="padding:1px;">{{ $counter++ }}</td>
                                        <td class="text-center" style="padding:1px;">{{ \Carbon\Carbon::parse($installment->date)->format('d M Y') }}</td>
                                        <td class="text-center" style="padding:1px;">{{ $installment->description }}</td>
                                        <td class="text-center" style="padding:1px;">
                                            {{ number_format($installment->amount_check,2) }}
                                        </td>
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
                                            @if($installment->description=="Booking-1")
                                                {{ number_format($installment->amount_check,2) }}
                                            @else
                                                {{ number_format($installment->amount_paid,2) }}
                                            @endif
                                        </td>

{{--                                        @if($installment->status==0 || $installment->installment_amount!=0)--}}
{{--                                            --}}{{--                                            <td class="text-center" style="padding:1px;">--}}
{{--                                            --}}{{--                                                @if($installment->description=="Booking")--}}
{{--                                            --}}{{--                                                    <i style="color:green;font-size: 30px;" class="mdi mdi-check customCheck"></i>--}}
{{--                                            --}}{{--                                                @else--}}
{{--                                            --}}{{--                                                    --}}{{----}}{{--                                                    <button class="btn btn-info btn-sm" id="btn_paid" onclick="paidInstallment({{ $installment->id }},{{ $installment->installment_amount }})">Paid</button>--}}
{{--                                            --}}{{--                                                    <button data-toggle="modal" data-target="#form-bp1{{ $installment->id }}" type="button"  class="btn btn-primary  btn-sm">Pay</button>--}}
{{--                                            --}}{{--                                                @endif--}}

{{--                                            --}}{{--                                            </td>--}}
{{--                                        @else--}}
{{--                                            --}}{{--                                            <td class="text-center" style="padding:1px;">--}}
{{--                                            --}}{{--                                                <i style="color:green;font-size: 30px;" class="mdi mdi-check customCheck"></i>--}}
{{--                                            --}}{{--                                            </td>--}}
{{--                                        @endif--}}
                                    </tr>
                                    @php
                                        $subtotal += $installment->installment_amount;
                                        if($installment->status==1)
                                        {
                                            $rece +=$installment->installment_amount;
                                        }
                                    @endphp
                                @endforeach
                                <tr>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <th class="summary text-center" style="padding:1px;">Subtotal</th>
                                    <th class="amount text-center" style="padding:1px;">{{number_format($subtotal,2)}}</th>
                                    <td style="padding:1px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <th class="summary text-center" style="padding:1px;">Advance Amount</th>
                                    <th class="amount text-center" style="padding:1px;">{{ number_format($booking->received,2) }}</th>
                                    <td style="padding:1px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <th class="summary text-center" style="padding:1px;">Amount Received</th>
                                    <th class="amount text-center" style="padding:1px;">{{ number_format($rece,2) }}</th>
                                    <td style="padding:1px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <th class="summary total text-center" style="padding:1px;">Remaining Amount</th>
                                    <th class="amount total-value text-center" style="padding:1px;">{{ number_format($booking->agreed_price-$booking->received-$rece,2) }}</th>
                                    <td style="padding:1px;"></td>
                                </tr>
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
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{--                            <center>--}}
                            {{--                                <h1 style="font-family: Emoji,serif; background-color: #0c0c0c;color: whitesmoke;" class="test">Installment Plans</h1>--}}
                            {{--                            </center>--}}
                            <br>
                            {{--                            <table class="table table-striped table-hover">--}}
                            {{--                                <thead>--}}
                            {{--                                <tr>--}}
                            {{--                                    <th>Subplan#</th>--}}
                            {{--                                    <th>No. of Months</th>--}}
                            {{--                                    <th>Amount</th>--}}
                            {{--                                </tr>--}}
                            {{--                                </thead>--}}
                            {{--                                <tbody>--}}
                            {{--                                @if($booking->BookingPlans)--}}
                            {{--                                    @foreach($booking->BookingPlans as $plan)--}}
                            {{--                                        <tr>--}}
                            {{--                                            <td>Subplan#{{ $plan->subplan }}</td>--}}
                            {{--                                            <td>{{ $plan->months }}-Months</td>--}}
                            {{--                                            <td>{{ number_format($plan->amount,2) }}</td>--}}
                            {{--                                        </tr>--}}
                            {{--                                    @endforeach--}}
                            {{--                                @endif--}}
                            {{--                                </tbody>--}}
                            {{--                            </table>--}}
                        </div>
                    </div>
                    {{--                                        <div class="row">--}}
                    {{--                                            <div class="col-md-12 invoice-payment-method">--}}
                    {{--                                                <span class="title">Payment Method</span>--}}
                    {{--                                                <span>Credit card</span>--}}
                    {{--                                                <span>Credit card type: mastercard</span>--}}
                    {{--                                                <span>Number verification: 4256981387</span>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="row">--}}
                    {{--                                            <div class="col-md-12 invoice-message">--}}
                    {{--                                                <span class="title">Thank you for contacting us</span>--}}
                    {{--                                                <p></p>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="row invoice-company-info">--}}
                    {{--                                            <div class="col-sm-6 col-md-2 logo">--}}
                    {{--                                                <img src="{{ asset('assets/img/logo-symbol.png') }}" alt="Logo-symbol">--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="col-sm-6 col-md-4 summary">--}}
                    {{--                                                <span class="title">Beagle Company</span>--}}
                    {{--                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="col-sm-6 col-md-3 phone">--}}
                    {{--                                                <ul class="list-unstyled">--}}
                    {{--                                                    <li>+1(535)-8999278</li>--}}
                    {{--                                                    <li>+1(656)-3558302</li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="col-sm-6 col-md-3 email">--}}
                    {{--                                                <ul class="list-unstyled">--}}
                    {{--                                                    <li>beagle@company.co</li>--}}
                    {{--                                                    <li>beagle@support.co</li>--}}
                    {{--                                                </ul>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="row invoice-footer">--}}
                    {{--                                            <div class="col-md-12">--}}
                    {{--                                                <button class="btn btn-lg btn-space btn-default">Save PDF</button>--}}
                    {{--                                                <button class="btn btn-lg btn-space btn-default">Print</button>--}}
                    {{--                                                <button class="btn btn-lg btn-space btn-primary">Pay now</button>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($installments as $installment)
    <div id="form-bp1{{ $installment->id }}"  role="dialog" class="modal fade colored-header colored-header-primary">
        <div class="modal-dialog customModal" style="    width: fit-content !important;">
            <form class="user" action="{{route('save.plot')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                        <h3 class="modal-title">Receipt</h3>
                    </div>
                    <div class="modal-body">
                        <div class=" row">
                            <div class="col-md-4">
                                <label class="text-primary">Receipt No:</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="number" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="text-primary">Booking No</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="number" readonly class="form-control" value="{{ $installment->booking_id }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="text-primary">Date</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="date"  class="form-control" value="" name="day">
                                </div>
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-md-6">
                                <label class="text-primary">Received with thanks from MR./Mrs./Ms.</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" class="form-control" readonly @if($booking->Customer_Name) value="{{ $booking->Customer_Name->name }}" @endif>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">S/o, D/o, W/o</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" class="form-control" readonly @if($booking->Customer_Name) value="{{ $booking->Customer_Name->father_name }}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-md-6">
                                <label class="text-primary">Through Pay Order/Bank Draft No.</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <select name="" id="" class="select2">
                                        <option value="">Select One</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">Dated</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="date" name="" value=""  class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="text-primary">Drawn Bank</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="text-primary">On Account Of</label>
                                <select name="" id="" class="select2">
                                    <option value="">Select One</option>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <lable class="text-primary">Plot No</lable>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" class="form-control" @if($booking->Plot_Name) value="{{ $booking->Plot_Name->name }}" @endif>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <lable class="text-primary"></lable>
                                <input type="text"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <lable class="text-primary">Plot No</lable>
                                <input type="text">
                            </div>
                            <div class="col-md-6">
                                <lable class="text-primary"></lable>
                                <input type="text"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
                        <button   class="btn btn-primary ">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444 !important;
            line-height: 39px !important;
            /*outline: none !important;*/
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-style: none !important;
            margin-top: -10px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 12px !important;
            position: absolute !important;
            top: 1px !important;
            right: 1px !important;
            /* width: 20px; */
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            height: auto !important;
        }
    </style>
@endforeach
<script src="{{ asset('assets/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/js/app-form-elements.js')}}" type="text/javascript"></script>
</body>
</html>
<script type="text/javascript">
    function paidInstallment(installment_id,intallmentAmount)
    {
        console.log(installment_id);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var request    = $.ajax({
            url: "{{route('paid.installment')}}",
            method: "post",
            data: {_token: CSRF_TOKEN, installment_id:installment_id,intallmentAmount:intallmentAmount},
            dataType: "html"
        });
        request.done(function( msg ) {
            console.log(msg);
            location.reload();
        });
    }
    function test()
    {
        $('#buttonPrint1').hide();
        window.print();
    }
    $(document).ready(function(){

        App.formElements();
    });
</script>
