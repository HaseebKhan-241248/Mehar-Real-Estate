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
                                <div class="panel-heading panel-heading-divider">Partner's List<span class="panel-subtitle"></span></div>
                            </div>
                            <div class="col-md-3">

                            </div><div class="col-md-3">

                            </div><div class="col-md-3">
                                <div class="panel-heading panel-heading-divider">
                                    @if(\Auth::user()->role == 'Super Admin')
                                    <button data-toggle="modal" data-target="#form-bp1" type="button"  class="btn btn-primary  ">
                                        <i class="fa fa-plus"></i> Add New Partner
                                    </button>
                                    @else
                                    @can('Manage Partners','Create')
                                    <button data-toggle="modal" data-target="#form-bp1" type="button"  class="btn btn-primary  ">
                                        <i class="fa fa-plus"></i> Add New Partner
                                    </button>
                                    @endcan
                                    @endif
                                   
                                    <span class="panel-subtitle"></span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center><h3><b>Manage Partners</b></h3></center>
                                <table id="table1" class="table table-striped table-hover table-fw-widget">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Project Name</th>
                                        <th>Partner Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone#1</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tobdy>
                                        @foreach($partners as $partner)
                                            <tr class="gradeC">
                                                <td>{{$counter++}}</td>
                                                <td>@if($partner->Project_Name){{ $partner->Project_Name->name }}@endif</td>
                                                <td>{{$partner->name}}</td>
                                                <td>{{$partner->email}}</td>
                                                <td>{{$partner->address }}</td>
                                                <td>{{$partner->phone1 }}</td>
                                                <td>
                                                    @if(\Auth::user()->role == 'Super Admin')
                                                    <button data-toggle="modal" data-target="#edit{{ $partner->id }}" type="button"  class="btn btn-sm btn-primary  ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    @else
                                                    @can('Manage Partners','Update')
                                                    <button data-toggle="modal" data-target="#edit{{ $partner->id }}" type="button"  class="btn btn-sm btn-primary  ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    @endcan
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                            <div id="edit{{ $partner->id }}"  role="dialog" class="modal fade colored-header colored-header-primary">
                                                <div class="modal-dialog customModal ">
                                                    <form class="user" action="{{route('save.partner')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-content modal-lg">
                                                            <div class="modal-header">
                                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                                                                <h3 class="modal-title">Edit Partner Info</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row ">
                                                                    <div class="col-md-6">
                                                                        <label for="" class="text-primary">Select Project <span class="text-danger">*</span></label>
                                                                        <select name="project_id" id="project_id" class="select2">
                                                                            <option value="">Select Project</option>
                                                                            @foreach ($projects as $project)
                                                                                <option @if($partner->project_id==$project->id) selected @endif value="{{ $project->id }}">{{ $project->name }}</option>
                                                                            @endforeach
                                                                        </select>    
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Full Name <span class="text-danger">*</span></label>
                                                                        <input type="hidden" value="{{$partner->id}}" name="partner_id">
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="name" value="{{ $partner->name }}" placeholder="Partner Name" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Email</label>
                                                                        <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon">@</span>
                                                                            <input type="email" name="email" value="{{$partner->email}}" placeholder="Email" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">CNIC <span class="text-danger">*</span></label>
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="id_card_no" value="{{ $partner->id_card_no }}" placeholder="CNIC No." class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    

                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Address <span class="text-danger">*</span></label>
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="address" value="{{ $partner->address }}" placeholder="Enter Address" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Phone 1 <span class="text-danger">*</span></label>
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="phone1" value="{{ $partner->phone1 }}" placeholder="Enter Phone No." class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Phone 2</label>
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="phone2" value="{{ $partner->phone2 }}" placeholder="Enter Phone No." class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">City <small>(Option)</small></label>
                                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="city" value="{{ $partner->city }}" placeholder="" class="form-control">
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
                                        <th>Project Name</th>
                                        <th>Partner Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone#1</th>
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
    <div id="form-bp1"  role="dialog" class="  modal fade colored-header colored-header-primary">
        <div class="modal-dialog customModal ">
            <form class="user" action="{{route('save.partner')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                        <h3 class="modal-title">Add New Partner</h3>
                    </div>
                    <div class="modal-body">
                        <div class=" row">
                            <div class="col-md-6">
                                <label for="" class="text-primary">Select Project <span class="text-danger">*</span></label>
                                <select name="project_id"  id="project_id" class="select2">
                                    <option value="">Select Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>    
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">Full Name <span class="text-danger">*</span></label>
                                <input type="hidden" value="0" name="partner_id">
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Partner Name" class="form-control">
                                </div>
                            </div>
                         

                        </div>
                        <div class=" row">
                            <div class="col-md-6">
                                <label class="text-primary">Email</label>
                                <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon">@</span>
                                    <input type="email" name="email" value="{{old('email')}}" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">CNIC <span class="text-danger">*</span></label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="id_card_no" value="{{ old('id_card_no') }}" placeholder="CNIC No." class="form-control">
                                </div>
                            </div>
                          


                        </div>

                        <div class=" row">
                            <div class="col-md-6">
                                <label class="text-primary">Address <span class="text-danger">*</span></label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Enter Address" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">Phone 1 <span class="text-danger">*</span></label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="phone1" value="{{ old('phone1') }}" placeholder="Enter Phone No." class="form-control">
                                </div>
                            </div>
                          
                        </div>
                        <div class=" row">
                            <div class="col-md-6">
                                <label class="text-primary">Phone 2</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="phone2" value="{{ old('phone2') }}" placeholder="Enter Phone No." class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">City <small>(Option)</small></label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="city" value="{{ old('city') }}" placeholder="" class="form-control">
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
    </script>
@endsection

