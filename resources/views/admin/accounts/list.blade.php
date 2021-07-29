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
                        <div class="panel-heading panel-heading-divider">Account's List<span class="panel-subtitle"></span></div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center><h3><b>Manage Accounts</b></h3></center>
                                <table id="table1" class="table table-striped table-hover table-fw-widget">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Project Name</th>
                                        <th>Account Name</th>
                                        <th>Account Type</th>
                                        <th>Sub Account type</th>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                   <tobdy>
                                       @foreach($accounts as $account)
                                       <tr class="gradeC">
                                           <td>{{$counter++}}</td>
                                           <td>@if($account->Project_Name) {{$account->Project_Name->name}} @endif</td>
                                           <td>{{$account->account_name}}</td>
                                           <td>{{$account->account_type}}</td>
                                           <td>{{$account->sub_account_type}}</td>
                                           <td>{{$account->description}}</td>
                                           <td>{{$account->type}}</td>
                                           <td>
                                               <a href="{{ route('edit.account',[$account->id]) }}" class="btn btn-primary btn-sm">
                                                   <i class="fa fa-edit"></i>
                                               </a>
                                           </td>
                                       </tr>
                                       @endforeach
                                   </tobdy>
                                    <tfoot>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Project Name</th>
                                        <th>Account Name</th>
                                        <th>Account Type</th>
                                        <th>Sub Account type</th>
                                        <th>Description</th>
                                        <th>Type</th>
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
        });
    </script>
@endsection

