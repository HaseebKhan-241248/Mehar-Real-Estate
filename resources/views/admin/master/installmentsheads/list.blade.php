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
                            <div class="panel-heading panel-heading-divider"> Head List<span
                                    class="panel-subtitle"></span></div>
                        </div>
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-3">
                            <div class="panel-heading panel-heading-divider">
                                @if((Auth::user()->role) == 'Super Admin')
                                <button data-toggle="modal" data-target="#form-bp1" type="button"
                                    class="btn btn-primary  ">
                                    <i class="fa fa-plus"></i> Add New Head
                                </button>
                                @else
                                @can('Add Installment Head','Create')
                                <button data-toggle="modal" data-target="#form-bp1" type="button"
                                    class="btn btn-primary  ">
                                    <i class="fa fa-plus"></i> Add New Head
                                </button>
                                @endcan
                                @endif

                                <span class="panel-subtitle"></span></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="p-2">
                            <center>
                                <h3><b>Manage Installment Heads</b></h3>
                            </center>
                            <table id="table1" class="table table-striped table-hover table-fw-widget">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Installment Head Name</th>
                                        <th>No. of Months</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tobdy>
                                    @foreach($heads as $head)
                                    <tr class="gradeC">
                                        <td>{{$counter++}}</td>
                                        <td>{{$head->head}}</td>
                                        <td>{{$head->no_of_months}}</td>
                                        <td>{{$head->description }}</td>
                                        <td>
                                            @if((Auth::user()->role) == 'Super Admin')
                                            <button data-toggle="modal" data-target="#edit{{ $head->id }}" type="button"
                                                class="btn btn-sm btn-primary  "><i class="fa fa-edit"></i></button>
                                            @else
                                            @can('Add Installment Head','Update')
                                            <button data-toggle="modal" data-target="#edit{{ $head->id }}" type="button"
                                                class="btn btn-sm btn-primary  "><i class="fa fa-edit"></i></button>
                                            @endcan
                                            @endif

                                        </td>
                                    </tr>
                                    <div id="edit{{ $head->id }}" role="dialog"
                                        class="modal fade colored-header colored-header-primary">
                                        <div class="modal-dialog customModal">
                                            <form class="user" action="{{route('save.installmenthead')}}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-content modal-lg">
                                                    <div class="modal-header">
                                                        <button type="button" data-dismiss="modal" aria-hidden="true"
                                                            class="close md-close"><span
                                                                class="mdi mdi-close"></span></button>
                                                        <h3 class="modal-title">Edit Head</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class=" row">
                                                            <div class="col-md-6">
                                                                <label class="text-primary">Head Name</label>
                                                                <input type="hidden" value="{{ $head->id }}"
                                                                    name="head_id">
                                                                <div
                                                                    class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                    <input type="text" name="head"
                                                                        value="{{ $head->head }}"
                                                                        placeholder="Head Name" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="text-primary">No. of Months</label>
                                                                <div
                                                                    class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                    <input type="number" name="no_of_months"
                                                                        value="{{ $head->no_of_months }}"
                                                                        placeholder="0" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class=" row">
                                                            <div class="col-md-12">
                                                                <label class="text-primary">Short Description</label>
                                                                <div
                                                                    class="col-md-12 input-group input-group-sm xs-mb-15">
                                                                    <input type="text" name="description"
                                                                        value="{{ $head->description }}"
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
                                    @endforeach
                                </tobdy>
                                <tfoot>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Installment Head Name</th>
                                        <th>No. of Months</th>
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
        <form class="user" action="{{route('save.installmenthead')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span
                            class="mdi mdi-close"></span></button>
                    <h3 class="modal-title">Add Installment Head</h3>
                </div>
                <div class="modal-body">
                    <div class=" row">
                        <div class="col-md-6">
                            <label class="text-primary">Head Name</label>
                            <input type="hidden" value="0" name="head_id">
                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                <input type="text" name="head" value="{{ old('head') }}" placeholder="Head Name"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-primary">No of Months</label>
                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                <input type="number" name="no_of_months" value="{{ old('no_of_months') }}"
                                    placeholder="0" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class=" row">
                        <div class="col-md-12">
                            <label class="text-primary">Short Description</label>
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
        //initialize the javascript
        // App.init();
        App.dataTables();
        App.formElements();
    });

</script>
@endsection
