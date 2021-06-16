<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <meta charset="utf-8">
    <title></title>
    <style media="">
        label,h2{
            color:#4285F4;
        }
        input{
            border:1px solid transparent;
            border-bottom: 1px solid #4285F4;
            position: relative;
            top: -9px;
            pointer-events: none;
        }

        .sr{
            display:flex;
        }
    </style>
</head>
<body>
<div class="container">
    <div class=" p-5">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4" >
                        <img @if($booking->Project_Name)  src="{{ asset('/images') }}/{{ $booking->Project_Name->logo }}" @endif alt="" width="80%" style="position:relative; top:50%; left:50%; transform:translate(-50%, -50%);">
                    </div>
                    <div class="col-md-8 ">
                        <img  src="{{ asset('assets/img/3.png') }}" alt="" width="100%" height="100%">
                    </div>
                </div><br><br><br>
                <div class="row">
                    <div class="col-md-4 sr">
                        <label for="">Receipt No:</label>
                        <input type="text" name="" value="{{ $receipt->id }}" style="width:14pc;    text-align: center;"  >
                    </div>
                    <div class="col-md-4 sr">
                        <label for="">Date:</label>
                        <input type="text" name="" value="{{ $receipt->day }}" style="width:18pc;    text-align: center;">
                    </div>
                    <div class="col-md-4 sr">
                        <label for="">Booking No:</label>
                        <input type="text" name="" value="{{ $receipt->booking_id }}" style="width:14pc;    text-align: center;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr">
                        <label for="">Received with thanks from Mr./Mrs./Ms.:</label>
                        <input name="" @if($booking->Customer_Name) value="{{ $booking->Customer_Name->name }}" @endif style="width:71%;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr">
                        <label for="">S/o, D/o, W/o:</label>
                        <input type="text" name="" @if($booking->Customer_Name) value="{{ $booking->Customer_Name->father_name }}" @endif style="width:907px;">
                    </div>

                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr">
                        <label for="">A sum of Rupees:</label>

                        <input type="text" name="" value="@php echo NumConvert::word($receipt->amount); @endphp Only" style="width:885px;">
                    </div>

                </div>
                <div class="row mt-4">
                    <div class="col-md-8 sr">
                        <label for="">Through Pay Order/Bank Draft No:</label>
                        <input type="text" name="" value="{{ $receipt->draft_no }}" style="width:418px;">
                    </div>
                    <div class="col-md-4 sr">
                        <label for="">Dated:</label>
                        <input type="text" name="" value="{{ $receipt->dated }}" style="width:267px;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-7 sr">
                        <label for="">Drawn Bank:</label>
                        <input type="text" name="" value="{{ $receipt->drawn_bank }}" style="width:491px;">
                    </div>
                    <div class="col-md-5 sr">
                        <label for="">On Account of:</label>
                        <input type="text" @if($receipt->Account_Name) value="{{ $receipt->Account_Name->account_name }}" @endif style="width:294px;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4 sr">
                        <label for="">Plot No:</label>
                        <input type="text" name="" @if($booking->Plot_Name) value="{{ $booking->Plot_Name->name }}" @endif style="width:259px;">
                    </div>
                    <div class="col-md-4 sr">
                        <label for="">Sector Name:</label>
                        <input type="text" name="" @if($booking->Sector_Name) value="{{ $booking->Sector_Name->name }}"@endif style="width:223px;">
                    </div>
                    <div class="col-md-4 sr">
                        <label for="">Block:</label>
                        <input type="text" name="" @if($booking->Block_Name) value="{{ $booking->Block_Name->name }}" @endif style="width:272px;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr">
                        <label for="">Area in measurement/Sq. Ft. Approx:</label>
                        <input type="text" name="" @if($booking->MarlaSize) value="{{ $booking->MarlaSize->marla }}-Marla" @endif style="width:750px;">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6 ">
                        <label for="" style="font-weight:bold; font-size:2pc;">Rs.</label>
                        <input type="text" name="" value="{{ number_format($receipt->amount) }}">
                    </div>
                    <div class="col-md-6  mt-3">
                        <hr class="" style="background:#4285F4; width: 230px; position: relative;  left: 8pc;" >
                        <label for="" style="text-align:center; position: relative;  left: 18pc;">For:
                            <span style="font-weight:bold;">MAENT</span>
                            <br>(Not valid Without stamp)
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></body>
</html>
