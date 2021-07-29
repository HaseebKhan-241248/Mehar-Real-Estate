@extends('admin.layouts.app')
@section('content')
    <style type="text/css">
        .custoMargin{
            margin-left: 108px !important;
        }
    </style>
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
                                <div class="panel-heading panel-heading-divider">Manage Plot Sizes <small>(Marla)</small><span class="panel-subtitle"></span></div>
                            </div>
                            <div class="col-md-3">

                            </div><div class="col-md-3">

                            </div><div class="col-md-3">
                                <div class="panel-heading panel-heading-divider">
                                    @if((Auth::user()->role) =='Super Admin')
                                    <button data-toggle="modal" data-target="#form-bp1" type="button"  class="btn btn-primary  ">
                                        <i class="fa fa-plus"></i> Add New Plot Size (Marla)
                                    </button>
                                    @else
                                    @can('Add Plot Marla','Create')
                                    <button data-toggle="modal" data-target="#form-bp1" type="button"  class="btn btn-primary  ">
                                        <i class="fa fa-plus"></i> Add New Plot Size (Marla)
                                    </button>
                                    @endcan
                                    @endif
                                    <span class="panel-subtitle"></span></div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center><h3><b>Manage Plot Sizes</b></h3></center>
                                <table id="table1" class="table table-striped table-hover table-fw-widget">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th> Plot Size <small>(Marla)</small></th>     <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tobdy>
                                        @foreach($marlas as $marla)
                                            <tr class="gradeC">
                                                <td>{{$counter++}}</td>
                                                <td>{{$marla->marla}}-Marla</td>
                                                <td>{{$marla->description}}</td>
                                                <td>
                                                    @if((Auth::user()->role) == 'Super Admin')
                                                    <button data-toggle="modal" data-target="#edit{{ $marla->id }}" type="button"  class="btn btn-sm btn-primary  ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    @else
                                                    @can('Add Plot Marla','Update')
                                                    <button data-toggle="modal" data-target="#edit{{ $marla->id }}" type="button"  class="btn btn-sm btn-primary  ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                            <div id="edit{{ $marla->id }}" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
                                                <div class="modal-dialog custom-width">
                                                    <form class="user" action="{{route('save.marla')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                                                                <h3 class="modal-title">Edit Plot Sizes</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="text-primary">Name</label>
                                                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                        <input type="hidden" value="{{ $marla->id }}" name="marla_id">
                                                                        <input type="" name="marla" value="{{ $marla->marla }}" placeholder="" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="text-primary">Short Description</label>
                                                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                        <input type="text" name="description" value="{{ $marla->description }}" placeholder="Description" class="form-control">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
                                                                <button   class="btn btn-primary ">Update</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tobdy>
                                    <tfoot>
                                    <tr>
                                        <th>Sr#</th>
                                        <th> Plot Size <small>(Marla)</small></th>
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
    <div id="form-bp1"  role="dialog" class="modal fade colored-header colored-header-primary">
        <div class="modal-dialog custom-width">
            <form class="user" action="{{route('save.marla')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                        <h3 class="modal-title">Add New Plot Size</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="text-primary">Name</label>
                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                <input type="hidden" value="0" name="marla_id">
                                <input type="" name="marla" value="{{ old('marla') }}" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="text-primary">Short Description</label>
                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                <input type="text" name="description" value="{{ old('description') }}" placeholder="Description" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
                        <button   class="btn btn-primary ">Save</button>
                    </div>
                </div>
            </form>
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

