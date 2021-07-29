<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
      <title>Customer Card</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>

        .card-bg{
            background-image: url({{ asset('') }}/cardbanner.png);
            padding: 20px;
            margin: auto;
            background-position: top;
            background-size: 100% 58%;
            background-repeat: no-repeat;
            background-color: #f7f7f7;
            border-radius: 10px;
            overflow: hidden;

        }
        .card-bg,.card-body{
            padding-bottom: 0px;
        }
        .card-title{
            color: #4CBDEC;
            text-align: center;
            font-weight: 700;
            margin: 10px 0px 35px 0px;
            font-size: 30px;
        }
        .card-img-top{
            border-radius: 50%;
            margin: auto;
            width: 190px;
            height: 190px;
            margin-top: 45px;
            object-fit: cover;
        }
        .card-text-name{
            font-size: 25px;
            color: #4A4B4D;
            text-transform: capitalize;
            margin: 0px;
            font-weight: 700;
            text-align: center;
        }
        .card-text-plot-details span{
            font-weight: 700;
        }
        .devider{
            background-color: #4A4B4D;
            width: 1px;
            height: 100px;
        }
    </style>
  </head>
  <body>
  <br>
    <div class="card card-bg" style="width: 35%;">
        <h5 class="card-title">
            @if($booking->Project_Name)
                {{ $booking->Project_Name->name }}
            @endif
        </h5>
        @if($booking->Customer_Name->image)
        <img class="card-img-top"  src="{{ asset('') }}images/{{ $booking->Customer_Name->image }}"  alt="Card image cap">
        @else
            <img class="card-img-top"  src="{{ asset('') }}images.jpeg"  alt="Card image cap">
        @endif
        <div class="card-body">
          <p class="card-text-name">
              @if($booking->Customer_Name)
                  {{ $booking->Customer_Name->name }}
              @endif
          </p>
          <table class="table mt-4 text-center">
            <tbody>
              <tr>
                <th scope="row">Phone#</th>
                <td>{{ $booking->customer_contact }}</td>
              </tr>
              <tr>
                <th scope="row">CNIC</th>
                <td>
                    @if($booking->Customer_Name)
                        {{ $booking->Customer_Name->id_card_no }}
                    @endif
                </td>
              </tr>
            </tbody>
          </table>
          <div class="row">
              <div class="col-md-7">
                <p class="card-text-plot-details">
                    <span>Sector Name:</span>
                    @if($booking->Sector_Name)
                        {{ $booking->Sector_Name->name }}
                    @endif
                </p>
                <p class="card-text-plot-details">
                    <span>Block Name:</span>
                    @if($booking->Block_Name)
                        {{ $booking->Block_Name->name }}
                    @endif
                </p>
                <p class="card-text-plot-details">
                    <span>Plot Number:</span>
                    @if($booking->Plot_Name)
                        {{ $booking->Plot_Name->name }}
                        ({{ $booking->MarlaSize->marla }} Marla)
                    @endif
                </p>
              </div>
              <div class=" devider"></div>
              <div class="col-md-4">
                  <img width="100%"   src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{url('/')}}/pay-installment/{{ $booking->id }}">
{{--                  <img src="{{ asset('') }}/qr.png"  alt="">--}}
              </div>
          </div>
        </div>
      </div>
    <br>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
