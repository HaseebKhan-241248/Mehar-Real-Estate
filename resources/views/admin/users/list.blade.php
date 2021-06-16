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
                            <div class="panel-heading panel-heading-divider">User's List
                                <span class="panel-subtitle"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <div class="panel-heading panel-heading-divider">
                                @if(\Auth::user()->role=='Super Admin')
                                <a href="{{ route('create.user') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i> Add New User
                                </a>
                                @else
                                @can('Manage Users','Create')
                                <a href="{{ route('create.user') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i> Add New User
                                </a>
                                @endcan
                                @endif

                                <span class="panel-subtitle"></span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="p-2">
                            <center>
                                <h3>
                                    <b>Manage Users</b>
                                </h3>
                            </center>
                            <table id="table1" class="table table-striped table-hover table-fw-widget">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>CNIC</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->cnic }}</td>
                                        <td>
                                            @if(\Auth::user()->role=='Super Admin')
                                            <a href="{{ route('edit.user' ,[ $user->id ]) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            @else
                                            @can('Manage Users','Update')
                                            <a href="{{ route('edit.user' ,[ $user->id ]) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @endcan
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>CNIC</th>
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
    $(document).ready(function () {
        //initialize the javascript
        // App.init();
        App.dataTables();
        App.formElements();
    });
    var baseurl = "{{url('/')}}";
    $('#project_id').select2({
        dropdownParent: $('#form-bp1')
    });

</script>
<script src="{{ asset('/assets/js/Master/master.js') }}"></script>
@endsection
