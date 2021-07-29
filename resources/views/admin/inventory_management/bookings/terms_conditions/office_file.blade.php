<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Application Form</title>
    <style media="">
        @page { size: auto;  margin: 0mm; }
        @media print {
            .sr {
                display: flex !important;
                justify-content: flex-start !important;
            }
            .plotinput
            {
                width: 23pc !important;
            }
        }

        input{
            border:1px solid transparent;
            border-bottom: 1px solid #000000;
            position: relative;
            top: -9px;
            pointer-events: none;
            margin-top: 4px;
            padding-left: 20px;
            border: none;
            outline: none;
            border-bottom: 1px solid;
            font-weight: bold;
        }

        .sr{
            display:flex;
            justify-content: flex-start;

        }

        .parent {
            border: 2px solid;
            border-radius: 10px;
        }

        .col-md-6{
            width: 50%;
        }
        .col-md-4{
            width: 33%;
        }

    </style>
</head>
<body>
@php
    $str = $booking->Project_Name->name;

     $ret = "";
     foreach(explode(' ', $str) as $word)
     {
         $ret .= strtoupper($word[0]);
     }

@endphp
<div class="container">
    <div class="p-5">
        <div class="row text-center" >
            <div class="col-md-4"></div>
            <div class="col-md-4 parent" style="background-color:#b0661b;">
                <h4 class="office_use"> FOR OFFICE USE ONLY </h4>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-12 parent">
                <div class="row mt-4">
                    <div class="col-md-6 sr" >
                        <label for="" >Plot  No:</label>
                        <input type="text" class="plotinput"  @if($booking->Plot_Name) value="{{ $booking->Plot_Name->name }}" @endif  name="" style="width: 23pc;">
                    </div>
                    <div class="col-md-6 sr">
                        <label for="">Booking No:</label>
                        <input type="text" name="" value="{{ $ret }} {{ $booking->id }} " style="width: 22pc;padding-left: 20px;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6 sr">
                        <label for="">Sector :</label>
                        <input type="text" name="" @if($booking->Sector_Name) value="{{ $booking->Sector_Name->name }}" @endif style="width: 25pc;padding-left: 20px;">
                    </div>
                    <div class="col-md-6 sr">
                        <label for="">Block :</label>
                        <input type="text" name="" @if($booking->Block_Name) value="{{ $booking->Block_Name->name }}" @endif style="width: 26pc;padding-left: 20px;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr">
                        <label for="">Area in measurement/Sq.Ft Approx :</label>
                        <input type="text" name="" @if($booking->MarlaSize) value="{{ $booking->MarlaSize->marla }} (Marla)" @endif style="width: 45pc;padding-left: 20px;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr">
                        <label for="">Total Cost Rs :</label>
                        <input type="text" name=""  style="width: 55pc;padding-left: 20px;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr">
                        <label for="">Booking Amount Rs :</label>
                        <input type="text" name="" value="{{ number_format($booking->agreed_price - $booking->discount,2) }}" style="width: 52pc;padding-left: 20px;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr">
                        <label for="">Booking Draft/Pay Order No :</label>
                        <input type="text" name="" style="width: 48pc;padding-left: 20px;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr">
                        <label for="">Receipt No :</label>
                        <input type="text" name="" style="width: 56pc;padding-left: 20px;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr">
                        <label for="">Date :</label>
                        <input type="text"  value="{{ \Carbon\Carbon::parse($booking->day)->format('d M Y') }}" name="" style="width: 59pc;padding-left: 20px;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr">
                        <label for="">Booked By :</label>
                        <input type="text" @if($booking->User_Name) value="{{ $booking->User_Name->name }}" @endif name="" style="width: 56pc;padding-left: 20px;">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr">
                        <label for="">Name & Signature :</label>
                        <input type="text" name="" style="width: 53pc;padding-left: 20px;">
                    </div>
                </div>
            </div>

            <div class=" parent" style="margin-top:20px; height: 174px;width: 45%;">
                <label for="">Authorized Signature by Developer</label>
            </div>
            <div class="" style="width: 10%;">
            </div>
            <div class=" parent" style="margin-top:20px ;height: 174px;width: 45%">
                <label for="">Read Understood & Signed</label>
            </div>

            <div class=" mt-4 sr" style="width: 45%;"><label for="">Date :</label>
                <input type="text" name="" style="width: 15pc;padding-left: 20px;">
            </div>
            <div class=" sr" style="width: 10%;">
                <label for=""></label>
            </div>
            <div class=" mt-4 sr" style="float:left;width: 45%;">
                <label for="">Date :</label>
                <input type="text" name="" value="" style="width: 15pc;padding-left: 20px;">
            </div>
        </div>
    </div>
</div>
</body>
</html>
