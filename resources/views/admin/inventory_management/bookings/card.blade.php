<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .card-link{
            border: 1px solid #7A58C0;
            color: #7A58C0;
            padding: 10px 25px;
            border-radius: 5px;
            font-weight: 600;
        }
        .card-link:hover{
            color: #7A58C0;
        }
        .purple{
            background-color: #E593FD;
            border-color: #E593FD;
            color: #fff;
        }
        .purple:hover{
            color: #fff;
        }
        .card{
            border-radius: 15px;
            padding: 15px;
            background-color: #212854;
        }
        .card-title, .card-text{
            color: #fff;
        }
        .image-div{
            border: 3px solid #7A58C0;
            padding: 5px;
            margin-left: auto;
            margin-right: auto;
            width: 45%;
        }
    </style>

</head>
<body>
<br><br>
<div class=" ml-auto mr-auto" style="width: 24rem;"> 
<a href="{{ route('create.booking') }}" class="btn btn-success btn-sm">
    <i class="fa fa-arrow-left"></i>
    Back
</a>
</div>
<div class="card ml-auto mr-auto" style="width: 24rem;">
    <div class=" image-div" >
        <img class="card-img-top  card-image" src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{url('/')}}/plot-detail/{{ $booking->id }}">
    </div>
    <div class="card-body text-center">
        <h5 class="card-title">
            @if($booking->Customer_Name)
                {{ $booking->Customer_Name->name }}
            @endif
        </h5>

        {{--          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
        <div class="row card-text" style="line-height: 0.5;">
            <div class="col-md-12 " style="text-align: left;font-family: auto,serif;">
                <table width="100%" style="line-height: initial;">
                    <tr>
                        <th>Project Name:</th>
                        <th>
                            @if($booking->Project_Name)
                                 {{ $booking->Project_Name->name }}
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th>Sector Name:</th>
                        <th>
                            @if($booking->Sector_Name)
                                 {{ $booking->Sector_Name->name }}
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th>Block Name:</th>
                        <th>
                            @if($booking->Block_Name)
                                 {{ $booking->Block_Name->name }}
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th>Plot No.:</th>
                        <th>
                            @if($booking->Plot_Name)
                                 {{ $booking->Plot_Name->name }}
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th>Customer Phone#:</th>
                        <th>
                            @if($booking->Customer_Name)
                                 {{ $booking->Customer_Name->name }}
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th>CNIC:</th>
                        <th>
                            @if($booking->Customer_Name)
                                 {{ $booking->Customer_Name->id_card_no }}
                            @endif
                        </th>
                    </tr>
                </table>
{{--                <p class="card-text " >--}}
{{--                    @if($booking->Project_Name)--}}
{{--                       Project Name: {{ $booking->Project_Name->name }}--}}
{{--                    @endif--}}
{{--                </p>--}}
{{--                <p class="card-text " >--}}
{{--                    @if($booking->Sector_Name)--}}
{{--                       Sector Name: {{ $booking->Sector_Name->name }}--}}
{{--                    @endif--}}
{{--                </p>--}}
{{--                <p  >--}}
{{--                    @if($booking->Block_Name)--}}
{{--                     Block Name: {{ $booking->Block_Name->name }}--}}
{{--                    @endif--}}
{{--                </p>--}}
{{--                <p class="card-text " >--}}
{{--                    @if($booking->Plot_Name)--}}
{{--                        Plot No.: {{ $booking->Plot_Name->name }} ---}}
{{--                        @if($booking->MarlaSize)--}}
{{--                            {{ $booking->MarlaSize->marla }} Marla--}}
{{--                            @endif--}}
{{--                    @endif--}}
{{--                </p>--}}
            </div>
{{--            <div class="col-md-6" style="text-align: left;font-family: auto,serif;">--}}
{{--<p>sdjk</p>--}}
{{--            </div>--}}
        </div>
    </div>
{{--    <div class="card-body text-center">--}}
{{--        <a href="#" class="card-link purple">Card link</a>--}}
{{--        <a href="#" class="card-link">Another link</a>--}}
{{--    </div>--}}
    <div class="card-body">
        <h5 class="card-title">SKILLS</h5>
        <p class="card-text">UI/UX</p>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
