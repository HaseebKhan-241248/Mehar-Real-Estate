@extends('admin.layouts.app')
@section('content')
    <style type="text/css">
        .custoMargin {
            margin-left: 108px !important;
        }

        .customModal {
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
                                <div class="panel-heading panel-heading-divider">Customer's List<span
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
                                                class="btn btn-primary  ">
                                            <i class="fa fa-plus"></i> Add New Customer
                                        </button>
                                    @else
                                        @can('Manage Customers','Create')
                                            <button data-toggle="modal" data-target="#form-bp1" type="button"
                                                    class="btn btn-primary  ">
                                                <i class="fa fa-plus"></i> Add New Customer
                                            </button>
                                        @endcan
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center>
                                    <h3><b>Manage Customers</b></h3>
                                </center>
                                <table id="table1" class="table table-striped table-bordered table-hover table-fw-widget">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Project Name</th>
                                        <th>Customer Name</th>
                                        <th>Father Name</th>
                                        <th>Address</th>
                                        <th>Phone#1</th>
                                        <th>City</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tobdy>
                                        @foreach($customers as $customer)
                                            <tr class="gradeC">
                                                <td>{{$counter++}}</td>
                                                <td>@if($customer->Project_Name){{$customer->Project_Name->name}}@endif</td>
                                                <td>{{$customer->name}}</td>
                                                <td>{{$customer->father_name}}</td>
                                                <td>{{$customer->address }}</td>
                                                <td>{{$customer->phone1 }}</td>

                                                <td>{{$customer->city }}</td>
                                                <td><img style="border-radius: 180px; width:50px;height: 50px;"
                                                         src="{{ asset('') }}images/{{ $customer->image }}" alt="image"></td>
                                                <td>
                                                    @if(\Auth::user()->role == 'Super Admin')
                                                        <button data-toggle="modal" data-target="#edit{{ $customer->id }}"
                                                                type="button" class="btn btn-sm btn-primary  "><i
                                                                class="fa fa-edit"></i></button>
                                                        <a href="{{ route('delete.customer',[$customer->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');" >
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    @else
                                                        @can('Manage Customers','Update')
                                                            <button data-toggle="modal" data-target="#edit{{ $customer->id }}"
                                                                    type="button" class="btn btn-sm btn-primary  "><i
                                                                    class="fa fa-edit"></i></button>
                                                        @endcan
                                                        @can('Manage Customers','Delete')
                                                            <a href="{{ route('delete.customer',[$customer->id])}}" onclick="return confirm('Are you sure you want to delete this?');" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                            <div id="edit{{ $customer->id }}" role="dialog"
                                                 class="modal fade colored-header colored-header-primary">
                                                <div class="modal-dialog customModal ">
                                                    <form class="user" action="{{route('save.customer')}}" method="POST"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-content modal-lg">
                                                            <div class="modal-header">
                                                                <button type="button" data-dismiss="modal" aria-hidden="true"
                                                                        class="close md-close"><span
                                                                        class="mdi mdi-close"></span></button>
                                                                <h3 class="modal-title">Edit Customer Info</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row ">
                                                                    <div class="col-md-6">
                                                                        <label for="" class="text-primary">Select Project
                                                                            <span class="text-danger">*</span>
                                                                        </label>
                                                                        <select name="project_id" id="project_id"
                                                                                class="select2">
                                                                            <option value="">Select Project</option>
                                                                            @foreach ($projects as $project)
                                                                                <option @if($customer->project_id==$project->id)
                                                                                        selected @endif
                                                                                        value="{{ $project->id }}">{{ $project->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Full Name *</label>
                                                                        <input type="hidden" value="{{$customer->id}}"
                                                                               name="customer_id">
                                                                        <div
                                                                            class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="name"
                                                                                   value="{{ $customer->name }}"
                                                                                   placeholder="Customer Name"
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Father Name *</label>
                                                                        <div
                                                                            class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="father_name" required
                                                                                   value="{{ $customer->father_name }}"
                                                                                   placeholder="Father Name" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Email</label>
                                                                        <div class="input-group input-group-sm xs-mb-15"><span
                                                                                class="input-group-addon">@</span>
                                                                            <input type="email" name="email"
                                                                                   value="{{$customer->email}}" placeholder="Email"
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">CNIC *</label>
                                                                        <div
                                                                            class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="id_card_no"
                                                                                   value="{{ $customer->id_card_no }}"
                                                                                   placeholder="CNIC No." class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Address</label>
                                                                        <div
                                                                            class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="address"
                                                                                   value="{{ $customer->address }}"
                                                                                   placeholder="Enter Address"
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Phone 1</label>
                                                                        <div
                                                                            class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="phone1"
                                                                                   value="{{ $customer->phone1 }}"
                                                                                   placeholder="Enter Phone No."
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Phone 2</label>
                                                                        <div
                                                                            class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="phone2"
                                                                                   value="{{ $customer->phone2 }}"
                                                                                   placeholder="Enter Phone No."
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">City
                                                                            <small>(Optional)</small></label>
                                                                        <div
                                                                            class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="text" name="city"
                                                                                   value="{{ $customer->city }}" placeholder=""
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="text-primary">Image Upload</label>
                                                                        <div
                                                                            class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                            <input type="file" name="image"
                                                                                   class="form-control">
                                                                            <input type="hidden" name="old_image"
                                                                                   value="{{ $customer->image }}"
                                                                                   class="form-control">
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
                                        @endforeach
                                    </tobdy>
                                    <tfoot>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Project Name</th>
                                        <th>Customer Name</th>
                                        <th>Father Name</th>
                                        <th>Address</th>
                                        <th>Phone#1</th>
                                        <th>City</th>
                                        <th>Image</th>
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
    <div id="form-bp1" role="dialog" class="  modal fade colored-header colored-header-primary">
        <div class="modal-dialog customModal ">
            <form class="user" action="{{route('save.customer')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span
                                class="mdi mdi-close"></span></button>
                        <h3 class="modal-title">Add New Customer</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-md-6">
                                <label for="" class="text-primary">Select Project <span class="text-danger">*</span></label>
                                <select name="project_id" id="project_id" class="select2">
                                    <option value="">Select Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">Full Name <span class="text-danger">*</span></label>
                                <input type="hidden" value="0" name="customer_id">
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" required name="name" value="{{ old('name') }}"
                                           placeholder="Customer Name" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-primary">Father Name <span class="text-danger">*</span></label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="father_name" required value="{{ old('father_name') }}"
                                           placeholder="Father Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">Email</label>
                                <div class="input-group input-group-sm xs-mb-15"><span class="input-group-addon">@</span>
                                    <input type="email" name="email" value="{{old('email')}}" placeholder="Email"
                                           class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-primary">CNIC <span class="text-danger">*</span></label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="id_card_no" required value="{{ old('id_card_no') }}"
                                           placeholder="CNIC No." class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">Address <span class="text-danger">*</span></label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="address" value="{{ old('address') }}"
                                           placeholder="Enter Address" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-primary">Phone 1 <span class="text-danger">*</span></label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="phone1" value="{{ old('phone1') }}"
                                           placeholder="Enter Phone No." class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">Phone 2</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="phone2" value="{{ old('phone2') }}"
                                           placeholder="Enter Phone No." class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-primary">City <small>(Optional)</small></label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" name="city" value="{{ old('city') }}" placeholder=""
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-primary">Image Upload</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="file" name="image" class="form-control">
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
            //initialize the javascript
            App.dataTables();
            App.formElements();
        });
    </script>
@endsection
