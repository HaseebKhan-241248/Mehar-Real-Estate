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
                                <div class="panel-heading panel-heading-divider">Block's List<span class="panel-subtitle"></span></div>
                            </div>
                            <div class="col-md-3">
                            </div><div class="col-md-3">
                            </div><div class="col-md-3">
                                <div class="panel-heading panel-heading-divider">
                                    @if(\Auth::user()->role == 'Super Admin')
                                    <button data-toggle="modal" data-target="#form-bp1" type="button"  class="btn btn-primary  "><i class="fa fa-plus"></i> Create New Block</button>
                                    @else
                                    @can('Manage Blocks','Create')
                                    <button data-toggle="modal" data-target="#form-bp1" type="button"  class="btn btn-primary  "><i class="fa fa-plus"></i> Create New Block</button>
                                    @endcan
                                    @endif
                                    
                                    <span class="panel-subtitle"></span></div>
                            </div>
                        </div>


                        <div class="panel-body">
                            <div class="p-2">
                                <center><h3><b>Manage Blocks</b></h3></center>
                                <table id="table1" class="table table-striped table-hover table-fw-widget">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Project Name</th>
                                        <th>Sector Name</th>
                                        <th>Block Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tobdy>
                                        <?php $count=0; ?>
                                        @foreach($blocks as $block)
                                            <tr class="gradeC">
                                                <td>{{$counter++}}</td>
                                                <td>@if($block->ProjectName){{$block->ProjectName->name}}@endif</td>
                                                <td>@if($block->SectorName){{$block->SectorName->name}}@endif</td>
                                                <td>{{$block->name}}</td>
                                                <td>{{$block->description}}</td>
                                                <td>
                                                    @if(\Auth::user()->role == 'Super Admin')
                                                    <button data-toggle="modal" data-target="#edit{{ $block->id }}" type="button"  class="btn btn-sm btn-primary  "><i class="fa fa-edit"></i></button>
                                                    @else
                                                    @can('Manage Blocks','Update')
                                                    <button data-toggle="modal" data-target="#edit{{ $block->id }}" type="button"  class="btn btn-sm btn-primary  "><i class="fa fa-edit"></i></button>
                                                    @endcan
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                            <div id="edit{{ $block->id }}"  role="dialog" class="modal fade colored-header colored-header-primary">
                                                <div class="modal-dialog custom-width">
                                                    <form class="user" action="{{route('save.block')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                                                                <h3 class="modal-title">Edit Block</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class=" row">
                                                                    <div class="col-md-12">
                                                                        <label class="text-primary">Select Project</label>
                                                                        <select name="project_id" id="" onchange="getSectorsedit(this.value,{{ $count }})" class=" select2" required>
                                                                            <option value="">Select One</option>
                                                                            @foreach($projects as $project)
                                                                                <option  @if($block->project_id==$project->id) selected @endif value="{{ $project->id }}">{{ $project->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class=" row">

                                                                    <div class="col-md-12">
                                                                        <label class="text-primary">Select Sector</label>
                                                                        <select name="sector_id" id="sectors{{$count}}" class="select2" required>
                                                                            <option value="">Select Sector</option>
                                                                            @foreach($sectors as $sector)
                                                                                <option @if($block->sector_id==$sector->id) selected @endif value="{{ $sector->id }}">{{ $sector->name }} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class=" row">
                                                                    <div class="col-md-12">
                                                                        <label class="text-primary">Block</label>
                                                                        <input type="hidden" value="{{ $block->id }}" name="block_id">
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="name" value="{{ $block->name }}" placeholder="Block Name" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class=" row">
                                                                    <div class="col-md-12">
                                                                        <label class="text-primary">Description</label>
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="description" value="{{ $block->description }}" placeholder="Description" class="form-control">
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
                                            <?php $count++; ?>
                                        @endforeach
                                    </tobdy>
                                    <tfoot>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Project Name</th>
                                        <th>Sector Name</th>
                                        <th>Block Name</th>
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
    <div id="form-bp1" role="dialog" class="modal fade colored-header colored-header-primary">
        <div class="modal-dialog custom-width">
            <form class="user" action="{{route('save.block')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                        <h3 class="modal-title">Create Block</h3>
                    </div>
                    <div class="modal-body">
                        <div class=" row">
                            <div class="col-md-12">
                                <label class="text-primary">Select Project</label>
                                <select name="project_id" id="project_id" onchange="getSectors(this.value)" class="select2 select2modal" required>
                                    <option value="">Select One</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-md-12">
                                <label class="text-primary">Select Sector</label>
                                <select name="sector_id" id="sectors" class="select2 " required>
                                    <option value="">Select Sector</option>

                                </select>
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-md-12">
                                <label class="text-primary">Block</label>
                                <input type="hidden" value="0" name="block_id">
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Block Name" class="form-control">
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
        });
        var baseurl = "{{url('/')}}";
        $('#project_id').select2({
            dropdownParent: $('#form-bp1')
        });
    </script>
    <script src="{{ asset('/assets/js/Master/master.js') }}" ></script>
@endsection

