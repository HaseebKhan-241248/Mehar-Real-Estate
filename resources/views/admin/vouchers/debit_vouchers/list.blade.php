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
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel-heading panel-heading-divider">Debit Vouchers's List
                                    <span class="panel-subtitle"></span>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="panel-heading panel-heading-divider">
                                    @if(\Auth::user()->role == 'Super Admin')
                                        <a  href="{{ route('create.debit_voucher') }}"  class="btn btn-primary btn-sm  ">
                                            <i class="fa fa-plus"></i>
                                            Create New
                                        </a>
                                    @else
                                        @can('Debit Voucher','Create')
                                            <a  href="{{ route('create.debit_voucher') }}"  class="btn btn-primary btn-sm  ">
                                                <i class="fa fa-plus"></i>
                                                Create New
                                            </a>
                                        @endcan
                                    @endif

                                    <span class="panel-subtitle"></span></div>
                            </div>
                        </div>


                        <div class="panel-body">
                            <div class="p-2">
                                <center><h3><b>Manage Debit Vouchers</b></h3></center>
                                <table id="table1" class="table table-striped table-hover table-fw-widget">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Voucher#</th>
                                        <th>Voucher Date</th>
                                        <th>Particulars</th>
                                        <th>Total Amount</th>
                                        <th>Is Posted</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tobdy>
                                        @foreach($vouchers as $voucher)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
                                                <td>{{ $voucher->voucher_no }}</td>
                                                <td>{{ $voucher->day }}</td>
                                                <td>{{ $voucher->particulars }}</td>
                                                <td>{{ number_format($voucher->total,2) }}</td>
                                                <td>
                                                    @if($voucher->is_posted=="1")
                                                        Posted
                                                    @else
                                                        Pending
                                                    @endif
                                                </td>
                                                <td>
                                                    @if((Auth::user()->role)=="Super Admin")
                                                        <a href="{{ route('edit.debit_voucher',[$voucher->id]) }}" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        @if($voucher->is_posted!="1")
                                                            <a href="{{ route('delete.debit_voucher',[ $voucher->id ]) }}" onclick="return confirm('Are You Sure You want to Delete This?');" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        @endif
                                                    @else
                                                        @can('Debit Voucher','Update')
                                                            <a href="{{ route('edit.debit_voucher',[$voucher->id]) }}" class="btn btn-primary btn-sm">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @can('Debit Voucher','Delete')
                                                            @if($voucher->is_posted!="1")
                                                                <a href="{{ route('delete.debit_voucher',[ $voucher->id ]) }}" onclick="return confirm('Are You Sure You want to Delete This?');" class="btn btn-danger btn-sm">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            @endif
                                                        @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tobdy>
                                    <tfoot>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Voucher#</th>
                                        <th>Voucher Date</th>
                                        <th>Particulars</th>
                                        <th>Total Amount</th>
                                        <th>Is Posted</th>
                                        <th>Actions</th>
                                    </tr>
                                    </tfoot>
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
            App.formElements();

            $(".select2").select2({
                width: '100%'
            });
        });
    </script>
@endsection

