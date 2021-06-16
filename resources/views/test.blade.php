@extends('layouts.app')
<style>
    .deliveryserviceimage img {
        height:150px;
    }
    .banner-text {
        /*background-image: url(../images/book-bg-png.png);*/
        background-color:#8be1efd6;
        background-repeat: no-repeat;
        background-position: left center;
        background-size: cover;
        float: left;

    }
    /*.banner-text h1 {*/
    /*    float: left;*/
    /*    height: auto;*/
    /*    width: 100%;*/
    /*    color: #FFF;*/
    /*    margin: 0px;*/
    /*    text-transform: uppercase;*/
    /*    font-family: 'Raleway', sans-serif;*/
    /*}*/

    .banner-text h2 {
        float: left;
        height: auto;
        width: 100%;

        color: #000;
        margin: 0px;
        font-family: 'Raleway', sans-serif;
        font-weight: 500;
        padding:15px;
    }

    input[type=submit] {
        -webkit-appearance: button;
        cursor: pointer;
    }
    .ride-now-button:hover {
        color: #FFF;
        text-decoration: none;
        background-color: #333;
    }
    /*.book-tour-white-errand{*/
    /*    float: left;*/
    /*height: auto;*/
    /*    width: 100%;*/
    /*    background-color: #FFF;*/
    /*    padding-top: 50px;*/
    /*    padding-bottom: 50px;*/
    /*}*/
    .ride-now-btn {
        float: left;
        height: auto;
        width: 100%;
        text-align: left;
        margin-top: 25px;
        margin-bottom: 25px;
    }
    .ride-now-button {
        font-weight: 600;
        color: #FFF;
        background-color: #c63939;
        font-size: 14px;
        min-width: 170px;
        padding-top: 15px;
        padding-right: 20px;
        padding-bottom: 15px;
        padding-left: 20px;
        font-family: 'Raleway', sans-serif;
        display: inline-block;
        text-align: center;
        border-top-style: none;
        border-right-style: none;
        border-bottom-style: none;
        border-left-style: none;
        text-transform: uppercase;
        margin-right: 15px;
    }
    .icon-cal {
        /*background-image: url(../images/cal.png);*/
        background-repeat: no-repeat;
        background-position: 95% center;
    }
    .hire-form-input input {
        width: 100%;
        float: left;
        margin-bottom: 0px;
        border: 2px solid #dddddd;
        font-size: 14px;
        color: #333;
        font-family: 'Raleway', sans-serif;
        font-weight: 600;
        padding-top: 12px;
        padding-right: 12px;
        padding-bottom: 12px;
        padding-left: 12px;
        text-transform: uppercase;
    }
    .other-details-form {
        width: 100%;
        float: left;
        margin-bottom: 16px;
    }

    .hire-form-input {
        width: 100%;
        float: left;
        margin-bottom: 16px;
    }

    .other-details-form textarea {
        width: 100%;
        float: left;
        margin-bottom: 0px;
        border: 2px solid #dddddd;
        font-size: 14px;
        color: #333;
        font-family: 'Raleway', sans-serif;
        font-weight: 600;
        padding: 12px;
        height: 150px;
        text-transform: uppercase;
    }




    .runner-input label {

        float: left;
        margin-bottom: 0px;
        font-size: 14px;
        color: #acacac;
        font-weight: 600;
        padding-top: 12px;
        padding-right: 12px;
        padding-bottom: 12px;
        padding-left: 12px;
        border-top-width: 2px;
        border-right-width: 2px;
        border-bottom-width: 2px;
        border-left-width: 2px;
        border-top-style: solid;
        border-right-style: none;
        border-bottom-style: solid;
        border-left-style: solid;
        border-top-color: #dddddd;
        border-right-color: #dddddd;
        border-bottom-color: #dddddd;
        border-left-color: #dddddd;
        text-transform: uppercase;
    }

    .icon-time {
        /*background-image: url(../images/time.png);*/
        background-repeat: no-repeat;
        background-position: 95% center;
    }
    .margin-boott20 {
        margin-bottom: 60px;
    }

    .webSubmitBtn{
        display:block !important;
    }
    .mobileSubmitBtn{
        display:none !important;
    }

    * {box-sizing: border-box;}
    .inputContainer {
        position: relative;
        /*width: 300px;*/
    }
    .AddressBarInput {
        padding: 9px 10px 8px 10px;
        background: #fff;
        display: block;
        color: #777;
        padding-top: 10px;
        width: 90%;
    }
    .inputContainer i {
        position: absolute;
        right: 59px;
        top: 7px;
        color:#ff6d55;
        font-size:30px;
    }

    header{
        margin-bottom: 65px;
    }

    .fourthStripP{
        padding-left: 118px;
        padding-right: 135px;
    }

    #delivered_happiness h1, #delivered_happiness h5,#delivered_happiness p {

        color:black;
    }
    #delivered_happiness h5{
        font-size: 14px;
    }
    #delivered_happiness i.fa {
        display: inline-block;
        border-radius: 60px;
        box-shadow: 0px 0px 2px #ff6d55;
        padding: 0.5em 0.6em;
        font-size: xx-large;
        color:#ff6d55;

    }
    #cta_button_section strong {

        color:black;
        font-weight: 900;
        font-size:larger;
        vertical-align:middle;
    }
    #cta_button_section img {
        vertical-align:middle;
    }
    #cta_button_section i{
        color:#ff6d55;
        font-size: x-large;
    }
    #cta_button_section .p-4{
        border-radius: 8px;
        border:3px solid #ff6d55;
        cursor:pointer;
    }
    #delivered_happiness{
        padding-bottom:10px!important;
        padding:50px;
    }
    .borderRightONweb{
        border-right:2px dotted #ff6d55;
    }
    .ml4 {
        position: relative;
        font-weight: 900;
        color:black;
    }
    .ml5 {
        position: relative;
        font-weight: 900;
        color:white;
    }
    .ml5 .letters {
        position: absolute;
        left: -32px;
        top: -2.1em;
        right: 0;
        opacity: 0;
        font-size:24px!important
    }
    .ml4 .lettersHead {
        position: absolute;
        left: 165px;
        top: -2.1em;
        right: 0;
        opacity: 0;
        font-size:24px!important
    }

    .ml4 .text-wrapper {
        position: relative;

    }
    .ml5 .text-wrapper {
        position: relative;

    }

    h1{
        font-size:36px !important;
    }

    .delivery_service_trusted{
        flex: 0 0 20%;
        max-width: 20%;

    }
    #banner_web_image{
        display:block;
    }
    .textOverlapWithImage {
        position: relative;
        text-align: center;
        color: white;
    }
    .centered {
        position: absolute;
        top: 15%;
        left: 50%;
        font-size: 27px;
        color: black;
        transform: translate(-50%, -50%);
    }
    .textSecond {
        position: absolute;
        top: 24%;
        left: 41%;
        font-size: 40px;
        font-weight: 900;
        transform: translate(-50%, -50%);
    }
    .textThird {
        position: absolute;
        top: 33%;
        left: 50%;
        font-size: 30px;
        font-weight: 900;
        transform: translate(-50%, -50%);
    }
    .textForth {
        position: absolute;
        top: 45%;
        left: 68%;
        font-size: 26px;
        font-weight: bold;
        transform: translate(-50%, -50%);
    }

    .textFifth {
        position: absolute;
        top: 53%;
        left: 77%;
        font-size: 26px;
        font-weight: bold;
        transform: translate(-50%, -50%);
    }
    .webView{
        display:inline-block;
    }

    #delivered_happiness img.fa {
        display: inline-block;
        border-radius: 60px;
        box-shadow: 0px 0px 2px #ff6d55;
        padding: 15px;
        font-size: larger;
        color: #ff6d55;
        background: white;
        width: 65px;
        height: 65px;

    }

    .testimonial{
        padding: 0 15px;
        text-align: center;
    }
    .testimonial .description p{
        padding: 0 15px;
        font-size: 16px;
        color: #0041C2;
        line-height: 26px;
    }
    .testimonial .testimonial-title{
        font-size: 14px;
        letter-spacing: 3px;
        color: #000000;
        text-transform: uppercase;
    }


    @media screen and (max-width: 768px) {

        /*#banner_web_image{*/
        /*    display:none;*/
        /*}*/
        .delivery_service_trusted{
            flex: unset;
            max-width: unset;
        }
        #section-1{
            /*margin-top:-90px;*/
            padding-bottom:0px!important;
        }
        #contact-us-text{
            font-size:20px !important;
        }
        h1{
            font-size:25px !important;
        }
        .banner-text h2 {
            float: left;
            height: auto;
            width: 100%;

            color: #000;
            margin: 0px;
            font-family: 'Raleway', sans-serif;
            font-weight: 500;

        }
        .banner-text {
            padding:0 !important;

        }
        .webSubmitBtn{
            display:none !important;
        }
        .mobileSubmitBtn{
            display:block !important;;
        }


        .fourthStripP{
            padding-left: 2px;
            padding-right: 2px;
        }
        .backgroundImageAddress{
            background-image:none !important;
            background:#492c79;
        }
        .sprayImage{
            display:none;
        }
        .mobileView{
            display:block !important;
        }

        .webView{
            display:none;
        }

        .borderRightONweb{
            border-right:0px dotted #ff6d55;
        }

        .wantToHaveOrder{

            text-align:left;
            font-size:32px;
        }
        .ml4 {
            position: relative;
            font-weight: 900;
            color:black;

        }
        .ml5 {
            position: relative;
            font-weight: 900;
            color:black;

        }
        .ml4 .lettersHead {
            position: absolute;
            left: 205px;
            top: -1.78em;
            right: 0;
            opacity: 0;

            font-size:32px;
        }
        .ml4 .letters {
            position: absolute;
            left: 169px;
            top: -1.78em;
            right: 0;
            opacity: 0;

            font-size:32px;
        }
        .ml5 .letters {
            position: absolute;
            left: 169px;
            top: -1.78em;
            right: 0;
            opacity: 0;

            font-size:32px;
        }
        .alcho{
            margin-left:2.2rem! important;
        }
        #cta_button_section .p-4{
            border-radius: 8px;
            border:3px solid #ff6d55;
            cursor:pointer;
            margin-top:12px;
        }

        .AddressBarInput {
            padding: 9px 10px 8px 10px;
            background: #fff;
            display: block;
            color: #777;
            width: 100%;

        }

        .inputContainer i {
            position: absolute;
            right: 14px;
            top: 7px;
            color:#ff6d55;
            font-size:30px;
        }
    }
