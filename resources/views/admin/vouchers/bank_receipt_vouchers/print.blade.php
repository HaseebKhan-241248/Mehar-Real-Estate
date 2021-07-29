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
    <title>Journal Voucher Print</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/material-design-icons/css/material-design-iconic-font.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css"/>
</head>
<style media="">
    @page { size: auto;  margin: 0mm; }
</style>
<body>

<div class="container" id="">
    <div class="main-content container-fluid" id="print_summery">
        <div class="row">
            <div class="col-md-12">
                <div class="invoice" style="margin-top: 0;">
                    {{--                    <button class="btn btn-success" style="margin:10px; " id="buttonPrint1" onClick="test()">Print</button>--}}
                    <center>
                        <h1 class="" style="color:black;">
                            <u>
                                @if($project)
                                    {{ $project->name}}
                                @endif
                            </u>
                        </h1>
                    </center>
                    <hr color="customHr" style="height: 5px !important;background-color: black !important;margin-top: auto !important;">
                    <div class="row invoice-data" style="margin-bottom:0;">
                        <div class="col-xs-12 invoice-person">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin-top: -30px;color: black;">
                            <center>
                                <h3 style="font-family: Emoji,serif; " class="test text-uppercase">Bank Receipt Voucher</h3>
                            </center>
                            <div style="display: flex;border: 1px solid black;border-bottom: none;">
                                <table width="50%" style="line-height:1.7;">
                                    <tr>
                                        <th style="width: 30% !important;">Voucher No.</th>
                                        <td>{{ $journal->voucher_no }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 30% !important;">Dated</th>
                                        <td>{{ \Carbon\Carbon::parse($journal->day)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 30% !important;">Status</th>
                                        <td>
                                            @if($journal->is_posted=="1")
                                                Posted
                                            @else
                                                Pending
                                            @endif
                                        </td>
                                    </tr>
                                </table>


                                <table width="50%" style="line-height:1.7;">
                                    <tr>
                                        <th style="width: 57% !important;text-align: end;">User</th>
                                        <td style="text-align: end;">
                                            @if($journal->User_Name)
                                                {{ strtoupper($journal->User_Name->name) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 57% !important;text-align: end;">Terminal</th>
                                        <td style="text-align: end;">DB-SERVER</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 57% !important;text-align: end;">Run Time Date</th>
                                        <td style="text-align: end;">{{ \Carbon\Carbon::parse()->format('d M Y') }} {{$time}}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <table class="" border="1px" width="100%" style="margin-top: -18px;border: 1px solid black;">

                                <tr>
                                    <th class="text-center">Sr#</th>
                                    <th class="text-center">Account Name</th>
                                    <th class="text-center">DEBIT</th>
                                    <th class="text-center">CREDIT</th>
                                </tr>

                                <tbody>
                                @forelse($entries as $entry)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        @if($entry->debit>0)
                                            <td style="width: 50%;">
                                                @if($entry->Account_Name)
                                                    {{ $entry->Account_Name->account_name }}
                                                    ({{$entry->Account_Name->sub_account_type}})
                                                @endif
                                            </td>
                                        @else
                                            <td style="width: 50%;padding-left: 75px;">
                                                @if($entry->Account_Name)
                                                    {{ $entry->Account_Name->account_name }}
                                                    ({{$entry->Account_Name->sub_account_type}})
                                                @endif
                                            </td>
                                        @endif
                                        <td style="text-align: end;">{{ number_format($entry->debit,2) }}</td>
                                        <td style="text-align: end;">{{ number_format($entry->credit,2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="4">No Data Found</th>
                                    </tr>
                                @endforelse
                                <tr>
                                    <th colspan="2" style="text-align: end;">Total:</th>
                                    <th style="text-align: end;">{{ number_format($journal->total,2) }}</th>
                                    <th style="text-align: end;">{{ number_format($journal->total,2) }}</th>
                                </tr>
                                </tbody>
                                <tr><th colspan="4">{{ $journal->amount_in_words }}</th></tr>
                                <tr><th colspan="4"> &nbsp&nbsp&nbsp</th></tr>
                                <tr>
                                    <th colspan="4" style="height: 80px;padding-top: 30px;">
                                        <div class="" style="display: flex;">
                                            <div class="" style="width: 8%;">&nbsp</div>
                                            <div class="" style="border-bottom: 1px solid black;width: 16%;"></div>
                                            <div class="" style="width: 2%;">&nbsp</div>
                                            <div class="" style="border-bottom: 1px solid black;width: 16%;padding-left: 10px;"></div>
                                            <div class="" style="width: 2%;">&nbsp</div>
                                            <div class="" style="border-bottom: 1px solid black;width: 16%;padding-left: 10px;"></div>
                                            <div class="" style="width: 2%;">&nbsp</div>
                                            <div class="" style="border-bottom: 1px solid black;width: 16%;padding-left: 10px;"></div>
                                            <div class="" style="width: 2%;">&nbsp</div>
                                            <div class="" style="border-bottom: 1px solid black;width: 16%;padding-left: 10px;"></div>
                                        </div>
                                        <div class="" style="display: flex;">
                                            <div class="" style="width: 8%;">&nbsp</div>
                                            <div class="" style="width: 16%;text-align: center;">Prepared By</div>
                                            <div class="" style="width: 2%;">&nbsp</div>
                                            <div class="" style="width: 16%;text-align: center;padding-left: 10px;">Checked By</div>
                                            <div class="" style="width: 2%;">&nbsp</div>
                                            <div class="" style="width: 16%;padding-left: 10px;text-align: center;">Chief Accountant</div>
                                            <div class="" style="width: 2%;">&nbsp</div>
                                            <div class="" style="width: 16%;padding-left: 10px;text-align: center;">Director</div>
                                            <div class="" style="width: 2%;">&nbsp</div>
                                            <div class="" style="width: 16%;padding-left: 10px;text-align: center;">Received</div>
                                        </div>
                                    </th>
                                </tr>
                            </table>
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
    $(document).ready(function(){
        window.print();
    });
</script>
