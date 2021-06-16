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
                                <div class="panel-heading panel-heading-divider">Sector's List<span class="panel-subtitle"></span></div>
                            </div>
                            <div class="col-md-3">
                            </div><div class="col-md-3">
                            </div><div class="col-md-3">
                                <div class="panel-heading panel-heading-divider">
                                    @if(\Auth::user()->role == 'Super Admin')
                                    <button data-toggle="modal" data-target="#form-bp1" type="button"  class="btn btn-primary  "><i class="fa fa-plus"></i> Create New Sector</button>
                                    @else
                                    @can('Manage Sectors','Create')
                                    <button data-toggle="modal" data-target="#form-bp1" type="button"  class="btn btn-primary  "><i class="fa fa-plus"></i> Create New Sector</button>
                                    @endcan
                                    @endif
                                    
                                    <span class="panel-subtitle"></span></div>
                            </div>
                        </div>


                        <div class="panel-body">
                            <div class="p-2">
                                <center><h3><b>Manage Sectors</b></h3></center>
                                <table id="table1" class="table table-striped table-hover table-fw-widget">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Project</th>
                                        <th>Sector Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tobdy>
                                        @foreach($sectors as $sector)
                                            <tr class="gradeC">
                                                <td>{{$counter++}}</td>
                                                <td>@if($sector->ProjectName){{$sector->ProjectName->name}}@endif</td>
                                                <td>{{$sector->name}}</td>
                                                <td>{{$sector->description}}</td>
                                                <td>
                                                    @if(\Auth::user()->role == 'Super Admin')
                                                    <button data-toggle="modal" data-target="#edit{{ $sector->id }}" type="button"  class="btn btn-sm btn-primary  "><i class="fa fa-edit"></i></button>
                                                    @else
                                                    @can('Manage Sectors','Update')
                                                    <button data-toggle="modal" data-target="#edit{{ $sector->id }}" type="button"  class="btn btn-sm btn-primary  "><i class="fa fa-edit"></i></button>
                                                    @endcan
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                            <div id="edit{{ $sector->id }}"  role="dialog" class="modal fade colored-header colored-header-primary">
                                                <div class="modal-dialog custom-width">
                                                    <form class="user" action="{{route('save.sector')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                                                                <h3 class="modal-title">Edit Sector</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class=" row">
                                                                    <div class="col-md-12">
                                                                        <label class="text-primary">Select Project</label>
                                                                        <select name="project_id" id="" class="select2" required>
                                                                            <option value="">Select One</option>
                                                                            @foreach($projects as $project)
                                                                                <option @if($sector->project_id==$project->id) selected @endif value="{{ $project->id }}">{{ $project->name }} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class=" row">
                                                                    <div class="col-md-12">
                                                                        <label class="text-primary">Sector</label>
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="hidden" value="{{ $sector->id }}" name="sector_id">
                                                                            <input type="text" name="name" value="{{ $sector->name }}" placeholder="Sector Name" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class=" row">
                                                                    <div class="col-md-12">
                                                                        <label class="text-primary">Description</label>
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="description" value="{{ $sector->description }}" placeholder="Description" class="form-control">
                                                                        </div>
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
                                        <th>Project</th>
                                        <th>Sector Name</th>
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
            <form class="user" action="{{route('save.sector')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                        <h3 class="modal-title">Create Sector</h3>
                    </div>
                    <div class="modal-body">
                        <div class=" row">
                            <div class="col-md-12">
                                <label class="text-primary">Select Project</label>
                                <select name="project_id" id="" class="select2" required>
                                    <option value="">Select One</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-md-12">
                                <label class="text-primary">Sector</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="hidden" value="0" name="sector_id">
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Sector Name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-md-12">
                                <label class="text-primary">Description</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="description" value="{{ old('description') }}" placeholder="Description" class="form-control">
                                </div>
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
            App.formElements();

            $(".select2").select2({
                width: '100%'
            });
        });
    </script>
@endsection

