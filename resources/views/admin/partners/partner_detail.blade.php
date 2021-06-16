@extends('admin.layouts.app')
@section('content')
    <style type="text/css">
        .custoMargin
        {
            margin-left: 108px !important;
        }
        @media (min-width: 1200px)
        {
            .container
            {
                width: 100%;
            }
        }
        .customFont
        {
            color: white;
            font-family: 'Material Icons', serif;
        }
        .sticky {
            position: fixed;
            top: 0;
            width: 79% !important;
            padding-top: 60px;
            background-color: white;
            box-shadow: 0px 11px 12px 1px #0000003d;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }
        .sticky + .content {
            padding-top: 102px !important;
        }
    </style>
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
                        <br>
                        <div class="header"  id="header">
                            <div class="row "  style="margin: 0px;">
                                <div class="col-md-3 " >
                                    <label  class="text-primary">Select Partner <span class="text-danger">*</span></label>
                                    <select name="" id="partner" class="select2 partner">
                                        <option value="">Select One</option>
                                        @foreach($partners as $partner)
                                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="text-primary">Amount <span class="text-danger">*</span></label>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="number"  placeholder="0" value="0" class="form-control amouny_payTo_partner" id="amouny_payTo_partner" name="amouny_payTo_partner">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="text-primary">Amount Pay <span class="text-danger">*</span></label>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="number"  placeholder="0" value="0" readonly class="form-control" id="partner_amount" name="partner_amount">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="text-primary">Date <span class="text-danger">*</span> </label>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control daysend" id="daysend" >
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin: 0px;">
                                <div class="col-md-3" style="    margin-bottom: 10px;">
                                    <label for="" class="text-primary">On Account of <span class="text-danger">*</span></label>
                                    <select name="on_account_of" id="on_account_of" class="select2">
                                        <option value="">Select Account</option>
                                        @foreach($accounts as $account)
                                        <option value="{{$account->id }}">{{ $account->account_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3" style="    margin-bottom: 10px;">
                                    <br><br>
                                    <button class="btn btn btn-primary btn-sm generate" id="generate" >Get Partner Shares</button>
                                    <button class="btn btn btn-success btn-sm pay_to_partner" id="pay_to_partner" disabled>Pay </button>
                                </div>
                                <div class="col-md-2">
                                    <img style="display: none;" id="loading" src="{{url('loading.gif')}}" width="50" class="img-responsive">
                                </div>
                                <br>
                            </div>
                        </div>

                        <br>
                    </div>
                    <div class="content">
                        <div class="panel " style="height: 100%;">
                            <div class="container ">
                                <div class="row">
                                    <div class="col-md-12 " style="background-color: black;">
                                        <h2 class=" text-center customFont"  >Partner Share Detail</h2>
                                    </div>
                                </div>
                                <form action="{{ route('pay.partnerAmount') }}" method="post" name="myForm" enctype="multipart/form-data" onsubmit="return validateForm()">
                                    @csrf
                                    <input type="hidden" id="amount_paid_to_partner" name="amount_paid_to_partner">
                                    <input type="hidden" id="day" name="day">
                                    <input type="hidden" id="partner_id" name="partner_id">
                                    <input type="hidden" id="account_id" name="account_id">
                                    <div class="container" id="detail">

                                    </div>
                                    <button id="saveBtn" style="display: none;"></button>
                                </form>
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

        $('body').on('click','.generate',function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let partnerid = $('#partner').val();
            if(partnerid==="" || partnerid===null)
            {
                alert("Please Select the Partner First");
                return;
            }
            $('#loading').css('display','inline');
            var request    = $.ajax({
                url: "{{ route('partner.amount_detail') }}",
                method: "post",
                data: {_token: CSRF_TOKEN, partnerid:partnerid},
                dataType: "html"
            });
            request.done(function( msg ) {
                var data = JSON.parse(msg);
                console.log(data);
                $('#detail').html(data.result);
                $('#loading').css('display','none');
            });
        });

        /////////////////  for the checkboxes ////////////////////
    </script>

    <script src="{{ asset('/assets/js/partners/checkboxesCalculation.js') }}" ></script>
@endsection