</style>
@section('css')





    <link href="{{ url('build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
    <link href="{{ url('build/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    <link href="{{ url('build/css/bootstrap-datetimepicker-standalone.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5JJJBGW');</script>
@endsection
@php
    session()->forget('cityName');
    session()->forget('countryName');
         $title = 'StayRunners - On-Demand Delivery Service';
         $description = 'StayRunners offers Late Night Liquor and Food Delivery Service. Get Alcohol, Wine, Beer, Food, Vapes, E-cigs, Grocery & convenience store items delivered now!';

@endphp
@section('title',$title)
@section('description',$description)
@section('content')
    <?php
    $sales_line_text = 'StayRunners is your 24/7 On-Demand Delivery Service';

    $is_day = 'front/assets/images/new_img/homepage/night.png';

    $content = \App\HomepageDynamicContent::first();
    $setContent = $content->night_content;

    ?>


    <section style="text-align:center; margin-top: -75px;">
        <div class="webView">
            <div style="font-family:'Arial', serif;">
                <p style="text-align:center; font-size:100px;"> <span style="color:#FF0000; font-weight: bold;">Stay</span><span style="color:#0041C2; font-weight: bold;">Runners</span></p>
                <p style="text-align:center; font-weight: bold; color:black; font-size: 35px;  ">AFTER HOURS LIQUOR STORE DELIVERY
                </p>

            </div>
            </p>
            <p style="text-align:center; font-weight: bold; color:black; font-size: 20px;">ON DEMAND DELIVERY OF LIQUOR FOOD GROCERIES AND ANYTHING YOU NEED 24/7 </p>

            <p style="text-align:center; font-weight: bold; color:black; font-size: 20px;">Cash on delivery- E-transfer- Paypal</p>
        </div>

        <div class="mobileView" style="display:none;">
            <div style="font-family:'Arial', serif;">

                <p style="text-align:center; font-size:55px; margin-bottom:-10px;"> <span style="color:#FF0000; font-weight: bold;">Stay</span><span style="color:#0041C2; font-weight: bold;">Runners</span></p>
                </p>
                <p style="text-align:center; font-weight: bold; color:black; font-size: 30px; ">AFTER HOURS LIQUOR STORE DELIVERY</p>
            </div>
            <p style="text-align:center; font-weight: bold; color:black; font-size: 15px;">ON DEMAND DELIVERY OF LIQUOR FOOD GROCERIES AND ANYTHING YOU NEED 24/7</p>
            <!-- <p>-->
            <!--    <span style="color:#FF0000; font-weight: bold;    font-size: xx-large;">OR</span>-->
            <!--</p>-->
            <p style="text-align:center; font-weight: bold; color:black; font-size: 20px;">Cash on delivery- E-transfer- Paypal</p>
        </div>
    </section>
    <form method="POST" action="{{route('testing')}}">
        <section id="section-1" style="padding-bottom:15px;">
            <input type="hidden" id="night_time" value="
                        <?php echo isset($night_time->night_sales_line_text) ? $night_time->night_sales_line_text : ''; ?>"/>
            @php session()->forget('latLng');  @endphp



            <div class="container">

                <!--<div class="owl-carousel owl-theme">-->

                <div class="row text-center">



                    <div class="col-lg-12 col-xs-12">
                        <div class="align-items-center content pl-lg-5 pr-lg-3 pt-3">



                            <div class="webView">

                                <div class="input-group">
                                    <div class="input-group-prepend" >
                <span class="input-group-text text-uppercase bg-white p-2" id="basic-addon1" style="width: 250px;">
                  <select class="form-control js-example-basic-single" name="city">
                    <option value="">Select City</option>
                    @foreach($cities as $city)
                          <option value="{{ $city->id }}">{{ $city->city }}</option>
                      @endforeach
                  </select>
                    <!-- <input  class="form-control " name="city_input" id="webCity" type="text" placeholder="Enter City"/> -->

                </span>
                                        <!--<div class="address_div" style="display: none"></div>-->
                                    </div>
                                    <input type="text" required type="text" name="product_details"  class="form-control " id="webProductDetails" placeholder="Write what you Need here for cost and time for delivery then press GO" aria-label="Username" aria-describedby="basic-addon1" style="float: left;
                margin-bottom: 0px;
                border: 2px solid #dddddd;
                font-size: 14px;
                color: #333;
                font-family: 'Raleway', sans-serif;
                font-weight: 600;
                padding-top: 12px;
                padding-right: 12px;
                padding-bottom: 12px;
                padding-left: 12px;
                text-transform: uppercase;
                width: 650px;"/>

                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary " type="button" >GO</button>
                                    </div>

                                </div>
                            </div>

                            <div class="mobileView" style="display:none;">
                                <input class="form-control mb-3 " name="city_input" type="text" id="mobileCity" placeholder="In What City You Want Your Delivery?" />
                                <textarea  required  name="product_details"  class="form-control mb-3 " placeholder="Write What You Need Here for Cost and Time for Delivery then Press GO" aria-label="Username" id="mobileProductDetails" style="float: left;
             margin-bottom: 0px;
             border: 2px solid #dddddd;
              font-size: 14px;
             color: #333;
             font-family: 'Raleway', sans-serif;
           font-weight: 600;
              padding-top: 12px;
            padding-right: 12px;
            padding-bottom: 12px;
             padding-left: 12px;
             text-transform: uppercase;" rows="2"></textarea>
                                <button class="btn btn-outline-secondary go_button" type="button">GO</button>
                            </div>
                            <p style="margin-top: 10px;
    color: black;font-size: larger;
    font-weight: bold;">{{$sales_line_text}}
                            </p>

                        </div>
                    </div>
                </div>
                <!--</div>-->
                <!--</div>-->
            </div>

        </section>
    </form>


    <section>

        <div class="">

            <div class="container">


                <div class="col-sm-12 wow fadeInUp text-center">
                    <h1 class="text-center" style="padding-top:0px;padding-bottom:0px;color:#ff6d55">TRUSTED DELIVERY SERVICE
                    </h1>
                    <h4 class="text-center" style="color:black">Get what you need Delivered Fast! 24/7
                    </h4>
                    <h4 class="text-center" style="color:black;font-size: 24px;">ENTER ABOVE THE CITY AND WHAT YOU NEED DELIVERED AND PRESS GO, ITS THAT EASY!!

                    </h4>
                    <p>
                        <span style="color:#FF0000; font-weight: bold;    font-size: xx-large;">OR</span>
                    </p>
                    <h6 class="text-center"style="color:black; padding-bottom:10px">Click on any Delivery Idea Below to get a Great Delivery From a Runner in your Area:

                    </h6>
                    <div class="row" style="justify-content: center;">

                        <div class="col-lg-3 deliveryserviceimage">
                            <a class="p-2" href="/deliveryservice/liquor-delivery" >
                                <div style="height: 140px;">
                                    <img src="{{ url('front/assets/images/new_img/homepage/hm_day_01.jpg') }}" >
                                </div>
                                <h5 style="color:black; margin-bottom: -10px;">LIQUOR DELIVERY</h5>
                            </a>
                            <p style="color:black;"><strong>24/7 From Friends With Fridges To your Doorstep</strong>
                            </p>
                        </div>
                        <div class="col-lg-3 deliveryserviceimage">
                            <a class="p-2" href="/deliveryservice/grocery-delivery">
                                <div style="height: 140px;">
                                    <img src="{{ url('front/assets/images/new_img/homepage/hm_day_02.png') }}" >
                                </div>
                                <h5 style="color:black; margin-bottom: -10px;">GROCERY DELIVERY
                                </h5>
                            </a>
                            <p style="color:black;"><strong>Enter your city and your grocery list above then press Go</strong>
                            </p>
                        </div>
                        <div class="col-lg-3 deliveryserviceimage">
                            <a class="p-2" href="/deliveryservice/food-delivery">
                                <div style="height: 140px;">
                                    <img src="{{ url('front/assets/images/new_img/homepage/hm_day_03.png') }}" >
                                </div>
                                <h5 style="color:black; margin-bottom: -10px;">FOOD DELIVERY</h5>
                            </a>
                            <p style="color:black;"><strong>Pick any Restaurant Tell us what you Want then press go</strong>
                            </p>
                        </div>
                        <div class="col-lg-3 deliveryserviceimage">
                            <a class="p-2" href="/deliveryservice/special-delivery">
                                <div style="height: 140px;">
                                    <img src="{{ url('front/assets/images/new_img/homepage/hm_day_04.png') }}" >
                                </div>
                                <h5 style="color:black; margin-bottom: -10px;">SPECIAL DELIVERY</h5>
                            </a>
                            <p style="color:black;"><strong>Deliver from anyone in the world to anywhere In the world</strong>
                            </p>
                        </div>
                        <div class="col-lg-3 deliveryserviceimage">
                            <a class="p-2" href="/deliveryservice/sexy-delivery">
                                <div style="height: 140px;">
                                    <img src="{{ url('front/assets/images/new_img/homepage/debacherydelivery.jpeg') }}" >
                                </div>

                                <h5 style="color:black; margin-bottom: -10px;">DEBACHERY DELIVERY</h5>
                            </a>
                            <p style="color:black;"><strong>Friends with a Heart to keep you company and add some spice to your life</strong>
                            </p>
                        </div>
                        <div class="col-lg-3 deliveryserviceimage">
                            <a class="p-2" href="/deliveryservice/shopping-delivery">
                                <div style="height: 140px;">
                                    <img src="{{ url('front/assets/images/new_img/homepage/hm_day_06.png') }}" >
                                </div>
                                <h5 style="color:black; margin-bottom: -10px;">SHOPPING DELIVERY
                                </h5>
                            </a>
                            <p style="color:black;"><strong>Any Store we line up for you and saving you your Valuable time and get What you want.</strong>
                            </p>
                        </div>

                        <div class="col-lg-3 deliveryserviceimage">
                            <a class="p-2" href="/deliveryservice/business-package-delivery">
                                <div style="height: 140px;">
                                    <img src="{{ url('front/assets/images/new_img/homepage/business_package_delivery.jpg') }}" >
                                </div>
                                <h5 style="color:black; margin-bottom: -10px;">PACKAGE PICKUP OR DELIVERY</h5>
                            </a>
                            <p style="color:black;"><strong>We can store or pickup your Packages and available to you for delivery or pickup</strong>
                            </p>
                        </div>
                        <div class="col-lg-3 deliveryserviceimage">
                            <a class="p-2" href="/deliveryservice/book-ride-delivery">
                                <div style="height: 140px;">
                                    <img src="{{ url('front/assets/images/new_img/homepage/hm_day_08.png') }}" >
                                </div>
                                <h5 style="color:black; margin-bottom: -10px;">SAFE RIDE HOME</h5>
                            </a>
                            <p style="color:black;"><strong>A Friend can Come pick you up So no need to Drink and Drive Late Night Saving lives</strong>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div style="color:black;">
            <h5 style="text-align:center; color:black; padding-bottom:20px; ">Look at what some of <span style="color:#FF0000;">Stay</span><span style="color:#0041C2;">Runners</span> customers are saying now:</h5>
        </div>
        <div class="testimonial" style="padding-bottom:20px; text-align:center; color:black;">
            <div class="row" style="justify-content: center;">
                <div class="description" style="padding-left: 45px;">
                    <p style="width:300px;">
                        “The Liquor store was closed And i called StayRunners and they had a friend with a fridge Who came by and dropped off exactly what I needed Late Night After Hours thanks StayRunners”
                    </p>
                    <h6 class="testimonial-title">- Mikyun Patel</h6>
                </div>
                <div class="description" style="padding-left: 45px;">
                    <p style="width:300px;">
                        “I was on the other side of the World and wanted to send a birthday gift to my friend and StayRunners gathered the bottle, the flowers, and the decorations and made it happen for her and me a customized delivery ie. Clear Communcation”
                    </p>
                    <h6 class="testimonial-title">- Sandy Grove</h6>
                </div>
                <div class="description" style="padding-left: 45px";>
                    <p style="width:300px;">
                        “These guys are very good At afterhours. They sent A beautiful sexy delivery girl And now one of my best friend from the other side of the world. Awesome StayRunners”
                    </p>
                    <h6 class="testimonial-title">- Kyle Alexander</h6>
                </div>
            </div>
        </div>
    </section>

    <section style="padding-top:15px;">
        <div style="color:black;">
            <p style="text-align:center; color:black; font-size:24px">IF YOUR <strong>TIME</strong> IS WORTH MORE THAN YOUR <strong>MONEY</strong>, LOOK TO <span style="color:#FF0000"><strong>STAY</strong></span><span style="color:#0041C2"><strong>RUNNERS</strong></span> TO GET YOU WHAT YOU WANT WHEN YOU WANT IT FAST. OUR RUNNERS ARE TRUSTWORTY AND USE CLEAR COMMUNICATIONS, SEND YOU PICTURES AND RECEIPTS SO YOU KNOW EXACTLY WHAT YOU ARE GETTING BEFORE WE BUY IT FOR YOU. YOU PAY ON DELIVERY AND WITH MANY OPTIONS TO CHOOSE FROM. <u>JUST FILL IN THE GET BAR ABOVE WITH WHAT YOU WANT, ENTER YOUR CITY AND PRESS GO!</u> ITS THAT SIMPLE!
            </p>
        </div>
    </section>


    <div class="clearfix"></div>
    </div>
    </div>
    </section>
    </section>

    <!--<section style="">-->

    <!--    <div class="services-main">-->

    <!--        <div class="container">-->
    <!--            <div class="col-sm-12 wow fadeInUp text-center">-->
    <!--                    <h3 class=" mb-3" style="color:black;font-weight: 900;">IF YOU VALUE YOUR TIME MORE THAN MONEY, USE STAYRUNNERS <span style="color:#ff6d55">NOW </span>BY GETTING A RUNNER TO DELIVER WHAT YOU WANT WHEN YOU WANT IT.</h3>-->

    <!--            </div>-->





    <!--                <div class="col-12 wow fadeInUp text-center">-->
    <!--                    <h2 style="color:#ff6d55;padding-bottom:30px;">Look what people are saying about StayRunners</h2>-->



    <!--                 <div class="row">-->
    <!--                    <div class="col-lg-4">-->
    <!--                <div class="p-2">-->



    <!--                    <h4 style="color: black;font-size:18px">"Exceptional service always. They are a -->
    <!--live saver available anytime at a-->
    <!-- reasonable price" <span><b>Karli Pearson</b></span>-->
    <!--</h4>-->
    <!--                </div>-->
    <!--            </div>    -->
    <!--            <div class="col-lg-4">-->
    <!--                <div class="p-2">-->
    <!--                    <h4 style="color: black;font-size:18px">"good services by professional team-->
    <!-- 5 stars rated." <span><b>Chau Nguyen</b></span>-->
    <!--</h4>-->
    <!--                </div>-->
    <!--            </div>    -->
    <!--            <div class="col-lg-4">-->
    <!--                <div class="p-2">-->
    <!--                    <h4 style="color: black;font-size:18px">"Awesome Service, Fast Delivery,  Great Response Time. I Love the Stayrunner Services" <span><b>Mikyun Patel</b></span>-->
    <!--</h4>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--                </div>-->

    <!--            </div>-->

    <!--        </div>-->

    <!--    </div>-->

    <!--</section>-->
    <!--<section>-->
    <!--    <div class="container">-->
    <!--      <h3 class="text-center" style="padding-top:30px;padding-bottom:30px;color:#ff6d55">Concierge for the  Best Hotels in the World are Using StayRunners...look what they are saying….</h3>-->


    <!--    <div class=" services-main text-center">-->
    <!--            <img src="{{ url('front/assets/images/new_img/homepage/Job8th-testimonials.jpg') }}" >-->
    <!--    </div>-->

    <!--    </div>-->

    <!--</section>-->
    <!--<section>-->
    <!--    <div class="container">-->
    <!--         <div class=" services-main text-center">-->
    <!--      <h4 class="text-center" style="padding-top:30px;padding-bottom:30px;color:black;">Give us a Try! We will buy your items, send you the receipts and pay on delivery. Or prepay your items and we will pick them up for you. We accept Cash, Credit, Debit.-->
    <!--</h4>-->



    <!--            <h4 style="color:black;">Just <span onclick="scrollToAddress();" style="cursor:pointer;color:#ff6d55;">Place your order </span> above and a Runner will be assigned to you! 24/7 Liquor Cigarettes Food Vape Groceries Whatever Whenever Wherever.</h4>-->

    <!--    </div>-->

    <!--    </div>-->
    <!--</section>-->


    <!--<section>-->

    <!--    <div class="section-gap-padding">-->

    <!--        <div class="container">-->


    <!--                <div class="col-sm-12 wow fadeInUp text-center">-->
    <!--                    <h1 class=" mb-3" style="color:#ff6d55;font-weight: 900;">Our Top Cities</h1>-->
    <!--                    <div class="row">-->
    <!--                        <div class="col-lg-4">-->
    <!--                            </div>-->
    <!--                    <div class="col-lg-4">-->
    <!--                <div class="p-2">-->
    <!--                    <img src="{{ url('front/assets/images/new_img/homepage/vancouver_city.jpg') }}" >-->

    <!--                    <h1 style="color:black;font-weight:900;">Vancouver</h1>-->
    <!--                </div>-->
    <!--            </div>    -->

    <!--             <div class="col-lg-4">-->
    <!--                            </div>-->
    <!--                </div>-->

    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--<section>-->
    <!--First Video Model-->
    <!--<div class="modal fade" id="FirstVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
    <!--  <div class="modal-dialog" role="document">-->
    <!--    <div class="modal-content">-->
    <!--      <div class="modal-header">-->
    <!--        <h5 class="modal-title"></h5>-->
    <!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
    <!--          <span aria-hidden="true">&times;</span>-->
    <!--        </button>-->
    <!--      </div>-->
    <!--      <div class="modal-body">-->
    <!--        <iframe style="width: -webkit-fill-available;-->
    <!--    height: 325px;"  src="https://www.youtube.com/embed/37n7rf6QXEk">-->
    <!--</iframe>-->
    <!--      </div>-->

    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->

    <!--Second Model Video-->
    <!--<div class="modal fade" id="SecondVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
    <!--  <div class="modal-dialog" role="document">-->
    <!--    <div class="modal-content">-->
    <!--      <div class="modal-header">-->
    <!--        <h5 class="modal-title"></h5>-->
    <!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
    <!--          <span aria-hidden="true">&times;</span>-->
    <!--        </button>-->
    <!--      </div>-->
    <!--      <div class="modal-body">-->
    <!--        <iframe style="width: -webkit-fill-available;-->
    <!--    height: 325px;" src="https://www.youtube.com/embed/8ERxQpX04g4">-->
    <!--</iframe>-->
    <!--      </div>-->

    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->

    <!--Third Model Video-->
    <!--<div class="modal fade" id="ThirdVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
    <!--  <div class="modal-dialog" role="document">-->
    <!--    <div class="modal-content">-->
    <!--      <div class="modal-header">-->
    <!--        <h5 class="modal-title"></h5>-->
    <!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
    <!--          <span aria-hidden="true">&times;</span>-->
    <!--        </button>-->
    <!--      </div>-->
    <!--      <div class="modal-body">-->
    <!--        <iframe style="width: -webkit-fill-available;-->
    <!--    height: 325px;"-->
    <!--    src="https://www.youtube.com/embed/XNl89foLHnM">-->
    <!--</iframe>-->
    <!--      </div>-->

    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
    <!--    <div class="section-gap-padding services-main">-->

    <!--        <div class="container">-->

    <!--<div class="row">-->

    <!--    <div class="col-sm-12 text-center wow fadeInUp">-->

    <!--        <h2 class="main-title">Being a Partner In StayRunners</h2>-->

    <!--        <div class="bottom-gap-padding"></div>-->

    <!--    </div>-->

    <!--</div>-->



    <!--                <div class="col-12 wow fadeInUp text-center">-->
    <!--                    <h1 style="color:#ff6d55;padding-bottom:30px;">StayRunners Success Stories</h1>-->



    <!--                 <div class="row">-->
    <!--                    <div class="col-lg-4">-->
    <!--                <div class="p-2">-->
    <!--                    <div class="p-5" style="    border: 3px solid #ff6d55;-->
    <!--    border-radius: 8px;cursor:pointer" data-toggle="modal" data-target="#FirstVideo">-->
    <!--                        <img src="{{ url('front/assets/images/new_img/youtubeLogoFront.png') }}" style="height:66px">-->
    <!--                    </div>-->


    <!--                    <h5 style="color: black;font-size:14px">Mr.Graham Alexander<br>(CEO - StayRunners)</h5>-->
    <!--                </div>-->
    <!--            </div>    -->
    <!--            <div class="col-lg-4">-->
    <!--                <div class="p-2">-->
    <!--                     <div class="p-5" style="    border: 3px solid #ff6d55;-->
    <!--    border-radius: 8px;cursor:pointer" data-toggle="modal" data-target="#SecondVideo">-->
    <!--                        <img src="{{ url('front/assets/images/new_img/youtubeLogoFront.png') }}" style="height:66px">-->
    <!--                    </div>-->
    <!--                    <h5 style="color: black;font-size:14px">Mr.Nigel Grant<br>(Customer Testimonial)</h5>-->
    <!--                </div>-->
    <!--            </div>    -->
    <!--            <div class="col-lg-4">-->
    <!--                <div class="p-2">-->
    <!--                     <div class="p-5" style="    border: 3px solid #ff6d55;-->
    <!--    border-radius: 8px;cursor:pointer" data-toggle="modal" data-target="#ThirdVideo">-->
    <!--                        <img src="{{ url('front/assets/images/new_img/youtubeLogoFront.png') }}" style="height:66px">-->
    <!--                    </div>-->
    <!--                    <h5 style="color: black;font-size:14px">What is StayRunners?</h5>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--                </div>-->

    <!--            </div>-->

    <!--        </div>-->

    <!--    </div>-->

    <!--</section>-->

    <!--<section class="work-main" style="background:white;padding-bottom: 100px;">-->


    <!--        <div class="container">-->



    <!--            <div class="row">-->

    <!--                <div class="col-sm-12 text-center wow fadeInUp">-->



    <!--                    <div class="sub-title" style="color: black;font-weight: 700;">We are a delivery service in Downtown Vancouver and Tulum Mexico. We deliver liquor, food, drinks,-->
    <!--convenience store items and more!-->
    <!--                    </div>-->
    <!--                </div>-->



    <!--            </div>-->

    <!--        </div>-->


    <!--</section>-->


    <!-- main.css | /* Associated Section S */ __ custom.js | /* Associated Section Slider S */ -->

    <section style="display:none;">

        <div class="section-gap-padding associated-main">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12 text-center wow fadeInUp">

                        <h2 class="main-title">Accommodations Associated with StayRunners</h2>



                        <div class="bottom-gap-padding"></div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-12 text-center wow fadeInUp">



                        <div class="sub-title">We shall be adding soon the list of Accommodations associated with us.</div

                        ><div class="bottom-gap-padding"></div>

                    </div>

                <!-- <div class="col-12 wow fadeInUp">

                    <div class="owl-carousel owl-theme">

                        <div class="item">

                            <article class="associated-main__item">

                                <div class="thumbnail_container">

                                    <div class="thumbnail"> <img src="{{ url('front/assets/images/associated-01.png') }}" alt="Associated"> </div>

                                </div>

                            </article>

                        </div>

                        <div class="item">

                            <article class="associated-main__item">

                                <div class="thumbnail_container">

                                    <div class="thumbnail"> <img src="{{ url('front/assets/images/associated-02.png') }}" alt="Associated"> </div>

                                </div>

                            </article>

                        </div>

                        <div class="item">

                            <article class="associated-main__item">

                                <div class="thumbnail_container">

                                    <div class="thumbnail"> <img src="{{ url('front/assets/images/associated-03.png') }}" alt="Associated"> </div>

                                </div>

                            </article>

                        </div>

                        <div class="item">

                            <article class="associated-main__item">

                                <div class="thumbnail_container">

                                    <div class="thumbnail"> <img src="{{ url('front/assets/images/associated-04.png') }}" alt="Associated"> </div>

                                </div>

                            </article>

                        </div>

                        <div class="item">

                            <article class="associated-main__item">

                                <div class="thumbnail_container">

                                    <div class="thumbnail"> <img src="{{ url('front/assets/images/associated-02.png') }}" alt="Associated"> </div>

                                </div>

                            </article>

                        </div>

                    </div>

                </div> -->

                </div>

            </div>

        </div>

    </section>

    <!--<section>-->
    <!--    <div>-->
    <!--        <div class="container">-->


    <!--                <div class="col-sm-12 wow fadeInUp text-center">-->

    <!--                    <div class="" style="">-->
    <!--                         <h4 style="color:black;">KEEP THE GOOD TIMES ROLLING WITH ALCOHOL - <a href="https://youtu.be/IeVjdKnT2mA">https://youtu.be/IeVjdKnT2mA</a>-->
    <!--                         </h4>-->
    <!--                </div>-->
    <!--            </dv>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- <section>-->

    <!--    <div class="">-->

    <!--        <div class="container">-->


    <!--                <div class="col-sm-12 wow fadeInUp text-center">-->

    <!--                    <div class="" style="">-->

    <!--                        <h1 style="font-size: 2.5rem !important;">StayRunners Night - Your One Stop Destination For Late Liquor and Beer Delivery-->
    <!--</h1> -->

    <!--                        <p>StayRunner brings you On Demand what you want. We revolutionized the 24 hour Virtual Liquor Social Network for Friends, where we give you the liquor for Free. But we charge a Delivery Fee. You must be over the legal age limit and not intoxicated and the consumption and possession of liquor where you are is legal. We also provide Beer, Wine to our Friends, and anything you need such as cigarettes, vapes, snacks, water, and dating. Meet locals in your area and go out and have fun in the After Hours.  </p>-->


    <!--                        <h2 style="font-size: 2rem;">Experience Easy Late Night Delivery to Your Door </h2>-->

    <!--                        <p>-->
    <!--                            At StayRunners, we are committed towards delivering whatever you need quickly during late night hours. No matter what your needs are; we strive to deliver from the range of items including food, liquor, beer, wine, vapes, E-cigarettes or even grocery delivery service in your area. -->
    <!--                        </p>-->

    <!--                        <p>-->
    <!--                          Now, ordering from your favorite hotel and restaurant has become much easier. From Wine, Liquor, beer, and your mouth watering cuisine is just a click away, in addition to ordering groceries too.-->


    <!--                        </p>-->



    <!--                         <h2 style="font-size: 2rem;">-->
    <!--                            Why StayRunners? – Optimize Your Delivery-->
    <!--                        </h2>-->

    <!--                        <h3 style="font-size: 1.75rem;">-->
    <!--                            Quick delivery-->
    <!--                        </h3>-->

    <!--                        <p>-->
    <!--                            Order and get your item delivered to your door in a shortest time.-->
    <!--                            </p>-->

    <!--                        <h3 style="font-size: 1.75rem;">-->
    <!--                           100% customer satisfaction-->
    <!--                        </h3>-->

    <!--                        <p>-->
    <!--                            Get real-time support, quality items, and excellent service to build a long-term relationship with you.-->
    <!--                            </p>-->


    <!--                        <h3 style="font-size: 1.75rem;">24/7 delivery service</h3>-->

    <!--<p>Get 24/7 on-demand delivery service and satisfy your food and liquor needs at any time of day/night.</p>-->
    <!--<h3 style="font-size: 1.75rem;">Other services-->
    <!--</h3>-->

    <!--<p>StayRunners Late Nite offers you anything you can imagine. As long as its legal and its legal for you to have it or possess it we will delivery it to you.</p>-->

    <!--    <h2 style="font-size: 2rem;">Get Late Night Food and Liquor Delivery Service-->
    <!-- </h2>-->

    <!--                        <p>-->
    <!--                            Stayrunners helps you to find and order your required beverage and food from wherever you want. You can order whatever you want.-->

    <!--                        </p>-->
    <!--    <h2 style="font-size: 2rem;">Dating Delivery Service-->
    <!-- </h2>-->

    <!--                        <p>-->
    <!--                        Come have some fun and let us find you a date! StayRunners late night will see if we can find any of our friends on our Social StayRunners Network and maybe they want to come join you for a drink, our show you around town, or maybe just chat! StayRunners is committed to give you the best stay wherever you are!-->

    <!--                        </p>-->
    <!--    <h4 style="1.5rem">Steps to follow:</h4>-->
    <!--                        <p>-->
    <!--                         Just enter your address or city; and put whatever you want in the text bar and as much detail as to what so we can get you whatever, wherever, whenever 24/7. And charge you a simple delivery fee. If our runner performs above your expectations, please feel free to tip him. The better service he gives, the happier he will be and StayRunners will be, the On Demand Delivery Service for Day and Late Night Delivery. All liquor we deliver is free upon becoming a personal friend of Graham Gordon Alexander. We accept cash, debit, credit, paypal, literally any form of payment.-->

    <!--                        </p>-->

    <!--                        <p>Our late night delivery service ensures that you get exactly what you want.</p>-->

    <!--<p>Place your order today and satisfy your needs!-->
    <!--</p>-->


    <!--                </div>-->

    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--<section class="text-center pt-5 pb-5">-->
    <!--    <div class="container">-->


    <!--        <div class="col-sm-12 wow fadeInUp text-center">-->
    <!--             <label style="font-weight: 900;-->
    <!--            text-decoration: underline;padding-bottom:5px;">Disclaimer</label>-->
    <!--                        <p>-->
    <!--                        We do not Sell Liquor. Nor do we exploit women or men to perform illegal sexual acts. We give away our Liquor to people who are over the legal age limit and who are not intoxicated and charge a delivery fee. We are a delivery and dating service, and provide delivery and dates.  We are the Global StayRunners Friends Social Network.-->

    <!--                        </p>-->
    <!--            </div>-->
    <!--            </div>-->
    <!--</section>-->

    <input type="hidden" id="lati"/>
    <input type="hidden" id="longi"/>
    <section>

        <div class="mb-3">

            <div class="container">


                <div class="col-sm-12 wow fadeInUp text-center">

                    <div class="" style="">



                        {!! $setContent !!}
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section>

        <!-- <div class="top-gap-padding map-section">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12 text-center wow fadeInUp">

                        <h2 class="main-title">Available In Vancouver, Canada</h2>

                        <div class="bottom-gap-padding"></div>

                    </div>

                </div>

            </div>

            <div class="embed-responsive embed-responsive-16by9">

                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d83339.38177838847!2d-123.127001!3d49.250704!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x548673f143a94fb3%3A0xbb9196ea9b81f38b!2sVancouver%2C+BC%2C+Canada!5e0!3m2!1sen!2sin!4v1520756841965"></iframe>
            </div> -->
        <!-- <div class="map text-center"> <img src="assets/images/map.jpg" alt="Map"> </div> -->
        <!-- </div> -->

    </section>

@endsection
@section('javascripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-147163364-1');
    </script>
    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMRfIIgixR-0JRXG2r8l425oRPvGGqGSs&libraries=places&callback=initMap"-->
    <!--   async defer></script>-->
    <script src="{{ url('build/js/moment.min.js')}}"></script>
    <script src="{{ url('build/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script>
        // NOw Button
        $('#nowButton').on('click',function(){
            $('input[name="start_date"]').val('NOW');

            $('input[name="deliver_time"]').val('ASAP');
        });

        //   $('.ride-now-button').on('click',function(){
        //          $('#errand_post_form').submit();
        //   });
        $("#submit").on("click", function(e){

            console.log('HELLO')
// function sendData(){



            e.preventDefault();
            var local_form = {errand_form: []};
            local_form["errand_form"].push({
                err_1: $('#err_1').val(),
                err_2: $('#err_2').val(),
                err_3: $('#err_3').val(),
                other_details: $('#other_details').val(),
                err_contact_person: $('#err_contact_person').val(),
                err_phone: $('#err_phone').val(),
                err_email: $('#err_email').val(),
                start_location: $('#start_location').val(),
                start_latitude: $("#start_latitude").val(),
                start_longitude: $("#start_longitude").val(),
                start_date: $("#start_date").val(),
                deliver_time: $("#deliver_time").val(),
                buzz_code: $("#buzz_code").val(),
                suite_no: $("#suite_no").val()
            });
            localStorage.setItem("errand_form", JSON.stringify(local_form));
            window.location.href = "{{ route('user.errand_login') }}";
        });
    </script>

    <script type="text/javascript">
        function scrollToAddress()
        {
            $("html, body").animate({ scrollTop: 0 }, "slow");
        }
        // var ml4 = {};
        // ml4.opacityIn = [0,1];
        // ml4.scaleIn = [0.2, 1];
        // ml4.scaleOut = 3;
        // ml4.durationIn = 800;
        // ml4.durationOut = 600;
        // ml4.delay = 500;

        // anime.timeline({loop: true})
        //   .add({
        //     targets: '.ml4 .letters-1',
        //     opacity: ml4.opacityIn,
        //     scale: ml4.scaleIn,
        //     duration: ml4.durationIn
        //   }).add({
        //     targets: '.ml4 .letters-1',
        //     opacity: 0,
        //     scale: ml4.scaleOut,
        //     duration: ml4.durationOut,
        //     easing: "easeInExpo",
        //     delay: ml4.delay
        //   }).add({
        //     targets: '.ml4 .letters-2',
        //     opacity: ml4.opacityIn,
        //     scale: ml4.scaleIn,
        //     duration: ml4.durationIn
        //   }).add({
        //     targets: '.ml4 .letters-2',
        //     opacity: 0,
        //     scale: ml4.scaleOut,
        //     duration: ml4.durationOut,
        //     easing: "easeInExpo",
        //     delay: ml4.delay
        //   }).add({
        //     targets: '.ml4 .letters-3',
        //     opacity: ml4.opacityIn,
        //     scale: ml4.scaleIn,
        //     duration: ml4.durationIn
        //   }).add({
        //     targets: '.ml4 .letters-3',
        //     opacity: 0,
        //     scale: ml4.scaleOut,
        //     duration: ml4.durationOut,
        //     easing: "easeInExpo",
        //     delay: ml4.delay
        //   }).add({
        //     targets: '.ml4',
        //     opacity: 0,
        //     duration: 500,
        //     delay: 500
        //   });

        // Wrap every letter in a span
        // var textWrapper = document.querySelector('.ml4 .lettersHead');
        // textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

        // anime.timeline({loop: true})

        //   .add({
        //     targets: '.ml4 .letters-1',
        //     rotateY: [-90, 0],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //     opacity:[0,1]
        //   })
        //   .add({
        //     targets: '.ml4 .letters-1',
        //     rotateY: [0, -90],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //     opacity:0
        //   })
        //   .add({
        //     targets: '.ml4 .letters-2',
        //     rotateY: [-90, 0],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:[0,1]
        //   })
        //   .add({
        //     targets: '.ml4 .letters-2',
        //     rotateY: [0,-90],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:0
        //   }).add({
        //     targets: '.ml4 .letters-3',
        //     rotateY: [-90, 0],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:[0,1]
        //   }).add({
        //     targets: '.ml4 .letters-3',
        //     rotateY: [0,-90],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:0
        //   })
        //   .add({
        //     targets: '.ml4 .letters-4',
        //     rotateY: [-90, 0],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:[0,1]
        //   }).add({
        //     targets: '.ml4 .letters-4',
        //     rotateY: [0,-90],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:0
        //   }).add({
        //     targets: '.ml4 .letters-5',
        //     rotateY: [-90, 0],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:[0,1]
        //   }).add({
        //     targets: '.ml4 .letters-5',
        //     rotateY: [0,-90],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:0
        //   })
        //   .add({
        //     targets: '.ml4 .letters-6',
        //     rotateY: [-90, 0],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:[0,1]
        //   }).add({
        //     targets: '.ml4 .letters-6',
        //     rotateY: [0,-90],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:0
        //   })
        //   .add({
        //     targets: '.ml4 .letters-7',
        //     rotateY: [-90, 0],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:[0,1]
        //   }).add({
        //     targets: '.ml4 .letters-7',
        //     rotateY: [0,-90],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:0
        //   })
        //   .add({
        //     targets: '.ml4 .letters-8',
        //     rotateY: [-90, 0],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:[0,1]
        //   }).add({
        //     targets: '.ml4 .letters-8',
        //     rotateY: [0,-90],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:0
        //   })
        //   .add({
        //   targets: '.ml4',
        //     opacity: 0,
        //     duration: 500,
        //     easing: "easeOutExpo",
        //     delay: 100
        //   });

        //   anime.timeline({loop: true})

        //   .add({
        //     targets: '.ml5 .letters-1',
        //     rotateY: [-90, 0],
        //     duration: 2000,
        //     delay: (el, i) => 45 * i,
        //     opacity:[0,1]
        //   })
        //   .add({
        //     targets: '.ml5 .letters-1',
        //     rotateY: [0, -90],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //     opacity:0
        //   })
        //   .add({
        //     targets: '.ml5 .letters-2',
        //     rotateY: [-90, 0],
        //     duration: 2000,
        //     delay: (el, i) => 45 * i,
        //      opacity:[0,1]
        //   })
        //   .add({
        //     targets: '.ml5 .letters-2',
        //     rotateY: [0,-90],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:0
        //   }).add({
        //     targets: '.ml5 .letters-3',
        //     rotateY: [-90, 0],
        //     duration: 2000,
        //     delay: (el, i) => 45 * i,
        //      opacity:[0,1]
        //   }).add({
        //     targets: '.ml5 .letters-3',
        //     rotateY: [0,-90],
        //     duration: 1300,
        //     delay: (el, i) => 45 * i,
        //      opacity:0
        //   })
        //   .add({
        //   targets: '.ml5',
        //     opacity: 0,
        //     duration: 100,
        //     easing: "easeOutExpo",
        //     delay: 100
        //   });
        localStorage.clear();

        //   function initMap() {
        // //     var defaultBounds = new google.maps.LatLngBounds(
        // //     new google.maps.LatLng(19.432608,-99.133209),
        // //   new google.maps.LatLng(49.246292,-123.116226),


        // //  );

        //  var input3 = document.getElementById('start_location');
        //       var autocomplete3 = new google.maps.places.Autocomplete(input3);
        //       google.maps.event.addListener(autocomplete3, 'place_changed', function(){
        //           var place = autocomplete3.getPlace();
        //           var lat3 = place.geometry.location.lat();
        //           var lng3 = place.geometry.location.lng();
        //           $(".address_divErrand").html(place.adr_address);
        //           var count = $(".address_divErrand").parent().find('.street-address').length;
        //           if(count > 0){
        //                 $(".start_location_error").hide();
        //                 $('#start_latitude').val(lat3);
        //                 $('#start_longitude').val(lng3);
        //                 $('#start_preview').html('Preview: <a target="_blank" href="' + place['url'] + '">' + place['name'] + '</a>');
        //             }else{
        //               if($.trim(input) != ""){
        //                     $(".start_location_error").show();
        //                 }else{
        //                     $(".start_location_error").hide();
        //                 }
        //                 $('#start_latitude').val('');
        //                 $('#start_longitude').val('');
        //                 $('#start_preview').html('');
        //             }
        //       });


        // var input = document.getElementById('hotelName');

        //     // var input = document.getElementById('hotelName');
        //     var autocomplete = new google.maps.places.Autocomplete(input);

        //      autocomplete.setComponentRestrictions({country: ['mx','ca']});
        //     //   autocomplete.setBounds(defaultBounds);
        //     // autocomplete.setOptions({strictBounds: true});
        //     google.maps.event.addListener(autocomplete, 'place_changed', function(){
        //         var place = autocomplete.getPlace();
        //         var lat = place.geometry.location.lat();
        //         var lng = place.geometry.location.lng();

        //         $("#hotelname").val(place['name']);
        //         $("#hoteladdress").val(place.formatted_address);
        //         $("#hotellat").val(lat);
        //         $("#hotellng").val(lng);
        //         $("#hotelphone").val(place['international_phone_number']);
        //         $("#hotelwebsite").val(place['website']);
        //         $("#hotelrating").val(place['rating']);
        //         $('#preview').html('Preview: <a target="_blank" style="color: #ff9800;font-weight: bolder;" href="' + place['url'] + '">' + place['name'] + '</a>');

        //         $(".address_div").html(place.adr_address);
        //         var count = $(".address_div").parent().find('.street-address').length;
        //         if(count > 0){
        //             localStorage.setItem('street_address',count);
        //           $(".hotel_address_error").hide();
        //           $('#latitude').val(lat);
        //           $('#longitude').val(lng);
        //           $('#hotel_address_form').submit();
        //         }else{

        //           if($.trim(input) != ""){
        //               $('#hotel_address_form').submit();
        //             //   $(".hotel_address_error").show();
        //           }else{
        //               $(".hotel_address_error").hide();
        //           }
        //           $('#latitude').val('');
        //           $('#longitude').val('');
        //           /*alert("Select an address which includes an exact street address.");*/
        //         }
        //     });

        //         var input2 = document.getElementById('hotelName2');
        //     var autocomplete2 = new google.maps.places.Autocomplete(input2);
        //      autocomplete2.setComponentRestrictions({country: ['mx','ca']});
        //     google.maps.event.addListener(autocomplete2, 'place_changed', function(){
        //         var place = autocomplete2.getPlace();
        //         var lat = place.geometry.location.lat();
        //         var lng = place.geometry.location.lng();

        //         $("#hotelname2").val(place['name']);
        //         $("#hoteladdress2").val(place.formatted_address);
        //         $("#hotellat2").val(lat);
        //         $("#hotellng2").val(lng);
        //         $("#hotelphone2").val(place['international_phone_number']);
        //         $("#hotelwebsite2").val(place['website']);
        //         $("#hotelrating2").val(place['rating']);
        //         $('#preview2').html('Preview: <a target="_blank" style="color: #ff9800;font-weight: bolder;" href="' + place['url'] + '">' + place['name'] + '</a>');

        //         $(".address_div2").html(place.adr_address);
        //         var count = $(".address_div2").parent().find('.street-address').length;
        //         if(count > 0){
        //             localStorage.setItem('street_address',count);
        //           $(".hotel_address_error2").hide();
        //           $('#latitude2').val(lat);
        //           $('#longitude2').val(lng);
        //           $('#hotel_address_form2').submit();
        //         }else{

        //           if($.trim(input) != ""){
        //               $('#hotel_address_form2').submit();
        //             //   $(".hotel_address_error2").show();
        //           }else{
        //               $(".hotel_address_error2").hide();
        //           }
        //           $('#latitude2').val('');
        //           $('#longitude2').val('');
        //           /*alert("Select an address which includes an exact street address.");*/
        //         }
        //     });
        //   }

        $('.go_button').on('click',function(){
            if($('.city_input_field').val() == '')
            {
                alert('Please enter city to proceed.');
            }
            else
            {
                var local_form = {home_page_form: []};
                local_form["home_page_form"].push({
                    city_field: $('.city_input_field').val(),
                    product_details: $('.product_details').val(),

                });
                localStorage.setItem("home_page_form", JSON.stringify(local_form));
                str2 = $('.city_input_field').val();
                cityUrl = str2.toLowerCase();
                cityUrl = cityUrl.replace(/ /g, "-");
                console.log(cityUrl);
                window.location.href = "/city/" + cityUrl;
            }

        });


        //   $("#hotel_address_form2").on("submit", function(e){
        //       var local_form2 = {hotel_form2: []};
        //       e.preventDefault();
        //       if($('#latitude2').val() == ""){
        //             local_form2 = {hotel_form2: []};
        //             return false;
        //       }else{
        //         local_form2["hotel_form2"].push({
        //             mainAddress: $('#hotelName2').val(),
        //             hotelname: $("#hotelname2").val(),
        //             hoteladdress: $("#hoteladdress2").val(),
        //             hotellat: $("#hotellat2").val(),
        //             hotellng: $("#hotellng2").val(),
        //             hotelphone: $("#hotelphone2").val(),
        //             hotelwebsite: $("#hotelwebsite2").val(),
        //             hotelrating: $("#hotelrating2").val(),
        //         });
        //         debugger;
        //         // var local_form = JSON.parse('{"' + decodeURI($(this).serialize()).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
        //         localStorage.setItem("hotel_form2", JSON.stringify(local_form2));
        //         // window.location.href = "{{ route('user.create_booking_login') }}";
        //         $.ajax({
        //           url:'/checkSupplierUnder10km',
        //           method: 'POST',
        //           async: false,
        //           data:{"lat": $("#hotellat2").val(), "lng" : $("#hotellng2").val(),'address_for_url':$("#hoteladdress2").val(),"_token": $('meta[name="csrf-token"]').attr('content')},
        //           success:function()
        //           {
        //              var str1 = $("#hoteladdress2").val();
        //                 console.log(str1);
        //               var str2 = 'Vancouver';var str3 = 'Tulum';
        //               var cityUrl = '';
        //               if(str1.indexOf(str2) != -1){
        //                   cityUrl = str2.toLowerCase();
        //               }
        //               else if(str1.indexOf(str3) != -1)
        //               {
        //                     cityUrl = str3.toLowerCase();
        //               }
        //                   console.log(cityUrl);
        //                 if(cityUrl == '')
        //               {



        //               window.location.href = "/categories";

        //               }
        //               else
        //               {

        //                   window.location.href = "/categories/" + cityUrl;

        //               }
        //           }
        //         });

        //       }
        //   });
        //   $("#hotel_address_form").on("submit", function(e){
        //       var local_form = {hotel_form: []};
        //       e.preventDefault();
        //       if($('#latitude').val() == ""){
        //             local_form = {hotel_form: []};
        //             return false;
        //       }else{
        //         local_form["hotel_form"].push({
        //             mainAddress: $('#hotelName').val(),
        //             hotelname: $("#hotelname").val(),
        //             hoteladdress: $("#hoteladdress").val(),
        //             hotellat: $("#hotellat").val(),
        //             hotellng: $("#hotellng").val(),
        //             hotelphone: $("#hotelphone").val(),
        //             hotelwebsite: $("#hotelwebsite").val(),
        //             hotelrating: $("#hotelrating").val(),
        //         });
        //         debugger;
        //         // var local_form = JSON.parse('{"' + decodeURI($(this).serialize()).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
        //         localStorage.setItem("hotel_form", JSON.stringify(local_form));
        //         // window.location.href = "{{ route('user.create_booking_login') }}";
        //         $.ajax({
        //           url:'/checkSupplierUnder10km',
        //           method: 'POST',
        //           async: false,
        //           data:{"lat": $("#hotellat").val(), "lng" : $("#hotellng").val(),'address_for_url':$("#hoteladdress").val(),"_token": $('meta[name="csrf-token"]').attr('content')},
        //             success:function()
        //           {

        //               var str1 = $("#hoteladdress").val();
        //                 console.log(str1);
        //               var str2 = 'Vancouver';var str3 = 'Tulum';
        //               var cityUrl = '';
        //               if(str1.indexOf(str2) != -1){
        //                   cityUrl = str2.toLowerCase();
        //               }
        //               else if(str1.indexOf(str3) != -1)
        //               {
        //                     cityUrl = str3.toLowerCase();
        //               }
        //                   console.log(cityUrl);
        //                   if(cityUrl == '')
        //               {



        //               window.location.href = "/categories";

        //               }
        //               else
        //               {

        //                   window.location.href = "/categories/" + cityUrl;

        //               }
        //           }
        //         });


        //       }
        //  });

        $("#hotel_address_form2").on("submit", function(e){
            var local_form2 = {hotel_form2: []};
            e.preventDefault();

            local_form2["hotel_form2"].push({
                mainAddress: $('#hotelName2').val(),
                hotelname: $("#hotelname2").val(),
                hoteladdress: $("#hoteladdress2").val(),
                hotellat: $("#hotellat2").val(),
                hotellng: $("#hotellng2").val(),
                hotelphone: $("#hotelphone2").val(),
                hotelwebsite: $("#hotelwebsite2").val(),
                hotelrating: $("#hotelrating2").val(),
            });
            // debugger;
            // var local_form = JSON.parse('{"' + decodeURI($(this).serialize()).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
            localStorage.setItem("hotel_form2", JSON.stringify(local_form2));
            // window.location.href = "{{ route('user.create_booking_login') }}";
            $.ajax({
                url:'/addressFromCityPage',
                method: 'POST',
                async: false,
                data:{"lat": $("#hotellat2").val(), "lng" : $("#hotellng2").val(),'address_for_url':$("#hoteladdress2").val(),"_token": $('meta[name="csrf-token"]').attr('content')},
                success:function(res)
                {
                    var str1 = $("#hoteladdress2").val();
                    console.log(str1);
                    var str2 = res.trim();
                    var cityUrl = '';
                    if(str1.indexOf(str2) != -1){
                        cityUrl = str2.toLowerCase();
                        cityUrl = cityUrl.replace(" ", "-");
                    }



                    window.location.href = "/city/" + cityUrl;


                }
            });


        });
        $("#hotel_address_form").on("submit", function(e){
            console.log('hellow');
            var local_form = {hotel_form: []};
            e.preventDefault();

            local_form["hotel_form"].push({
                mainAddress: $('#hotelName').val(),
                hotelname: $("#hotelname").val(),
                hoteladdress: $("#hoteladdress").val(),
                hotellat: $("#hotellat").val(),
                hotellng: $("#hotellng").val(),
                hotelphone: $("#hotelphone").val(),
                hotelwebsite: $("#hotelwebsite").val(),
                hotelrating: $("#hotelrating").val(),
            });
            // debugger;
            // var local_form = JSON.parse('{"' + decodeURI($(this).serialize()).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
            localStorage.setItem("hotel_form", JSON.stringify(local_form));
            // window.location.href = "{{ route('user.create_booking_login') }}";
            $.ajax({
                url:'/addressFromCityPage',
                method: 'POST',
                async: false,
                data:{"lat": $("#hotellat").val(), "lng" : $("#hotellng").val(),'address_for_url':$("#hoteladdress").val(),"_token": $('meta[name="csrf-token"]').attr('content')},
                success:function(res)
                {

                    var str1 = $("#hoteladdress").val();

                    var str2 = res.trim();
                    var cityUrl = '';
                    if(str1.indexOf(str2) != -1){
                        cityUrl = str2.toLowerCase();
                        cityUrl = cityUrl.replace(" ", "-");
                    }



                    window.location.href = "/city/" + cityUrl;
                }
            });



        });

        function CTAFunction(){
            window.scrollTo({top: 0, behavior: 'smooth'});
        }

    </script>
    <script type="text/javascript">



        $(document).ready(function() {

            var counterDataTime = 0;
            var localTime = new Date();
            var ptTime = new Date();

            ptTime.setMinutes(ptTime.getMinutes() + localTime.getTimezoneOffset() - 420);

            $('#start_date').datetimepicker({
                format: 'YYYY-MM-DD',
                minDate: ptTime,
            }).on('dp.change', function (e) {
                var incrementDay = moment(new Date(e.date));
                incrementDay.add(1, 'days');
                // $('#checkout_date').data('DateTimePicker').minDate(incrementDay);
                $(this).data("DateTimePicker").hide();
                $('#deliver_time').val('');
            });

            $('#deliver_time').datetimepicker({
                format: 'HH:mm',
                stepping: 30
            });



        });
        var geocoder;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
        }
        //Get the latitude and the longitude;
        function successFunction(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            codeLatLng(lat, lng)
        }

        function errorFunction(){
            // alert("Geocoder failed");
        }

        function initialize() {
            var input = '';
            if($(window).width()<=768){
                $("#webCity").removeClass('city_input_field');
                $("#webProductDetails").removeClass('product_details');
                $("#mobileCity").addClass('city_input_field');
                $("#mobileProductDetails").addClass('product_details');
                input  = document.getElementById('mobileCity');
            }
            else
            {
                $("#mobileCity").removeClass('city_input_field');
                $("#mobileProductDetails").removeClass('product_details');
                $("#webCity").addClass('city_input_field');
                $("#webProductDetails").addClass('product_details');
                input  = document.getElementById('webCity');
            }
            geocoder = new google.maps.Geocoder();

            var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function(){
                var place = autocomplete.getPlace();
                var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng();
                $('#lati').val();
                $('#longi').val();
                console.log(lat,lng);
                codeLatLng(lat, lng);
                $(".address_div").html(place.adr_address);

            });

        }

        function codeLatLng(lat, lng) {

            var latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    console.log(results)
                    if (results[1]) {
                        //formatted address
                        //  alert(results[0].formatted_address)
                        //find country name
                        for (var i=0; i<results[0].address_components.length; i++) {
                            for (var b=0;b<results[0].address_components[i].types.length;b++) {

                                //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                                if (results[0].address_components[i].types[b] == "locality") {
                                    //this is the object you are looking for
                                    city= results[0].address_components[i];

                                    break;
                                }
                            }
                        }
                        //city data
                        // alert(city.short_name + " " + city.long_name)
                        $('.city_input_field').val(city.long_name);
                        /*  var night_time = "<?php echo session()->get('city_time_zone'); ?>";
        if(night_time.trim() == '')
        {

            $.ajax({
                url:'/get_city',
                method:'GET',
                dataType:'JSON',
                data:{'city':city.long_name,'lat':lat, 'long':lng},
                success:function(data){

                    if(data.night_start_time != null || data.night_end_time != null || data.sales_line_text != null || data.night_sales_line_text != null)
                    {
                        location.reload();
                    }
                }
            });
        }*/


                    } else {
                        //   alert("No results found");
                    }
                } else {
                    // alert("Geocoder failed due to: " + status);
                }
            });
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMRfIIgixR-0JRXG2r8l425oRPvGGqGSs&libraries=places&type=hotel&callback=initialize"
            async defer></script>
@endsection
