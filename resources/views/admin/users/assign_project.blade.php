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
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center>
                                    <h3>
                                        <b>Assign Project </b>
                                    </h3>
                                </center>
                            </div>
                            <br>
                            <form action="{{ route('save.assign_project') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="" class="text-primary">Select User</label>
                                        <select name="user_id"  id="" class="select2">
                                            <option value="">Select User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for=""  class="text-primary">Select Project</label>
                                        <select name="project_id"   id="" class="select2">
                                            <option value="">Select Project</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <br><br>
                                        <button class="btn btn-primary btn-sm">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-body">
                            <h2 class="text-center text-primary bg-primary " style="padding: 10px;">Projects Assigned</h2>
                            <table class="table table-bordered dataTable" id="table1">
                                <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>User Name</th>
                                    <th>Project Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            @if($user->Project_Name)
                                                {{ $user->Project_Name->name }}
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="3">No Data Found</th>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
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
            App.dataTables();
            App.formElements();
        });
        var baseurl = "{{url('/')}}";
    </script>
    <script src="{{ asset('/assets/js/Master/master.js') }}"></script>
@endsection
