<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .letter {
            /* background-image: url('{{asset("/assets/img/border.png")}}') ;
            background-size: cover ;
            width: 8.3in;
            height: 100%;

            margin-left: auto;
            margin-right: auto; */
            border: 100px solid transparent;
            border-image-slice:216 208 208 216;
            /* border-image-width:20px 20px 20px 20px; */
            border-image-outset:0px 0px 0px 0px;
            border-image-repeat:stretch stretch;
            border-image-source: url('{{url("/")}}/assets/img/border.png');
        }

        .letter-inner {
            margin-left: auto;
            margin-right: auto;
            width: 80%;
            padding-top: 12%;
        }

        .photo-div {
            width: 4cm;
            height: 4.8cm;
            border: 1px solid;
        }

        .inner-txt {
            border-bottom: 1px solid;
            width: 4cm;
            height: 20px;
        }

        .inner-txt p {
            margin: 0px;
            padding-left: 10px;
            font-weight: bolder;
            margin-top: -3px;

        }

        .static-txt {
            font-size: 20px;
        }

        .content-div {
            padding: 12px;
            padding-top: 30px;
        }

        .red-div {
            /* background-color: #E82012; */
            width: 100%;
            border-radius: 10px;
            margin-left: auto;
            margin-right: auto;
        }

        .alltoment {
            color: white;
            width: fit-content;
            background-color: red;
            padding: 8px 35px;
            border-radius: 14px;
            margin-left: auto;
            margin-right: auto;
            font-size: 34px;
            font-family: times;
            /* padding-top: 15px; */
            font-weight: 800;
            margin: 10px auto;

        }

        .reciept-div {
            padding-top: 0px;
        }

        .main-content {
            padding: 0px 12px;
            font-size: 18px;
            font-style: italic;
            font-weight: 600;
        }

        .main-inner-txt {
            width: 85%;
            border-bottom: 1px solid;
            height: 20px;

        }
        .main-inner-txt p {
            font-weight: bolder;
            margin-top: -3px;

        }

        .main-content-heading {
            font-size: 20px;
            /* text-decoration: underline #E82012; */
            font-style: italic;
            font-weight: 600;
            padding-left: 12px;
            background-color: red;
            padding: 8px 35px;
            border-radius: 14px;
            color:white;
        }

    </style>

</head>

<body>
    <div></div>
    <div class="letter">
        <div class="container-fluid">
            <div class="letter-inner ">

                <div class="row image-div">
                    <div class="col-md-8">
                        <img class="ml-auto" src="" alt="">
                    </div>
                    <div class="col-md-4">
                        <div class="photo-div ml-auto">
                            <img width="100%"  src="@if($booking->Project_Name) {{ $booking->Project_Name->logo }} @endif " alt="">
                        </div>
                    </div>
                </div>
                <br>
                <div class="red-div row">
                    <h4 class="alltoment">Provisional Allotment Letter</h4>
                </div>
                <br><br>
                <div class="row content-div">
                    <div class="col-md-6">
                        <div class="top-text row">
                            <div class="static-txt">
                                <p>Booking No.</p>
                            </div>
                            <div class="inner-txt">
                                <p>{{$booking->id }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="top-text row">
                            <div class="ml-auto static-txt">
                                <p class="">Dated:</p>
                            </div>
                            <div class="inner-txt">
                                <p>{{ \Carbon\Carbon::parse($booking->day1)->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row content-div reciept-div">
                    <div class="col-md-6">
                        <div class="top-text row">
                            <div class="static-txt">
                                <p>Reciept No.</p>
                            </div>
                            <div class="inner-txt">
                                <p>

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="top-text row">
                            <div class="ml-auto static-txt">
                                <p class="">Booking Date:</p>
                            </div>
                            <div class="inner-txt">
                                <p>
                                    {{ \Carbon\Carbon::parse($booking->day)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="main-content">
                        <p class="">Name:</p>
                    </div>
                    <div class="main-inner-txt">
                        <p>
                            @if($booking->Customer_Name)
                            {{ $booking->Customer_Name->name }}
                            @endif
                        </p>
                    </div>
                </div>
                <br>
                <div class="row pt-2">
                    <div class="main-content">
                        <p class="">S/o, D/o, W/o:</p>
                    </div>
                    <div class="main-inner-txt" style="width: 76%;">
                        <p>
                            @if($booking->Customer_Name)
                            {{ $booking->Customer_Name->father_name }}
                            @endif
                        </p>
                    </div>
                </div>
                <br>
                <div class="row pt-2">
                    <div class="main-content">
                        <p class="">Address:</p>
                    </div>
                    <div class="main-inner-txt" style="width: 82%;">
                        <p>
                            @if($booking->Customer_Name)
                            {{ $booking->Customer_Name->address }}
                            @endif
                        </p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row pt-2">
                            <div class="main-content">
                                <p class="">C.N.I.C:</p>
                            </div>
                            <div class="main-inner-txt" style="width: 70%;">
                                <p>
                                    @if($booking->Customer_Name)
                                    {{ $booking->Customer_Name->id_card_no }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row pt-2">
                            <div class="main-content">
                                <p class="">Sector:</p>
                            </div>
                            <div class="main-inner-txt" style="width: 69%;">
                                <p>
                                    @if($booking->Sector_Name)
                                     {{ $booking->Sector_Name->name}}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="row pt-2">
                            <div class="main-content">
                                <p class="">Block:</p>
                            </div>
                            <div class="main-inner-txt" style="width: 60%;">
                                <p>
                                    @if($booking->Block_Name)
                                     {{ $booking->Block_Name->name}}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row pt-2">
                            <div class="main-content">
                                <p class="">PLot #</p>
                            </div>
                            <div class="main-inner-txt" style="width: 60%;">
                                <p>
                                    @if($booking->Plot_Name)
                                    {{ $booking->Plot_Name->name }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row pt-2">
                            <div class="main-content">
                                <p class="">Size</p>
                            </div>
                            <div class="main-inner-txt" style="width: 66%;">
                                <p>
                                    @if($booking->MarlaSize)
                                        {{ $booking->MarlaSize->marla }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row pt-2">
                            <div class="main-content">
                                <p class="">Agreed Price</p>
                            </div>
                            <div class="main-inner-txt" style="width: 55%;">
                                <p>
                                    {{ number_format(($booking->agreed_price - $booking->discount),2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row pt-2">
                            <div class="main-content">
                                <p class="">Token Recieved</p>
                            </div>
                            <div class="main-inner-txt" style="width: 46%;">
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <h3 class="main-content-heading" style="">In Model Town Housing Scheme</h3>
                    <ol>
                        <li>Registration number should Invariably be quoted for all future correspondence.</li>
                        <li>The allottee shall abide by the Terms & Conditions (by-laws) of <b>Model Town</b><br>Choti
                            Zarin Tehsil Kot Chutta Dist. DG Khan.</li>
                        <li>This is provissionally allotment letter subject to final approval from concerned department.
                        </li>
                    </ol>
                </div>
                <br>
                <div class="row pt-1 content-div reciept-div">
                    <div class="col-md-6">
                        <div class="top-text row">
                            <div class="static-txt">
                                <p>Authority Signature</p>
                            </div>
                            <div class="inner-txt">
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="top-text row">
                            <div class="ml-auto static-txt">
                                <p class="">Client Signature</p>
                            </div>
                            <div class="inner-txt">
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
