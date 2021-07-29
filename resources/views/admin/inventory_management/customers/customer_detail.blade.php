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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <h1 style="font-family: Emoji,serif; background-color: #0c0c0c;color: whitesmoke;">Bookings</h1>
                            </center>
                            <br>
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
