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
                            <div class="panel-heading panel-heading-divider">Plot's List<span
                                    class="panel-subtitle"></span></div>
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <div class="panel-heading panel-heading-divider">
                                @if(\Auth::user()->role == 'Super Admin')
                                <button data-toggle="modal" data-target="#form-bp1" type="button"
                                    class="btn btn-primary  "><i class="fa fa-plus"></i> Add New Plot</button>
                                @else
                                @can('Manage Plots','Create')
                                <button data-toggle="modal" data-target="#form-bp1" type="button"
                                    class="btn btn-primary  "><i class="fa fa-plus"></i> Add New Plot</button>
                                @endcan
                                @endif

                                <span class="panel-subtitle"></span>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="p-2">
                            <center>
                                <h3><b>Manage Plots</b></h3>
                            </center>
                            <table id="table1" class="table table-striped table-hover table-fw-widget">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Project </th>
                                        <th>Sector </th>
                                        <th>Block</th>
                                        <th>Plot#</th>
                                        <th>Marla</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tobdy>
                                    <?php $count=0; ?>
                                    @foreach($plots as $plot)
                                    <tr class="gradeC">
                                        <td>{{$counter++}}</td>
                                        <td>@if($plot->ProjectName){{$plot->ProjectName->name}}@endif</td>
                                        <td>@if($plot->SectorName){{$plot->SectorName->name}}@endif</td>
                                        <td>@if($plot->BlockName){{$plot->BlockName->name}}@endif</td>
                                        <td>{{$plot->name}}</td>
                                        <td>@if($plot->MarlaSize){{$plot->MarlaSize->marla}}@endif</td>
                                        <td>{{$plot->description}}</td>
                                        <td>
                                            @if(\Auth::user()->role == 'Super Admin')
                                            <button data-toggle="modal" data-target="#edit{{ $plot->id }}" type="button"
                                                class="btn btn-sm btn-primary  "><i class="fa fa-edit"></i></button>
                                            @else
                                            @can('Manage Plots','Update')
                                            <button data-toggle="modal" data-target="#edit{{ $plot->id }}" type="button"
                                                class="btn btn-sm btn-primary  "><i class="fa fa-edit"></i></button>
                                            @endcan
                                            @endif


                                            <!--   <div class="input-group-btn">
                                                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Actions <span class="caret"></span></button>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a data-toggle="modal" data-target="#edit{{ $plot->id }}" href="#" >Edit</a></li>
                                                        </ul>
                                                    </div> -->
                                        </td>
                                    </tr>
                                    <div id="edit{{ $plot->id }}" role="dialog"
                                        class="modal fade colored-header colored-header-primary">
                                        <div class="modal-dialog customModal">
                                            <form class="user" action="{{route('save.plot')}}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-content modal-lg">
                                                    <div class="modal-header">
                                                        <button type="button" data-dismiss="modal" aria-hidden="true"
                                                            class="close md-close"><span
                                                                class="mdi mdi-close"></span></button>
                                                        <h3 class="modal-title">Edit Plot</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class=" row">
                                                            <div class="col-md-6">
                                                                <label class="text-primary">Select Project</label>
                                                                <select name="project_id" id=""
                                                                    onchange="getSectorsedit(this.value,{{ $count }})"
                                                                    class=" select2" required>
                                                                    <option value="">Select One</option>
                                                                    @foreach($projects as $project)
                                                                    <option @if($plot->project_id==$project->id)
                                                                        selected @endif
                                                                        value="{{ $project->id }}">{{ $project->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="text-primary">Select Sector</label>
                                                                <select name="sector_id"
                                                                    onchange="getBlocksedit(this.value,{{ $count}})"
                                                                    id="sectors{{ $count}}" class="select2" required>
                                                                    @foreach($sectors as $sector)
                                                                    <option @if($plot->sector_id==$sector->id) selected
                                                                        @endif
                                                                        value="{{ $sector->id }}">{{ $sector->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="col-md-6">
                                                                <label class="text-primary">Select Block</label>
                                                                <select name="block_id" id="block_id{{$count}}"
                                                                    class="select2" required>
                                                                    @foreach($blocks as $block)
                                                                    <option @if($plot->block_id==$block->id) selected
                                                                        @endif value="{{ $block->id}}">{{$block->name}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="text-primary">Select Marla</label>
                                                                <select name="marla_id" id="" class="select2" required>
                                                                    <option value="">Select Marla</option>
                                                                    @foreach($sizes as $marla)
                                                                    <option @if($plot->marla_id==$marla->id) selected
                                                                        @endif value="{{$marla->id}}">{{$marla->marla}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="col-md-6">
                                                                <label class="text-primary">Plot No.</label>
                                                                <div
                                                                    class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                    <input type="hidden" value="{{ $plot->id }}"
                                                                        name="plot_id">
                                                                    <input type="text" name="name"
                                                                        value="{{ $plot->name }}" placeholder="Plot No."
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="text-primary">Description</label>
                                                                <div
                                                                    class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                    <input type="text" name="description"
                                                                        value="{{ $plot->description }}"
                                                                        placeholder="Description" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" data-dismiss="modal"
                                                            class="btn btn-default md-close">Cancel</button>
                                                        <button class="btn btn-primary ">Update</button>
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
                                        <th>Project </th>
                                        <th>Sector </th>
                                        <th>Block</th>
                                        <th>Plot#</th>
                                        <th>Marla</th>
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
    <div class="modal-dialog customModal">
        <form class="user" action="{{route('save.plot')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span
                            class="mdi mdi-close"></span></button>
                    <h3 class="modal-title">Add New Plot</h3>
                </div>
                <div class="modal-body">
                    <div class=" row">
                        <div class="col-md-6">
                            <label class="text-primary">Select Project</label>
                            <select name="project_id" id="" onchange="getSectors(this.value)" class="select2" required>
                                <option value="">Select One</option>
                                @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="text-primary">Select Sector</label>
                            <select name="sector_id" onchange="getBlocks(this.value)" id="sectors" class="select2"
                                required>
                                <option value="">Select Sector</option>

                            </select>
                        </div>
                    </div>
                    <div class=" row">
                        <div class="col-md-6">
                            <label class="text-primary">Select Block</label>
                            <select name="block_id" id="block_id" class="select2" required>
                                <option value="">Select Block</option>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="text-primary">Select Marla</label>
                            <select name="marla_id" id="" class="select2" required>
                                <option value="">Select Marla</option>
                                @foreach($sizes as $marla)
                                <option value="{{$marla->id}}">{{$marla->marla}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class=" row">
                        <div class="col-md-6">
                            <label class="text-primary">Plot No.</label>
                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                <input type="hidden" value="0" name="plot_id">
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Plot No."
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-primary">Description</label>
                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                <input type="text" name="description" value="{{ old('description') }}"
                                    placeholder="Description" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
                    <button class="btn btn-primary ">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        App.dataTables();
        App.formElements();
    });
    var baseurl = "{{url('/')}}";

</script>
<script src="{{ asset('/assets/js/Master/master.js') }}"></script>
@endsection
