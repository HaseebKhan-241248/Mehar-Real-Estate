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
</head>
<style>
    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
        }
    }
    @media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
        /* IE10+ CSS print styles go here */
        @page {
            size: auto;   /* auto is the initial value */
            size: A4 portrait;
            margin: 0;  /* this affects the margin in the printer settings */
            border: 1px solid red;  /* set a border for all printed pages */
        }
    }

    td
    {
        height:10px;
    }
    .invoice-header {
        margin-bottom: 20px;
    }
</style>
<body>
<div class="container" id="print_summery">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="invoice">
                    <div class="row invoice-header">
                        <div class="col-xs-7">
                            <div>
                                <img class="thumbnail" width="30%" height="30%" src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{url('/')}}/customer-detail/{{$customer->id}}" alt="">
                            </div>
                        </div>
                        <div class="col-xs-5 invoice-order">
                            <button class="btn btn-success" style="margin:10px; " id="buttonPrint1" onClick="printbtn()">Print</button>
                            {{--                            <span class="invoice-id">Plot#@if($booking->Plot_Name){{$booking->Plot_Name->name}}@endif</span>--}}
                            {{--                            <span class="incoice-date">@if($booking->Plot_Name){{$booking->Plot_Name->description}}@endif</span>--}}
                            {{--                            <span class="incoice-date"><b>Plot Size:</b> @if($booking->MarlaSize){{$booking->MarlaSize->marla}} -Marla @endif</span>--}}
                        </div>
                    </div>
                    <div class="row invoice-data">
                        <div class="col-xs-5 invoice-person">
                            <div class="row">
                                <h2 style="color:black;font-family: Emoji,serif;font-style: italic;"><b>Customer Information</b></h2>
                                <div class="col-md-12">
                                    <table style="font-size: 18px;width:100%;color:black;font-family: Emoji,serif;font-style: italic;">
                                        <tr>
                                            <th>Customer Name: </th>
                                            <td>{{$customer->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>CNIC#</th>
                                            <td>{{$customer->id_card_no}}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact#</th>
                                            <td>{{$customer->phone1 }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>{{$customer->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address: </th>
                                            <td>{{$customer->address }}</td>
                                        </tr>
                                        <tr>
                                            <th>City:</th>
                                            <td>{{$customer->city }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 invoice-payment-direction">
                            <i class="icon mdi mdi-chevron-right"></i>
                        </div>
                        <div class="col-xs-4 invoice-person">
                            <div class="row">
                                <div class="col-md-12">
                                    {{--                                    <table style="font-size: 18px;width:100%">--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th>Project: </th>--}}
                                    {{--                                            <td>@if($booking->Project_Name){{ $booking->Project_Name->name }}@endif</td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th>Sector: </th>--}}
                                    {{--                                            <td>@if($booking->Sector_Name){{ $booking->Sector_Name->name }}@endif</td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th>Block: </th>--}}
                                    {{--                                            <td>@if($booking->Block_Name){{ $booking->Block_Name->name }}@endif</td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th>Plot: </th>--}}
                                    {{--                                            <td>@if($booking->Plot_Name){{ $booking->Plot_Name->name }}@endif</td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                    </table>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <center><h1 style="font-family: Emoji,serif; background-color: #0c0c0c;color: whitesmoke;">Bookings</h1></center>
                            <br>
                            {{--                            <table class="table table-striped table-hover table-bordered" style="width:100%">--}}
                            {{--                                <thead>--}}
                            {{--                                <tr style="font-size: 11px;" class="">--}}
                            {{--                                    <th>Installment #</th>--}}
                            {{--                                    <th>Description/Remarks</th>--}}
                            {{--                                    <th>Cheque No.</th>--}}
                            {{--                                    <th>Date</th>--}}
                            {{--                                    <th>Cheque Issue Bank</th>--}}
                            {{--                                    <th>Party Name</th>--}}
                            {{--                                    <th>Status</th>--}}
                            {{--                                    <th>Installment Amount</th>--}}
                            {{--                                    <th>Action</th>--}}
                            {{--                                </tr>--}}
                            {{--                                </thead>--}}
                            {{--                                <tbody>--}}
                            {{--                                <?php--}}
                            {{--                                $subtotal=0;--}}
                            {{--                                ?>--}}
                            {{--                                @foreach($installments as $installment)--}}
                            {{--                                    <tr>--}}
                            {{--                                        <td>{{ $counter++ }}</td>--}}
                            {{--                                        <td>{{ $installment->description }}</td>--}}
                            {{--                                        <td>@if($installment->cheque_no){{ $installment->cheque_no }} @else - @endif</td>--}}
                            {{--                                        <td>{{ \Carbon\Carbon::parse($installment->date)->format('d M Y') }}</td>--}}
                            {{--                                        <td>@if($installment->cheque_bank){{ $installment->cheque_bank }} @else - @endif</td>--}}
                            {{--                                        <td>{{$installment->party_name}}</td>--}}
                            {{--                                        <td>--}}
                            {{--                                            @if($installment->status==0)--}}
                            {{--                                                Pending--}}
                            {{--                                            @else--}}
                            {{--                                                <font style="color: #00b777">Paid</font>--}}
                            {{--                                            @endif--}}
                            {{--                                        </td>--}}
                            {{--                                        <td>{{ number_format($installment->installment_amount,2) }}</td>--}}
                            {{--                                        @if($installment->status==0)--}}
                            {{--                                            <td><button class="btn btn-info btn-sm" id="btn_paid" onclick="paidInstallment({{ $installment->id }})">Paid</button></td>--}}
                            {{--                                        @else--}}
                            {{--                                            <td><i style="color:green;font-size: 30px;" class="mdi mdi-check"></i></td>--}}
                            {{--                                        @endif--}}
                            {{--                                    </tr>--}}
                            {{--                                    <?php--}}
                            {{--                                    $subtotal += $installment->installment_amount;--}}
                            {{--                                    ?>--}}
                            {{--                                @endforeach--}}
                            {{--                                <tr>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <th class="summary">Subtotal</th>--}}
                            {{--                                    <th class="amount">{{number_format($subtotal,2)}}</th>--}}
                            {{--                                    <td></td>--}}
                            {{--                                </tr>--}}
                            {{--                                <tr>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <th class="summary">Advance Amount</th>--}}
                            {{--                                    <th class="amount">{{ number_format($booking->received,2) }}</th>--}}
                            {{--                                    <td></td>--}}
                            {{--                                </tr>--}}
                            {{--                                <tr>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <td></td>--}}
                            {{--                                    <th class="summary total">Total</th>--}}
                            {{--                                    <th class="amount total-value">{{ number_format($booking->agreed_price,2) }}</th>--}}
                            {{--                                    <td></td>--}}
                            {{--                                </tr>--}}
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
<script src="{{ asset('assets/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
</body>
</html>
<script type="text/javascript" >
    function paidInstallment(installment_id)
    {
        console.log(installment_id);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var request    = $.ajax({
            url: "{{route('paid.installment')}}",
            method: "post",
            data: {_token: CSRF_TOKEN, installment_id:installment_id},
            dataType: "html"
        });
        request.done(function( msg ) {
            console.log(msg);
            location.reload();
        });
    }
    function printbtn()
    {
        $('#buttonPrint1').hide();
        window.print();
    }
</script>
