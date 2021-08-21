<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-fav.png') }}">
    <title>Mehr Ali Developers</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/material-design-icons/css/material-design-iconic-font.min.css') }}"/><!--[if lt IE 9]>
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/select2/css/select2.min.css') }}"/>--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/bootstrap-slider/css/bootstrap-slider.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/jqvmap/jqvmap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/datatables/css/dataTables.bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/select2/css/select2.min.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


</head>
<style type="text/css">
    .select2-container .select2-selection--single {
        height: 38px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 39px;
        /*outline: none !important;*/
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        border-style: none;
        margin-top: -10px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 12px;
        position: absolute;
        top: 1px;
        right: 1px;
        /* width: 20px; */
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        height: auto;
    }
    .customModal{
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
.customSidebarbackground
{
    background: #1572E8;
}
.be-left-sidebar .sidebar-elements > li > a {
    color: white;
}

.be-left-sidebar .sidebar-elements > li.active > a {
    background: #8EC0FF;
}
.be-left-sidebar .sidebar-elements > li ul li.active > a {
    color: #8EC0FF;
}
/* .customSidebarbackground :hover
{
    background: #8EC0FF;
} */
.customDivider
{
    color: white !important;
}

.be-left-sidebar .sidebar-elements > li.active > a > span {
    color: white !important;
}
.be-left-sidebar .sidebar-elements > li.active > a {
    color: white !important;
}
.be-left-sidebar .sidebar-elements > li.active > a > span:hover {
    color: black !important;
}
.be-left-sidebar .sidebar-elements > li > a:hover > span {
    color: white;

}
.be-left-sidebar .sidebar-elements > li > a:hover {
    background: #8EC0FF;
}
.be-left-sidebar .sidebar-elements > li.active > a > span:hover {
    color: white !important;
}
</style>
<body>
{{--// for the header--}}
@include('admin.partials.header')
{{--for the sidebar--}}
@include('admin.partials.sidebar')

@yield('content')
{{--    right sideabr--}}
@include('admin.partials.rightsidebar')

<script src="{{ asset('assets/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jquery-flot/jquery.flot.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jquery-flot/jquery.flot.pie.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jquery-flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jquery-flot/plugins/jquery.flot.orderBars.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jquery-flot/plugins/curvedLines.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jquery.sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/countup/countUp.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jqvmap/jquery.vmap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/app-dashboard.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/app-tables-datatables.js') }}" type="text/javascript"></script>


<script src="{{asset('assets/lib/datatables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/datatables/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/datatables/plugins/buttons/js/buttons.html5.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/datatables/plugins/buttons/js/buttons.flash.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/datatables/plugins/buttons/js/buttons.print.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/datatables/plugins/buttons/js/buttons.colVis.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/datatables/plugins/buttons/js/buttons.bootstrap.js')}}" type="text/javascript"></script>

<script src="{{ asset('assets/lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/js/app-form-elements.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
 <script src="{{asset('assets/lib/jquery.niftymodals/dist/jquery.niftymodals.js')}}" type="text/javascript"></script>
@yield('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.dashboard();
        App.dataTables();
    });
    // $(document).ready(function() {
    //     $('.js-example-basic-single').select2();
    // });
</script>
</body>
</html>
