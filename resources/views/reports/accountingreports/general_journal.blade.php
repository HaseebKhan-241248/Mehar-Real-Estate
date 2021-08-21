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
                        <div class="panel-heading panel-heading-divider ">
                            <span class="text-primary">General Journal</span>
                            <span class="panel-subtitle"></span>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="" class="text-primary">Start Date</label>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" id="start_date" name="day">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="text-primary">End Date</label>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="date" id="end_date" class="form-control"  value="{{ date('Y-m-d') }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="text-primary">Select Project</label>
                                    <select name="" id="project_id" class="select2">
                                        <option value="">Select Project</option>
                                        @foreach(\App\Models\Projects\Project::all() as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <br><br>
                                    <button class="btn btn-primary btn-sm generalReport">Generate Report</button>
                                    <img style="display: none;" id="loading" src="{{url('loading.gif')}}" width="50" class="img-responsive">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-body">

                            <div class="row invoice-data" style="margin-bottom:0;">
                                <div class="col-xs-12 invoice-person">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <h1 style="font-family: Emoji,serif;  background-color: #1572E8;color: white;" class="test text-uppercase">General Journal</h1>
                                            </center>

                                            <table class="table table-bordered" style="border-collapse: collapse;width:100%;margin-top:-10px;">
                                                <thead>
                                                <tr style="font-size: 11px;background-color: #1572E8;color: white;" class="text-uppercase ">
                                                    <th class="text-center test1" style="padding:1px;">Date</th>
{{--                                                    <th class="text-center test1" style="padding:1px;">Booking#/Voucher#</th>--}}
                                                    <th class="text-center test1" style="padding:1px;">Account Title and Description</th>
                                                    <th class="text-center test1" style="padding:1px;">Debit</th>
                                                    <th class="text-center test1" style="padding:1px;">Credit</th>
                                                </tr>
                                                </thead>
                                                <tbody id="detail"></tbody>
                                            </table>
                                        </div>
                                    </div>
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
    $("body").on('click','.generalReport',function(){
        let start      = $('#start_date').val();
        let end        = $('#end_date').val();
        let project_id = $('#project_id').val();
        if(project_id=="" || project_id==null)
        {
            alert("Please Select the Project");
            return;
        }
        $('#loading').css('display','inline');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var request    = $.ajax({
            url: "{{ route('get.general_journal') }}",
            method: "post",
            data: {_token: CSRF_TOKEN, start:start,end:end,project_id:project_id},
            dataType: "html"
        });
        request.done(function( msg ) {
            var data = JSON.parse(msg);
            console.log(msg);
            $('#detail').html(data.result);
            $('#loading').css('display','none');
        });
    });

    $(document).ready(function(){
       App.formElements();
    });
</script>
@endsection
