<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css"/>
    <style media="">
        @media print {
            tr th b.table_header2
            {
                color: white !important;
            }
            tr.tableRowColor{
                background-color: #1572E8 !important;

            }

        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #030303;
            text-align: left;
            padding: 8px;
        }
        .header {text-align: center;}
        .table_header{
            text-align: center;
            border-bottom: 4px solid #030303;
            text-align: center;
            font-size: 33px;
        }
        .table_data {
            text-align: center;
        }
        .table_margin {
            margin: 65px;
        }
        @page { margin: 0; }
    </style>
</head>
<body>
<div id="print_summary">
    @php
        $str = $booking->Project_Name->name;

         $ret = "";
         foreach(explode(' ', $str) as $word)
         {
             $ret .= strtoupper($word[0]);
         }

    @endphp

    <div class="header">
        <img alt="Logo" width="200" height="200"  @if($booking->Project_Name) src="{{ asset('images') }}/{{ $booking->Project_Name->logo }}" @endif style="margin-top: 50px;">
        <br>
        <h1 style="color: black; font-family: serif;">
            @if($booking->Project_Name)
                {{$booking->Project_Name->name}}
            @endif
        </h1>
    </div>
    <div class="table_margin">
        <table>
            <tr class="tableRowColor" style="background-color: #1572E8;">
                <th colspan="2" class="table_header  " style="color: white;">
                    <b class="table_header2">Confirmation Sheet</b>
                </th>
            </tr>
            <tr>
                <th colspan="2"><span style="text-align: left;">  Name : @if($booking->Customer_Name->name)
                            {{ $booking->Customer_Name->name }}
                        @endif </span>
                    <span style="float: right;"> Date : {{ \Carbon\Carbon::parse($booking->day)->format('d m Y') }} </span> </th>
            </tr>
            <tr>
                <th>BOOKING NO.:</th>

                <td class="table_data">{{ $ret }}-{{ $booking->id }}</td>
            </tr>
            <tr>
                <th>PLOT NO:</th>
                <td class="table_data">@if($booking->Plot_Name) {{ $booking->Plot_Name->name }}@endif</td>
            </tr>
            <tr>
                <th>UNIT SIZE:</th>
                <td class="table_data"> @if($booking->MarlaSize) {{ $booking->MarlaSize->marla}} Marla @endif</td>
            </tr>
            <tr>
                <th>BLOCK:</th>
                <td class="table_data">@if($booking->Block_Name){{ $booking->Block_Name->name }}@endif</td>
            </tr>
            <tr>
                <th>SECTOR NAME:</th>
                <td class="table_data">@if($booking->sector_Name){{ $booking->sector_Name->name }}@endif</td>
            </tr>
            <tr>
                <th>TOTAL PRICE:</th>
                <td class="table_data">RS. {{ number_format($booking->agreed_price,2) }}/-</td>
            </tr>
            <tr>
                <th>DISCOUNT:</th>
                <td class="table_data">
                    @if($booking->dicsount>0)
                        {{ $booking->dicsount }}
                    @else 0
                    @endif
                </td>
            </tr>
            <tr>
                <th>AGREED PRICE:</th>
                <td class="table_data">{{ $booking->agreed_price - $booking->dicsount }}</td>
            </tr>
            <tr>
                <th>CLIENT SIGNATURE:</th>
                <td class="table_data"></td>
            </tr>
            <tr>
                <th>APROVED BY:</th>
                <td class="table_data">
                    @if($booking->ApprovedBY)
                        {{ $booking->ApprovedBY->name }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>AUTHORIZED BY:</th>
                <td class="table_data"></td>
            </tr>
            <tr>
                <th>BOOKED BY:</th>
                <td class="table_data">
                    @if($booking->User_Name)
                        {{ $booking->User_Name->name }}
                    @endif
                </td>
            </tr>
        </table>
        <div style="display: flex;">
            <div style="width: 25%;"></div>
            <div style="width: 25%;"></div>
            <div style="width: 25%;"></div>
            <div style="width: 25%;text-align: end;">
                <button class="btn btn-success" style="margin:10px; " id="buttonPrint1" onClick="test()">Print</button>
            </div>
        </div>

    </div>
</div>
<br>
</body>
</html>
<script src="{{ asset('assets/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    function test()
    {
        $('#buttonPrint1').hide();
        // // $('#buttonPrint').hide();
        // var printContents = document.getElementById("print_summary").innerHTML;
        // var originalContents = document.body.innerHTML;
        // document.body.innerHTML = printContents;
        window.print();
        // document.body.innerHTML = originalContents;
        // window.print();
    }
</script>
