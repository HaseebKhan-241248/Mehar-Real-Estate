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
        .container {
            -webkit-print-color-adjust: exact !important;
        }
        .invoice{
            background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAYAAADgkQYQAAAARUlEQVQoU2NkQANqN2X+g4RuqT9hhEnBGTBJdE0gxSiKkHWDFIM0whXBOOimwBQSbxKy0cimkW8dsteRgwLuJpg12MIJAIW+OD7UbY0+AAAAAElFTkSuQmCC) !important;

        }
        .customcolor{
            width:50%;height: auto !important;
            position: relative !important;
            left: 50% !important;
            top: 50% !important;
            transform:translate(-50%,-50%) !important;
        }
        .customerlinear{
            background: linear-gradient(0deg, #ffffff 0%, rgba(253,167,45,0) 100%) !important;
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

    .customerlinear{
        background: linear-gradient(0deg, #ffffff 0%, rgba(253,167,45,0) 100%);
    }
</style>
<body>
<div class="container" id="print_summery">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="invoice " style="background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAYAAADgkQYQAAAARUlEQVQoU2NkQANqN2X+g4RuqT9hhEnBGTBJdE0gxSiKkHWDFIM0whXBOOimwBQSbxKy0cimkW8dsteRgwLuJpg12MIJAIW+OD7UbY0+AAAAAElFTkSuQmCC) ;width: 3.8in;color:black;height: 2.27in;margin:0 auto;border:1px solid black;border-radius: 6px;padding: 0px !important;overflow: hidden;">
                    <div style="width: 100%;">
                        <h3 class="bg-black" style="text-align:center;"><b><u>Customer Card</u></b></h3>
                    </div>
                    <div class="customerlinear" style="width: 100%;display: flex;justify-content: space-between;height: 75%;">
                        <div class="left" style="width: 50%; " >
                            <div style="height:fit-content; width: fit-content;position: relative; left: 50%;top: 50%;transform: translate(-50%,-50%);">
                                <div >
                         <span style="font-size: 14px;">
                             <strong > Customer Name:</strong>
                         </span>
                                    {{ $customer->name }}
                                </div>
                                <div>
                         <span style="font-size: 14px;">
                            <strong> CNIC:</strong>
                         </span>
                                    {{ $customer->id_card_no }}
                                </div>
                                <div>
                         <span style="font-size: 14px;">
                             <strong> Address:</strong>
                         </span>
                                    {{ $customer->address }}
                                </div>
                                <div>
                         <span style="font-size: 14px;">
                             <strong> Email:</strong>
                         </span>
                                    {{ $customer->email }}
                                </div>
                                <div>
                         <span style="font-size: 14px;">
                             <strong> Phone#:</strong>

                         </span>
                                    {{ $customer->phone1 }}
                                </div>
                            </div>


                        </div>
                        <div class="right" style="width: 50%">
                            <img class="thumbnail customcolor"  style="width:50%;height: auto;position: relative; left: 50%;top: 50%;transform: translate(-50%,-50%)"  src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{url('/')}}/customer-detail/{{ $customer->id }}" alt="">
                        </div>
                    </div>



                    {{--                    <div class="row invoice-header">--}}

                    {{--                        <div class="col-xs-7">--}}
                    {{--                            <div >--}}
                    {{--                                <img class="thumbnail" width="20%" height="20%" src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{url('/')}}/customer-idcard-print/{{ $customer->id }}" alt="">--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="col-xs-5 invoice-order">--}}
                    {{--                            <button class="btn btn-success" style="margin:10px; " id="buttonPrint1" onClick="test()">Print</button>--}}
                    {{--                            <span class="invoice-id"><b>Customer Name: </b> {{ $customer->name }}</span>--}}
                    {{--                            <span class="incoice-date"></span>--}}
                    {{--                            <span class="incoice-date"></span>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="row invoice-data">--}}
                    {{--                        <div class="col-xs-5 invoice-person">--}}
                    {{--                            <div class="row">--}}
                    {{--                                                                <center><h2 for=""><b><u>Customer Information</u></b></h2></center>--}}
                    {{--                                <div class="col-md-12">--}}

                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="col-xs-3 invoice-payment-direction">--}}
                    {{--                            <i class="icon mdi mdi-chevron-right"></i>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="col-xs-4 invoice-person">--}}
                    {{--                            <div class="row">--}}
                    {{--                                <div class="col-md-12">--}}

                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>

            </div>
            <button id="buttonPrint1" onclick="test()" class="btn btn-success btn-sm">Print</button>
        </div>
    </div>
</div>
<script src="{{ asset('assets/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
</body>
</html>
<script type="text/javascript" differ>
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
    function test()
    {
        $('#buttonPrint1').hide();
        window.print();
    }
</script>
