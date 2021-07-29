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
<style media="">
    @page { size: auto;  margin: 0mm; }
    @media print {
        body {
            -webkit-print-color-adjust: exact !important;
            /*background-color: #f5f5f5 !important;*/

        }
        div .general
        {
            padding-top: 50px;border-bottom: 1px solid;margin-left: 45px;
        }
        .test
        {
            font-family: Emoji,serif !important;
            background-color: #1572E8 !important;
            color: white !important;
        }
        hr.projectHeading
        {

            margin-top: 48px !important;
        }

        .invoice.customHr{
            height: 4px !important;
            background-color: #1572E8 !important;
            margin-top: auto !important;
        }

        tr th.test1
        {
            font-size: 11px !important;
            /*background-color: #1572E8 !important;*/
            color: #1572E8 !important;
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

<div class="container" id="">
    <div class="main-content container-fluid" id="print_summery">
        <div class="row">
            <div class="col-md-12">

                <div class="invoice" style="margin-top: 0;">
                    <button class="btn btn-success" style="margin:10px; " id="buttonPrint1" onClick="test()">Print</button>
                    <div class="row" style="display: flex;">
                        <div class="col-md-6 " style="width: 50%;margin-top: 45px;">
                            <h1 class="" style="color: black;font-family: Emoji,serif;font-weight: bold;padding: 12px;">
                                @if($booking->Project_Name)
                                    {{ $booking->Project_Name->name }}
                                @endif
                            </h1>
                        </div>
                        <div class="col-md-6 " style="width: 50%;">
                             <span style="display: flex;justify-content: flex-end;">
 <img  class="thumbnail" width="100" height="100" @if($booking->Project_Name) src="{{ asset('') }}images/{{ $booking->Project_Name->logo }}" @endif alt="">
                    </span>

                        </div>
                    </div>
                    <hr color="customHr" style="height: 4px !important;background-color: #1572E8 !important;margin-top: auto !important;">



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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <h1 style="font-family: Emoji,serif;  background-color: #1572E8;color: white;" class="test text-uppercase">Payment Schedule</h1>
                            </center>

                            <table class="table table-striped table-hover table-bordered" style="border-collapse: collapse;width:100%;margin-top:-10px;">
                                <thead>
                                <tr style="font-size: 11px;background-color: #1572E8;color: white;" class="text-uppercase ">
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
                                <?php
                                $subtotal=0;
                                $rece=0;
                                $total_installment_received =0;
                                ?>
                                @foreach($installments as $installment)
                                    <tr style="color:black;">
                                        <td class="text-center test" style="padding:1px;">{{ $counter++ }}</td>
                                        <td class="text-center" style="padding:1px;width: 15%;">{{ \Carbon\Carbon::parse($installment->date)->format('d M Y') }}</td>
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
                                                @if($installment->description=="Booking")
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

                                </tr>
                                <tr>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <th class="summary total text-center"  style="padding:1px;">Discount</th>
                                    <th class="amount total-value text-center"  style="padding:1px;">{{ number_format($booking->discount,2) }} -</th>

                                </tr>
                                <tr>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <th class="summary total text-center"  style="padding:1px;">Remaining Amount</th>
                                    <th class="amount total-value text-center"  style="padding:1px;">{{ number_format($booking->agreed_price-$booking->discount,2) }}</th>

                                </tr>
                                <tr>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <th class="summary text-center" style="padding:1px;">Advance Amount</th>
                                    <th class="amount text-center" style="padding:1px;">{{ number_format($booking->received,2) }} -</th>

                                </tr>
                                <tr>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <th class="summary text-center" style="padding:1px;">Total Installments Amount</th>
                                    <th class="amount text-center" style="padding:1px;">{{ number_format($booking->agreed_price-$booking->discount-$booking->received,2) }} </th>

                                </tr>
                                <tr>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <th class="summary text-center" style="padding:1px;">Installment Amount Received</th>
                                    <th class="amount text-center" style="padding:1px;">{{number_format($total_installment_received,2)}} -</th>
                                </tr>
                                <tr>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <td style="padding:1px;"></td>
                                    <th class="summary text-center" style="padding:1px;">Remaining Amount </th>
                                    <th class="amount text-center" style="padding:1px;">{{ number_format(($booking->agreed_price-$booking->discount-$booking->received)-$total_installment_received,2) }}</th>

                                </tr>
                                </tbody>
                            </table>
                            <div class="" style="display: flex;">
                                <div class="" style="width: 25%;">
                                    <h4><b>Client Signature</b></h4>
                                </div>
                                <div class="" style="width: 25%;">

                                </div>
                                <div class="" style="width: 25%;">

                                </div>
                                <div class="" style="width: 25%;">
                                    <h4><b>General Manager Sales</b></h4>
                                </div>
                            </div>
                            <div class="" style="display: flex;">
                                <div class="" style="padding-top: 50px;border-bottom: 1px solid;width: 25%;"></div>
                                <div class=""style="width: 25%;" ></div>
                                <div class="" style="width: 25%;"></div>
                                <div class=""  style="width: 25%;padding-top: 50px;border-bottom: 1px solid;"></div>
                            </div>
                        </div>

                    </div>
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
        // $('#buttonPrint').hide();
        var printContents = document.getElementById("print_summery").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        // window.print();
    }
    $(document).ready(function(){
        App.formElements();
    });
</script>
