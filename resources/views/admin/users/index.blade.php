@extends('admin.layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                        <center>
                            <h2 class="text-primary">Add New User</h2>
                        </center>
                        <div class="" style="padding: 15px;">
                            <div class="row  " >
                                <div class="col-md-3">
                                    <label for="" class="text-primary">User Name
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="text" placeholder="Enter the User Name" value="{{ old('name') }}" name="name" class="form-control" required id="name" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="text-primary">Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <span class="alert-danger12 text-danger"></span>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="email" placeholder="Enter Email" class="form-control " value="{{ old('email') }}" name="email" required id="email" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="" class="text-primary">Phone
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="text" placeholder="Enter Phone No" value="{{ old('phone') }}" name="phone" class="form-control " required id="phone" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="text-primary">Address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="text" placeholder="Enter Address" value="{{ old('address') }}" name="address" class="form-control " required id="address" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="" class="text-primary">CNIC
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="text" placeholder="Enter CNIC" value="{{ old('cnic') }}" name="cnic" class="form-control " required id="cnic" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="text-primary">Select Project</label>
                                    <select name="project_id" id="project_id" class="select2">
                                        <option value="">Select Project</option>
                                        @foreach(\App\Models\Projects\Project::all() as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <center>
                                <h2 class="text-primary">Roles & Permissions</h2>
                            </center>
                            <br>
                            @foreach(json_decode(json_encode(config('permissions'))) as $permission)

                                @if(isset($permission->parent))<hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h4 style="font-family: emoji,serif;font-size:22px;">{{ $permission->name }}</h4>
                                    </div>

                                    @foreach($permission->operations as $operations)
                                        @if($operations=='')
                                            <div class="col-md-2">
                                            </div>
                                        @else
                                            <div class="col-md-2" style="display: flex;margin-top: 12px;">
                                                <p class="customP">{{ $operations }}</p>
                                                <input type="checkbox" style="margin-left:5px;" class="customCheckbox" permission_id="{{ $permission->id }}" operation="{{ $operations }}" value="{{ $operations }}" class="form-control" name="module[]" id="module{{ $permission->id }}">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                @php
                                    $parentid = $permission->id;
                                @endphp
                                @foreach(json_decode(json_encode(config('permissions'))) as $submodule)
                                    @if(isset($submodule->parent_id))
                                        @if($submodule->parent_id == $parentid)
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5 style="font-family: emoji,serif;margin-left: 20px;font-size:17px;">{{$submodule->name}}</h5>
                                                </div>
                                                @foreach($submodule->operations as $operations)
                                                    @if($operations=='')
                                                        <div style="margin-left: 20px;" class="col-md-2">
                                                        </div>
                                                    @else
                                                        <div style="margin-left: 20px;display:flex;margin-top: 12px;" class="col-md-2">
                                                            <p class="customP2">{{ $operations }}</p>
                                                            <input type="checkbox" style="margin-left:5px;" class="customCheckbox" permission_id="{{ $submodule->id }}" operation="{{ $operations }}" value="{{ $operations }}" class="form-control" >
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                                @endif

                            @endforeach
                            <br>
                            <button class="btn btn-primary btn-sm"  id="saveBtn">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">

        var permissions = @php echo json_encode(config('permissionTemplate')) @endphp ;
        console.log(permissions);
        $('.customCheckbox').click(function ()
        {
            var permissionId = $(this).attr("permission_id");
            var op = $(this).attr("operation");
            console.log('permission_id');
            console.log(permissionId);
            console.log(op);
            console.log('operation');
            if($(this).is(":checked"))
            {
                console.log('hit if');
                permissions.forEach(function(permission)
                {
                    if(permission.id==permissionId)
                    {
                        permission.operations.push(op);
                    }
                })
                console.log(permissions);
            }
            else
            {
                console.log('hit else');
                permissions.forEach(function(permission)
                {
                    if(permission.id==permissionId)
                    {
                        var index = permission.operations.indexOf(op);
                        permission.operations.splice(index,1);
                    }
                })
            }
        })



        $('#saveBtn').click(function ()
        {
            var name     = $('#name').val();
            var email    = $('#email').val();
            var phone    = $('#phone').val();
            var address  = $('#address').val();
            var cnic     = $('#cnic').val();

            if(name=="" || name==null)
            {
                alert("Please Enter the Name");
                $('#name').focus();
                $('#name').css('border-color','red');
                return false;
            }
            else
            {
                $('#name').css('border-color','lightgreen');
            }
            if(email=="" || email==null)
            {
                alert("Please Enter the Email");
                $('#email').focus();
                $('#email').css('border-color','red');
                return false;
            }
            else

            {
                $('#email').css('border-color','lightgreen');
            }


            if(phone=="" || phone==null)
            {
                alert("Please Enter the Phone No.");
                $('#phone').focus();
                $('#phone').css('border-color','red');
                return false;
            }
            else

            {
                $('#phone').css('border-color','lightgreen');
            }
            console.log('permissions');
            console.log(permissions);
            console.log(JSON.stringify(permissions));
            var permission = JSON.stringify(permissions);

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var request    = $.ajax({
                url: "{{route('save.users')}}",
                method: "post",
                data: {
                    _token: CSRF_TOKEN,name:name,email:email,phone:phone,address:address,cnic:cnic,
                    permission:permission
                },
                dataType: "html",

            });
            request.done(function( msg ) {
                if(msg==1)
                {
                    $('.alert-danger12').show();
                    $('#email').focus();
                    $('#email').css('border-color','red');
                    $('.alert-danger12').html('Email Already been taken');
                }
                else
                {

                    toastr.success("User Saved Successfully!");
                    location.reload();
                }
            });
        })




        $(document).ready(function () {
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
    <script src="{{ asset('/assets/js/Master/master.js') }}"></script>
@endsection
