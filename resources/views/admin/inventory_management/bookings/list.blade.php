@extends('admin.layouts.app')
@section('content')
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
                            <div class="panel-heading panel-heading-divider">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="" class="text-primary">Select Projects</label>
                                        <select name=""  onchange="getSectors(this.value)" id="project_id" class="select2">
                                            <option value="">Select One</option>
                                            @foreach(\App\Models\Projects\Project::all() as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="text-primary">Select Sectors</label>
                                        <select name="sector_id"  id="sectors"
                                                class="select2 " required>
                                            <option value="">Select Sector</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="text-primary">Select Customer</label>
                                        <select name="" id="customer_id" class="select2">
                                            <option value="">Select Customer</option>
                                            @foreach(\App\Models\Customers\Customer::where('status',1)->get() as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <br>
                                        <button class="btn btn-primary btn-sm filter" style="margin-top: 15px;">Filter</button>
                                        <img style="display: none;" id="loading" src="{{url('loading.gif')}}" width="50" class="img-responsive">
                                    </div>
                                </div>
                            </div>

                        <div class="panel-body">
                            <div class="p-2">
                                <center>
                                    <h3><b>Manage Bookings</b></h3>
                                </center>
                                <div class="table-responsive">
                                    <table id="table1" class="table table-striped table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>Customer Name</th>
                                            <th>Sector Name</th>
                                            <th>Block </th>
                                            <th>Plot #</th>
                                            <th>Contact#</th>
                                            <th>Agreed Price</th>
                                            <th>Received Amount</th>
                                            <th>Outstanding Recovery Till Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>

                                        <tbody id="detail">

                                            @foreach($bookings as $booking)
                                                <tr class="gradeC">
                                                    <td>{{$counter++}}</td>
                                                    <td>
                                                        @if($booking->Customer_Name)
                                                            {{$booking->Customer_Name->name}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($booking->Sector_Name)
                                                            {{$booking->Sector_Name->name}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($booking->Block_Name)
                                                            {{$booking->Block_Name->name}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($booking->Plot_Name)
                                                            {{$booking->Plot_Name->name}}
                                                        @endif
                                                    </td>
                                                    <td>{{$booking->customer_contact}}</td>
                                                    <td>{{ number_format($booking->agreed_price-$booking->discount,2) }}</td>
                                                    <td>{{number_format($booking->received,2)}}</td>
                                                    @php
                                                         $outstandings      = \App\Models\Installments\Installment::where('booking_id',$booking->id)->where('installment_amount','>','0')->where('description','!=','Booking')->where('date','<',date('Y-m-d'))->get();
                                                         $total_outstanding = 0;
                                                         foreach ($outstandings as $outstanding)
                                                         {
                                                                  $total_outstanding += $outstanding->installment_amount;
                                                         }
                                                    @endphp
                                                    <td>
                                                        {{ number_format($total_outstanding,2) }}
                                                    </td>
                                                    <td id="bookingstatus{{ $booking->id }}">
                                                        @if($booking->status==1)
                                                            <font style="color: green">Approved</font>
                                                        @else
                                                            <font style="color: red;">Pending</font>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="input-group-btn">
                                                            <button type="button" data-toggle="dropdown"
                                                                    class="btn btn-xs btn-primary dropdown-toggle"
                                                                    aria-expanded="false">
                                                                Actions
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right">
                                                                @if((Auth::user()->role) == 'Super Admin')
                                                                    <li>
                                                                        <a  target="_blank" href="{{ route('terms.condition',[$booking->id]) }}">
                                                                            <i class="fa fa-gavel"></i> Terms & Condition
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a  target="_blank" href="{{ route('edit.booking',[$booking->id]) }}">
                                                                            <i class="fa fa-edit"></i> Edit
                                                                        </a>
                                                                    </li>
                                                                    @if($booking->status==1)

                                                                    @else

                                                                        <li>
                                                                            <a   href="{{ route('delete.booking',[$booking->id]) }}">
                                                                                <i class="fa fa-trash"></i> Delete
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    @if($booking->status==1)
                                                                    @else
{{--                                                                        <li>--}}
{{--                                                                            <a  href="{{ route('approved.booking',[$booking->id]) }}">--}}
{{--                                                                                <i class="fa fa-check"></i>--}}
{{--                                                                                Booking Approved--}}
{{--                                                                            </a>--}}
{{--                                                                        </li>--}}
                                                                        <li>
                                                                            <a class="bookingApproved" date-id="{{ $booking->id }}">
                                                                                <i class="fa fa-check"></i>Booking Approved
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    <li>
                                                                        <a target="_blank"
                                                                           href="{{ route('print.card',[$booking->id]) }}">
                                                                            <i class="fa fa-id-card"></i>
                                                                            Print Card
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a target="_blank"
                                                                           href="{{ route('application.form',[$booking->id]) }}">
                                                                            <i class="fa fa-wpforms"></i>
                                                                            Application Form
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a target="_blank"
                                                                           href="{{ route('plot.detail',[$booking->id]) }}">
                                                                            <i class="fa fa-calendar"></i>
                                                                            Payment Schedule
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a target="_blank"
                                                                           href="{{ route('pay.amount',[$booking->id]) }}">
                                                                            <i class="fa fa-credit-card"></i>
                                                                            Pay Amount
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a target="_blank" href="{{ route('booking.receipts',[$booking->id]) }}"><i class="fa fa-files-o"></i> Receipts</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('confirmation.sheet',[$booking->id]) }}" target="_blank"><i class="fa fa-check"></i> Confirmation
                                                                            Sheet</a>
                                                                    </li>
                                                                    <li>
                                                                        <a target="_blank" href="{{ route('update.inqtiqal',[$booking->id]) }}"><i class="fa fa-refresh"></i> Update
                                                                            Intiqal
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a target="_blank" href="{{ route('allotment.letter',[$booking->id]) }}"><i class="fa fa-tasks"></i> Allotment
                                                                            Letter</a>
                                                                    </li>

                                                                    {{-- ////// else if part ///////////// --}}
                                                                @elseif((Auth::user()->role)=="GM")
                                                                    <li>
                                                                        <a class="bookingApproved" date-id="{{ $booking->id }}">
                                                                            <i class="fa fa-check"></i>Booking Approved
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a target="_blank"
                                                                           href="{{ route('print.card',[$booking->id]) }}">
                                                                            <i class="fa fa-id-card"></i>
                                                                            Print Card
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a target="_blank"
                                                                           href="{{ route('application.form',[$booking->id]) }}">
                                                                            <i class="fa fa-wpforms"></i>
                                                                            Application Form
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a target="_blank"
                                                                           href="{{ route('plot.detail',[$booking->id]) }}">
                                                                            <i class="fa fa-calendar"></i>
                                                                            Payment Schedule
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a target="_blank"
                                                                           href="{{ route('pay.amount',[$booking->id]) }}">
                                                                            <i class="fa fa-credit-card"></i>
                                                                            Pay Amount
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a target="_blank" href="{{ route('booking.receipts',[$booking->id]) }}"><i class="fa fa-files-o"></i> Receipts</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('confirmation.sheet',[$booking->id]) }}" target="_blank"><i class="fa fa-check"></i> Confirmation
                                                                            Sheet</a>
                                                                    </li>
                                                                    <li>
                                                                        <a target="_blank" href="{{ route('update.inqtiqal',[$booking->id]) }}"><i class="fa fa-refresh"></i> Update
                                                                            Intiqal
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('allotment.letter',[$booking->id]) }}" target="_blank"><i class="fa fa-tasks"></i> Allotment
                                                                            Letter</a>
                                                                    </li>
                                                                    {{-- else part from here                                                         --}}
                                                                @else
                                                                    @if($booking->status==1)

                                                                        @can('Manage Booking','Payment Schedule')
                                                                            <li>
                                                                                <a target="_blank"
                                                                                   href="{{ route('plot.detail',[$booking->id]) }}">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                    Payment Schedule
                                                                                </a>
                                                                            </li>
                                                                        @endcan
                                                                        @can('Manage Booking','Pay Amount')
                                                                            <li>
                                                                                <a target="_blank"
                                                                                   href="{{ route('pay.amount',[$booking->id]) }}">
                                                                                    <i class="fa fa-credit-card"></i>
                                                                                    Pay Amount
                                                                                </a>
                                                                            </li>
                                                                        @endcan
                                                                        @can('Manage Booking','Receipts')
                                                                            <li>
                                                                                <a
                                                                                    href="{{ route('booking.receipts',[$booking->id]) }}" target="_blank"><i class="fa fa-files-o"></i> Receipts</a>
                                                                            </li>
                                                                        @endcan
                                                                        @can('Manage Booking','Confirmation Sheet')
                                                                            <li>
                                                                                <a href="{{ route('confirmation.sheet',[$booking->id]) }}" target="_blank"><i class="fa fa-check"></i> Confirmation
                                                                                    Sheet</a>
                                                                            </li>
                                                                        @endcan
                                                                        @can('Manage Booking','Update Intiqal')
                                                                            <li>
                                                                                <a href="{{ route('update.inqtiqal',[$booking->id]) }}" target="_blank"><i class="fa fa-refresh"></i> Update
                                                                                    Intiqal
                                                                                </a>
                                                                            </li>
                                                                        @endcan
                                                                        @can('Manage Booking','Allotment Letter')
                                                                            <li>
                                                                                <a href="{{ route('allotment.letter',[$booking->id]) }}" target="_blank"><i class="fa fa-tasks"></i> Allotment
                                                                                    Letter</a>
                                                                            </li>
                                                                        @endcan
                                                                        <li>
                                                                            <a target="_blank"
                                                                               href="{{ route('print.card',[$booking->id]) }}">
                                                                                <i class="fa fa-id-card"></i>
                                                                                Print Card
                                                                            </a>
                                                                        </li>
                                                                    @else
                                                                        @can('Manage Booking','Update')
                                                                            <li>
                                                                                <a  target="_blank" href="{{ route('edit.booking',[$booking->id]) }}">
                                                                                    <i class="fa fa-edit"></i> Edit
                                                                                </a>
                                                                            </li>
                                                                        @endcan
                                                                        @can('Manage Booking','Delete')
                                                                            <li>
                                                                                <a   href="{{ route('delete.booking',[$booking->id]) }}">
                                                                                    <i class="fa fa-trash"></i> Delete
                                                                                </a>
                                                                            </li>
                                                                        @endcan
                                                                    @endif
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tr style="display: none;" id="notfound"><th colspan="10">No Data Found</th></tr>
                                        <tfoot>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>Customer Name</th>
                                            <th>Sector Name</th>
                                            <th>Block </th>
                                            <th>Plot #</th>
                                            <th>Contact#</th>
                                            <th>Agreed Price</th>
                                            <th>Received Amount</th>
                                            <th>Outstanding Recovery Till Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </table>
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
        const baseurl = "{{url('/')}}";
        $(document).ready(function () {
            //initialize the javascript
            App.dataTables();
            App.formElements();
        });

        $('body').on('click','.filter',function(){
            let project   = $('#project_id').val();
            let sector_id = $('#sectors').val();
            let customer  = $('#customer_id').val();

            $('#loading').css('display','inline');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var request    = $.ajax({
                url: "{{ route('filter.bookings') }}",
                method: "post",
                data: {_token: CSRF_TOKEN, project:project,sector_id:sector_id,customer:customer},
                dataType: "html"
            });
            request.done(function( msg ) {
                if(msg==1)
                {
                    $('#notfound').show();
                    $('#detail').html("");
                    $('#loading').css('display','none');
                }
                else
                {
                    $('#notfound').hide();
                    var data = JSON.parse(msg);
                    console.log(msg);
                    $('#detail').html(data.result);
                    $('#loading').css('display','none');
                }
                $('#table1').DataTable();
            });
        });
    </script>
    <script src="{{ asset('/assets/js/Master/master.js') }}"></script>
    <script type="text/javascript">
        $("body").on('click','.bookingApproved',function (){
            let bookingId  = $(this).attr('date-id');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var request    = $.ajax({
                url: "{{ route('admin.approved_booking') }}",
                method: "post",
                data: {_token: CSRF_TOKEN, bookingId:bookingId},
                dataType: "html"
            });
            request.done(function( msg ) {
                $('#bookingstatus'+bookingId).html(`<font style="color:green;">Approved</font>`);
                toastr.success("Booking Approved!");
            });
        });
    </script>
@endsection
