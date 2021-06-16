@extends('admin.layouts.app')
@section('content')
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
                    <div class="panel-heading panel-heading-divider">Booking's List<span class="panel-subtitle"></span>
                    </div>
                    <div class="panel-body">
                        <div class="p-2">
                            <center>
                                <h3><b>Manage Bookings</b></h3>
                            </center>
                            <div class="table-responsive">
                                <table id="table1" class="table table-striped table-hover table-fw-widget">
                                    <thead>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>Booking Day</th>
                                            <th>Project/Sector/Block/Plot</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Customer Name</th>
                                            <th>Dealer Name</th>
                                            <th>Intiqal (G)</th>
                                            <th>Intiqal (A)</th>
                                            <th>Intiqal (Diff)</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tobdy>
                                        @foreach($bookings as $booking)
                                        <tr class="gradeC">
                                            <td>{{$counter++}}</td>
                                            <td>{{\Carbon\Carbon::parse($booking->day)->format('d M Y')}}</td>
                                            <td>
                                                <b>Project Name: </b>
                                                @if($booking->Project_Name)
                                                {{$booking->Project_Name->name}}
                                                @endif
                                                <br>
                                                <b>Sector: </b>
                                                @if($booking->Sector_Name)
                                                {{$booking->Sector_Name->name}}
                                                @endif
                                                <br>
                                                <b>Block Name: </b>
                                                @if($booking->Block_Name)
                                                {{$booking->Block_Name->name}}
                                                @endif
                                                <br>
                                                <b>Plot: </b>
                                                @if($booking->Plot_Name)
                                                {{$booking->Plot_Name->name}}
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($booking->start_date)->format(' d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($booking->end_date)->format(' d M Y') }}</td>
                                            <td>
                                                @if($booking->Customer_Name)
                                                {{$booking->Customer_Name->name}}
                                                @endif</td>
                                            <td>
                                                @if($booking->Dealer_Name)
                                                {{$booking->Dealer_Name->name}}
                                                @endif
                                            </td>
                                            <td>{{$booking->intiqal_g}}</td>
                                            <td>{{$booking->intiqal_a}}</td>
                                            <td>{{$booking->intiqal_diff}}</td>
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
                                                            <a data-toggle="modal" data-target="#edit{{ $booking->id }}"
                                                                href="#">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                        </li>
                                                        
                                                        <li>
                                                            <a target="_blank"
                                                                href="{{ route('application.form',[$booking->id]) }}">Application Form</a>
                                                        </li>
                                                        <li>
                                                            <a target="_blank"
                                                                href="{{ route('plot.detail',[$booking->id]) }}">Payment
                                                                Schedule</a>
                                                        </li>
                                                        <li>
                                                            <a target="_blank"
                                                                href="{{ route('pay.amount',[$booking->id]) }}">Pay
                                                                Amount</a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                href="{{ route('booking.receipts',[$booking->id]) }}">Receipts</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('confirmation.sheet',[$booking->id]) }}">Confirmation
                                                                Sheet</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('update.inqtiqal',[$booking->id]) }}">Update
                                                                Intiqal 
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('allotment.letter',[$booking->id]) }}">Allotment
                                                                Letter</a>
                                                        </li>

                                                        {{-- ////// else if part ///////////// --}}
                                                        @elseif((Auth::user()->role)=="GM")
                                                        <li>
                                                            <a  href="{{ route('approved.booking',[$booking->id]) }}">
                                                                Booking Approved
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a target="_blank"
                                                                href="{{ route('plot.detail',[$booking->id]) }}">Payment
                                                                Schedule</a>
                                                        </li>
                                                        
                                                        <li>
                                                            <a href="{{ route('confirmation.sheet',[$booking->id]) }}">Confirmation
                                                                Sheet</a>
                                                        </li>
                                                        
                                                        <li>
                                                            <a href="{{ route('allotment.letter',[$booking->id]) }}">Allotment
                                                                Letter
                                                            </a>
                                                        </li>
                                     {{-- else part from here                                                         --}}
                                                        @else
                                                        @if($booking->status==1)
                                                        @can('Manage Booking','Update')
                                                        <li>
                                                            <a data-toggle="modal" data-target="#edit{{ $booking->id }}"
                                                                href="#">Edit
                                                            </a>
                                                        </li>
                                                        @endcan
                                                        @can('Manage Booking','Payment Schedule')
                                                        <li>
                                                            <a target="_blank"
                                                                href="{{ route('plot.detail',[$booking->id]) }}">Payment
                                                                Schedule</a>
                                                        </li>
                                                        @endcan
                                                        @can('Manage Booking','Pay Amount')
                                                        <li>
                                                            <a target="_blank"
                                                                href="{{ route('pay.amount',[$booking->id]) }}">Pay
                                                                Amount</a>
                                                        </li>
                                                        @endcan
                                                        @can('Manage Booking','Receipts')
                                                        <li>
                                                            <a
                                                                href="{{ route('booking.receipts',[$booking->id]) }}">Receipts</a>
                                                        </li>
                                                        @endcan
                                                        @can('Manage Booking','Confirmation Sheet')
                                                        <li>
                                                            <a href="{{ route('confirmation.sheet',[$booking->id]) }}">Confirmation
                                                                Sheet</a>
                                                        </li>
                                                        @endcan
                                                        @can('Manage Booking','Update Intiqal')
                                                        <li>
                                                            <a href="{{ route('update.inqtiqal',[$booking->id]) }}">Update
                                                                Intiqal </a>
                                                        </li>
                                                        @endcan
                                                        @can('Manage Booking','Allotment Letter')
                                                        <li>
                                                            <a href="{{ route('allotment.letter',[$booking->id]) }}">Allotment
                                                                Letter</a>
                                                        </li>
                                                        @endcan
                                                      @endif
                                                     @endif


                                                    </ul> 
                                                   
                                                  
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tobdy>
                                    <tfoot>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>Booking Day</th>
                                            <th>Project/Sector/Block/Plot</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Customer Name</th>
                                            <th>Dealer Name</th>
                                            <th>Intiqal (G)</th>
                                            <th>Intiqal (A)</th>
                                            <th>Intiqal (Diff)</th>
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
    $(document).ready(function () {
        //initialize the javascript
        // App.init();
        App.dataTables();
    });

</script>
@endsection
