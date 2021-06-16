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
                        <div class="panel-heading panel-heading-divider">Receipt's List
                            <span class="panel-subtitle"></span>
                        </div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center>
                                    <h3>
                                        <b>Manage Receipts</b>
                                    </h3>
                                </center>
                                <table id="table1" class="table table-striped table-hover table-fw-widget">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Date</th>
                                        <th>Receipt#</th>
                                        <th>Booking#</th>
                                        <th>Customer Name</th>
                                        <th>Receipt Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tobdy>
                                        @foreach($receipts as $receipt)
                                            <tr class="gradeC">
                                                <td>{{$counter++}}</td>
                                                <td>{{\Carbon\Carbon::parse($receipt->day)->format('d M Y')}}</td>
                                                <td>{{ $receipt->id }}</td>
                                                <td>{{ $receipt->booking_id }}</td>
                                                <td>
                                                    @if($booking->Customer_Name)
                                                        {{$booking->Customer_Name->name}}
                                                    @endif
                                                </td>
                                                <td>{{ number_format($receipt->amount) }}</td>
                                                <td>
                                                    <a target="_blank" href="{{ route('receipt.view', [ $receipt->id ]) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tobdy>
                                    <tfoot>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Date</th>
                                        <th>Receipt#</th>
                                        <th>Booking#</th>
                                        <th>Customer Name</th>
                                        <th>Receipt Amount</th>
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
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            //initialize the javascript
            // App.init();
            App.dataTables();
        });
    </script>
@endsection

