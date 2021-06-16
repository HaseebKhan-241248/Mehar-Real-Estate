<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <meta charset="utf-8">
    <title></title>
    <style media="">

        input{
            border:1px solid transparent;
            border-bottom: 1px solid #000000;
            position: relative;
            top: -9px;
            pointer-events: none;
            margin-top: 4px;
        }

        .sr{
            display:flex;
            justify-content: flex-start;
            
        }
        .header{
            background-color:#b0661b;
            width: 100%;
            border-bottom: 8px solid black;
            border-top: 8px solid black;
        }
        .parent {
            border: 2px solid;
            border-radius: 10px;
        }
        .office {
            border: 2px solid;
            border-radius: 10px;
            text-align: center;

        }
        .office_use{

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
                    <div class="col-md-6 sr" ><label for="" >Unit No:</label> <input type="text"   name="" style="width: 23pc"></div>
                    <div class="col-md-6 sr"> <label for="">Registration No:</label> <input type="text" name="" value="" style="width: 22pc">  </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6 sr"><label for="">Category :</label> <input type="text" name="" style="width: 25pc"></div>
                    <div class="col-md-6 sr"> <label for="">Block :</label> <input type="text" name="" value="" style="width: 26pc">  </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr"><label for="">Area in measurement/Sq.Ft Approx :</label> <input type="text" name="" style="width: 45pc"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr"><label for="">Total Cost Rs :</label> <input type="text" name="" style="width: 55pc"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr"><label for="">Booking Amount Rs :</label> <input type="text" name="" style="width: 52pc"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr"><label for="">Booking Draft/Pay Order No :</label> <input type="text" name="" style="width: 48pc"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr"><label for="">Receipt No :</label> <input type="text" name="" style="width: 56pc"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr"><label for="">Date :</label> <input type="text" name="" style="width: 59pc"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr"><label for="">Booked By :</label> <input type="text" name="" style="width: 56pc"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 sr"><label for="">Name & Signature :</label> <input type="text" name="" style="width: 53pc"></div>
                </div>

            </div>
            <div class="col-md-5 parent" style="margin-top:20px; height: 174px;">
                <label for="">Authorized Signature by Developer</label>
            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-5 parent" style="margin-top:20px ;height: 174px;">
                <label for="">Read Understood & Signed</label>
            </div>

                <div class="col-md-5 mt-4 sr" ><label for="">Date :</label> <input type="text" name="" style="width: 15pc"></div>
                <div class="col-md-2 sr" ><label for=""></label></div>
                <div class="col-md-5 mt-4 sr" style="float:left"> <label for="">Date :</label> <input type="text" name="" value="" style="width: 15pc">  </div>


        </div>
    </div>
</body>
</html>
