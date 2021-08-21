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
                        <div class="panel-heading panel-heading-divider ">
                            <span class="text-primary">General Ledger </span>
                            <span class="panel-subtitle">From here you can get general ledger</span>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="" class="text-primary">Start Date</label>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" id="start_date" name="day">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="text-primary">End Date</label>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="date" id="end_date" class="form-control"  value="{{ date('Y-m-d') }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="text-primary">Select Project</label>
                                    <select name="" id="project_id" class="select2 ">
                                        <option value="">Select Project</option>
                                        @foreach(\App\Models\Projects\Project::all() as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <br><br>
                                    <button class="btn btn-primary btn-sm generalReport">Generate Ledger</button>
                                    <img style="display: none;" id="loading" src="{{url('loading.gif')}}" width="50" class="img-responsive">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-body">

                            <div class="row invoice-data" style="margin-bottom:0;">

                                <div class="col-xs-12 invoice-person">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <h1 id="project_name" class="fontStyle"></h1>
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
                                                    <h3 class="custom_margin fontStyle">Main Ledger Balances</h3>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <table  width="50%">
                                                        <tr><th>&nbsp</th></tr>
                                                        <tr><th>&nbsp</th></tr>
                                                        <tr>
                                                            <th>From:</th>
                                                            <td id="start"></td>
                                                            <th style="text-align: end;">To:</th>
                                                            <td id="end"></td>
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
                                                <h1 style="font-family: Emoji,serif;  background-color: #1572E8;color: white;" class="test text-uppercase">General Ledger</h1>
                                            </center>

                                            <table class="table table-bordered" style="border-collapse: collapse;width:100%;margin-top:-10px;">
                                                <thead>
                                                <tr style="font-size: 11px;background-color: #1572E8;color: white;" class="text-uppercase ">
                                                    <th class="text-center test1" style="padding:1px;">Account Title and Description</th>
                                                    <th class="text-center test1" style="padding:1px;">Debit</th>
                                                    <th class="text-center test1" style="padding:1px;">Credit</th>
                                                    <th class="text-center test1" style="padding:1px;">A/c Ledger</th>
                                                </tr>
                                                </thead>
                                                <tbody id="detail">
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












                $("body").on('click','.generalReport',function(){
                    @php
                        date_default_timezone_set("Asia/Karachi");
                         $time=date("h:i:sa");
                    @endphp
                    let start      = $('#start_date').val();
                    let end        = $('#end_date').val();
                    let project_id = $('#project_id').val();
                    if(project_id=="" || project_id==null)
                    {
                        alert("Please Select the Project");
                        return;
                    }
                     let  s= new Date(start);
                    $('#start').html(start);
                    $('#end').html(end);
                    {{--$('#time').html("{{ \Carbon\Carbon::parse()->format('d M Y') }} "+" @php echo date("h:i:sa"); @endphp ");--}}
                    let projectname = $('#project_id option:selected').text();
                    $('#project_name').html(projectname+"  (Mehr Ali Developers)");
                    $('#loading').css('display','inline');
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    var request    = $.ajax({
                        url: "{{ route('get.general_ledger') }}",
                        method: "post",
                        data: {_token: CSRF_TOKEN, start:start,end:end,project_id:project_id},
                        dataType: "html"
                    });
                    request.done(function( msg ) {
                        var data = JSON.parse(msg);
                        console.log(msg);
                        $('#detail').html(data.result);
                        $('#loading').css('display','none');
                    });
                });

                $(document).ready(function(){
                    App.formElements();
                });


            </script>
@endsection
