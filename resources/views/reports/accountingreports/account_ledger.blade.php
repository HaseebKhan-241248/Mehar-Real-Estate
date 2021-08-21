@extends('admin.layouts.app')
@section('content')
    <style>
        .custom_margin
        {
            margin-top: 0 !important;
        }
        .fontStyle
        {
            font-family: 'Material Icons';
        }
        .marginpadding
        {
            padding:0px !important;
            margin:0px !important;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                        <div class="panel-body">
                            <div class="row invoice-data" style="margin-bottom:0;">
                                <div class="col-xs-12 invoice-person">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                     <h1 id="project_name" class="fontStyle">
                                                         {{ $project_name  }} (Mehr Ali Developers)
                                                     </h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <h3 class="custom_margin fontStyle">Multan</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-8">
                                                    <hr class="custom_margin" style="height: 7px;background-color: black;border-radius: 50px;">
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    @php
                                                        $source1 = $startdate;
                                                        $date1   = new DateTime($source1);
                                                        $source2 = $enddate;
                                                        $date2   = new DateTime($source2);

                                                        @endphp
                                                    <h3 class="custom_margin fontStyle " style="font-style: italic;">Ledger From: {{ $date1->format('d-m-Y') }} To: {{ $date2->format('d-m-Y') }} </h3>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table  width="60%">
                                                        <tr><th>&nbsp</th></tr>
                                                        <tr><th>&nbsp</th></tr>
                                                        <tr>
                                                            <th >Account Name:</th>
                                                            <td id="start">{{ $account->account_name }}</td>
{{--                                                            <th style="text-align: end;">To:</th>--}}
{{--                                                            <td id="end">{{ $enddate }}</td>--}}
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <table  style="float: right;margin-right: 50px;" width="50%">
                                                        <tr>
                                                            <th>O/S User:</th>
                                                            <td>Mehr Devolpers</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Terminal:</th>
                                                            <td>DB-SERVER</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Report Run Time:</th>
                                                            <td id="time">
                                                                {{ \Carbon\Carbon::parse()->format('d M Y') }}
                                                                @php
                                                                    date_default_timezone_set("Asia/Karachi");
                                                                    echo  date("h:i:sa");
                                                                @endphp
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <center>
                                                <h1 style="font-family: Emoji,serif;  background-color: #1572E8;color: white;" class="test text-uppercase">Account Ledger</h1>
                                            </center>
                                            <table class="table table-bordered" style="border-collapse: collapse;width:100%;margin-top:-10px;">
                                                <thead>
                                                <tr style="font-size: 11px;background-color: #1572E8;color: white;" class="text-uppercase ">
{{--                                                    <th class="text-center test1" style="padding:1px;">Account Title and Description</th>--}}
                                                    <th class="text-center test1" style="padding:1px;">Voucher Date</th>
                                                    <th class="text-center test1" style="padding:1px;">Voucher#</th>
                                                    <th class="text-center test1" style="padding:1px;">Voucher Type</th>
                                                    <th class="text-center test1" style="padding:1px;">Chq#</th>
                                                    <th class="text-center test1" style="padding:1px;">Narration</th>
                                                    <th class="text-center test1" style="padding:1px;">Debit</th>
                                                    <th class="text-center test1" style="padding:1px;">Credit</th>
                                                    <th class="text-center test1" style="padding:1px;">Balacne</th>
                                                </tr>
                                                </thead>
                                                <tbody id="">
                                                @php
                                                    $balance = 0;
                                                    $totalDB = 0;
                                                    $totalCR = 0;
                                                @endphp
                                                @foreach($ledgers as $ledger)
                                                <tr class="text-center">
                                                    <td class="marginpadding" >{{ \Carbon\Carbon::parse($ledger->day)->format('d M Y') }}</td>
                                                    <td class="marginpadding">
                                                        {{ $ledger->jv_id }}
                                                    </td>
                                                    <td class="marginpadding">

                                                        {{ $ledger->type }}
                                                    </td>
                                                    <td class="marginpadding">{{ $ledger->cheque_no }}</td>
                                                    <td class="marginpadding">{{ $ledger->remarks }}</td>
                                                    <td class="marginpadding">{{ number_format($ledger->debit,2) }}</td>
                                                    <td class="marginpadding">{{ number_format($ledger->credit,2) }}</td>
                                                    @php
                                                        $balance += $ledger->debit;
                                                        $balance -= $ledger->credit;

                                                        $totalDB += $ledger->debit;
                                                        $totalCR += $ledger->credit;
                                                    @endphp
                                                    <td class="marginpadding">{{ number_format($balance,2) }}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <th  class="text-right" colspan="5">Total</th>
                                                    <th class="text-center" >{{ number_format($totalDB,2) }}</th>
                                                    <th class="text-center" >{{ number_format($totalCR,2) }}</th>
                                                    <th class="text-center" >{{ number_format($balance,2) }}</th>
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
                $(document).ready(function() {
                    //custom wrote clock
                    function updateClock() {
                        var currentTime = new Date();
                        var currentHours = currentTime.getHours();
                        var currentMinutes = currentTime.getMinutes();
                        var currentSeconds = currentTime.getSeconds();
                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth() + 1;
                        var yyyy = today.getFullYear();
                        if (dd < 10) {
                            dd = '0' + dd
                        }
                        if (mm < 10) {
                            mm = '0' + mm
                        }
                        var today = mm + '/' + dd + '/' + yyyy ;
                        currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
                        currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
                        var timeOfDay  = (currentHours < 12) ? "AM" : "PM";
                        currentHours   = (currentHours > 12) ? currentHours - 12 : currentHours;
                        currentHours   = (currentHours == 0) ? 12 : currentHours;
                        var currentTimeString = today + "&nbsp;&nbsp;&nbsp;" + currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay ;
                        var currentTimeStringforCheckout = currentHours + ":" + currentMinutes + " " + timeOfDay;
                        $("#time").html("{{ \Carbon\Carbon::parse()->format('d M Y') }} "+currentTimeStringforCheckout);
                    }
                    window.onload = updateClock();
                    setInterval(function() {
                        updateClock();
                    }, 1000);

                });


                $(document).ready(function(){
                    App.formElements();
                });
            </script>
@endsection

