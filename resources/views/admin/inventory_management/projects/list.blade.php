@extends('admin.layouts.app',[
     'class' => '',
    'elementActive' => 'dashboard'
])
@section('content')
    <style type="text/css">

        .customModal{
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
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
                                <div class="panel-heading panel-heading-divider">Project's List<span class="panel-subtitle"></span></div>
                            </div>
                            <div class="col-md-3">

                            </div><div class="col-md-3">

                            </div><div class="col-md-3">
                                <div class="panel-heading panel-heading-divider">
                                    @if(\Auth::user()->role == 'Super Admin')
                                    <button data-toggle="modal" data-target="#form-bp1" type="button"  class="btn btn-primary  "><i class="fa fa-plus"></i> Create New Project</button>
                                    @else
                                    @can('Manage Projects','Create')
                                    <button data-toggle="modal" data-target="#form-bp1" type="button"  class="btn btn-primary  "><i class="fa fa-plus"></i> Create New Project</button>
                                    @endcan
                                    @endif

                                    <span class="panel-subtitle"></span></div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center>
                                    <h3>
                                        <b>Manage Projects</b>
                                    </h3>
                                </center>
                                <table id="table1" class="table table-striped table-hover table-fw-widget">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Project Name</th>
                                        <th>Total Sale Value</th>
                                        <th>% Sold Out</th>
                                        <th>Recovery</th>
                                        <th>Average Rate/House(Marla)</th>
                                        <th>Logo</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($projects as $project)
                                            <tr class="gradeC">
                                                <td>{{$counter++}}</td>
                                                <td>{{$project->name}}</td>
                                                <td>{{$project->location}}</td>
                                                <td>{{$project->description }}</td>
                                                <td>{{$project->status }}</td>
                                                <td><img @if($project->logo) src="{{ asset('/images') }}/{{ $project->logo }}" @endif style="border-radius: 180px;" width="60px" height="60px" alt="Logo"></td>
                                                <td>
                                                    @if(\Auth::user()->role == 'Super Admin')
                                                    <button data-toggle="modal" data-target="#edit{{ $project->id }}" type="button"  class="btn btn-sm btn-primary  "><i class="fa fa-edit"></i></button>
                                                    @else
                                                    @can('Manage Projects','Update')
                                                    <button data-toggle="modal" data-target="#edit{{ $project->id }}" type="button"  class="btn btn-sm btn-primary  "><i class="fa fa-edit"></i></button>
                                                    @endcan
                                                    @endif

                                                </td>
                                            </tr>
                                            <div id="edit{{ $project->id }}"  role="dialog" class="modal fade colored-header colored-header-primary">
                                                <div class="modal-dialog customModal">
                                                    <form class="user" action="{{route('save.project')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-content modal-lg">
                                                            <div class="modal-header">
                                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                                                                <h3 class="modal-title">Edit Project</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Choose Logo</label>
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <div class="form-input">
                                                                                <label for="file-ip-1">
                                                                                    <img id="file-ip-1-preview{{ $project->id }}" width="100" height="100" src="{{ asset('images') }}/{{ $project->logo }}" alt="">
                                                                                </label>
                                                                                <input type="file"  name="logo" id="file-ip-1{{ $project->id }}" accept="image/*" onchange="showPreviewOne(event,{{ $project->id }});">
                                                                                <input type="hidden" id="old_logo" name="old_logo" value="{{ $project->logo }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class=" row">
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Name</label>
                                                                        <input type="hidden" value="{{ $project->id }}" name="project_id">
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="name" value="{{ $project->name }}" placeholder="Project Name" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Location</label>
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="location" value="{{ $project->location }}" placeholder="Location" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class=" row">
                                                                    <div class="col-md-12">
                                                                        <label class="text-primary">Short Description</label>
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="description" value="{{ $project->description }}" placeholder="Description" class="form-control">
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Select Partner</label>
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">

                                                                            <select class="select2" name="partner_id">
                                                                                <option value="">Select Partner</option>
                                                                                @if($project->GetAssignPartner)
                                                                                    @foreach($partners as $partner)
                                                                                        <option  @if($project->GetAssignPartner->partner_id==$partner->id) selected @endif value="{{$partner->id}}">{{$partner->name}}</option>
                                                                                    @endforeach
                                                                                @else
                                                                                    @foreach($partners as $partner)
                                                                                        <option  value="{{$partner->id}}">{{$partner->name}}</option>
                                                                                    @endforeach
                                                                                @endif


                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Partnership Percentage</label>
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="number" name="percentage_hold" @if($project->GetAssignPartner)   value="{{ $project->GetAssignPartner->percentage_hold }}" @endif placeholder="Enter Percentage" class="form-control">
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
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Project Name</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Logo</th>
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
        <div class="modal-dialog customModal">
            <form class="user" action="{{route('save.project')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                        <h3 class="modal-title">Create Project</h3>
                    </div>
                    <div class="modal-body">
                        <div class=" row">
                            <div class="col-md-6">
                                <label class="text-primary">Name *</label>
                                <input type="hidden" value="0" name="project_id">
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Project Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">Location *</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="location" value="{{ old('location') }}" placeholder="Location" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class=" row">
                            <div class="col-md-6">
                                <label class="text-primary">Short Description</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="description" value="{{ old('description') }}" placeholder="Description" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">Upload Logo *</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="file" name="logo" value="{{ old('logo') }}" required class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-primary">Select Partner</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <select class="select2" name="partner_id">
                                        <option value="">Select Partner</option>
                                        @foreach($partners as $partner)
                                            <option value="{{$partner->id}}">{{$partner->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">Partnership Percentage</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="number" name="percentage_hold" value="{{ old('percentage_hold') }}" placeholder="Enter Percentage" class="form-control">
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
        });
        function showPreviewOne(event,id){
            if(event.target.files.length > 0){
                let src = URL.createObjectURL(event.target.files[0]);
                let preview = document.getElementById("file-ip-1-preview"+id);
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection

