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
                            <div class="col-md-4">
                                <div class="panel-heading panel-heading-divider">Sub Account Type Category's List</div>
                            </div>
                            <div class="col-md-5"></div>
                            <div class="col-md-3">

                                <div class="panel-heading panel-heading-divider pull-right">
                                <a href="{{ route('create.subaccount_category') }}" class="btn btn-primary btn-sm "><i class="fa fa-plus"></i> Create New</a>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="p-2">
                                <center><h3><b>Manage Sub Account Type Categories</b></h3></center>
                                <table id="table1" class="table table-striped table-hover table-fw-widget">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Account Type</th>
                                        <th>Sub Account Type</th>
                                        <th>Sub Account Category</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tobdy>
                                        @foreach($categories as $category)
                                            <tr class="gradeC">
                                                <td>{{$counter++}}</td>
                                                <td>{{$category->account_type}}</td>
                                                <td>{{$category->sub_account_type}}</td>
                                                <td>{{$category->sub_account_category}}</td>
                                                <td>{{$category->description}}</td>
                                                <td>
                                                    @if((Auth::user()->role)=="Super Admin")
                                                        <a href="{{ route('account.editsubcategory',[ $category->id ]) }}"  class="btn btn-primary btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('delete.subaccount_category',[ $category->id ]) }}" onclick="return confirm('Are you sure you want to delete this?');" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    @else
                                                        @can('Add Sub Account Category','Update')
                                                            <a href="{{ route('account.editsubcategory',[ $category->id ]) }}"  class="btn btn-primary btn-sm">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @can('Add Sub Account Category','Delete')
                                                                <a href="{{ route('delete.subaccount_category',[ $category->id ]) }}" onclick="return confirm('Are you sure you want to delete this?');" class="btn btn-danger btn-sm">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            @endcan

                                                        @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tobdy>
                                    <tfoot>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Account Type</th>
                                        <th>Sub Account Type</th>
                                        <th>Sub Account Category</th>
                                        <th>Description</th>
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

