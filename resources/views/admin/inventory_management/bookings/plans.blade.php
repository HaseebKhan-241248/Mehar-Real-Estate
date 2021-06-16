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
                        <div class="panel-heading panel-heading-divider">Manage Plans<span class="panel-subtitle"></span></div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center><h3><b>Manage Plans</b></h3></center>
                                <table id="table1" class="table table-striped table-hover table-bordered table-fw-widget">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Booking Day</th>
                                        <th>Project/Sector/Block/Plot</th>
                                        <th>Customer Name</th>
                                        <th>Agreed Price</th>
                                        <th>Installment Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bookings as $booking)
                                        <tr class="gradeC">
                                            <td>{{$counter++}}</td>
                                            <td>{{\Carbon\Carbon::parse($booking->day)->format('d M Y')}}</td>
                                            <td>
                                                <b>Project Name: </b> @if($booking->Project_Name){{$booking->Project_Name->name}}@endif
                                                <br>
                                                <b>Sector: </b> @if($booking->Sector_Name){{$booking->Sector_Name->name}}@endif
                                                <br>
                                                <b>Block Name: </b> @if($booking->Block_Name){{$booking->Block_Name->name}}@endif
                                                <br>
                                                <b>Plot: </b>  @if($booking->Plot_Name){{$booking->Plot_Name->name}}@endif
                                            </td>
                                            <td>@if($booking->Customer_Name){{$booking->Customer_Name->name}}@endif</td>
                                            <td>{{ number_format($booking->agreed_price,2)}}</td>
                                            <td>{{number_format($booking->installment_amount,2)}}</td>
                                            <td>
                                                @if($booking->type=="Subplan")
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#view{{ $booking->id }}" ><i class="fa fa-eye"></i> View Plan</button>
                                                @endif
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{ $booking->id }}" ><i class="fa fa-plus"></i> Add Plan</button>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Booking Day</th>
                                        <th>Project/Sector/Block/Plot</th>
                                        <th>Customer Name</th>
                                        <th>Agreed Price</th>
                                        <th>Installment Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($bookings as $booking)
        <div id="edit{{ $booking->id }}"  role="dialog" class="modal fade colored-header colored-header-primary">
            <form class="" id="form_id{{ $booking->id }}" action="{{ route('save.plan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog customModal">
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                            <h3 class="modal-title">Add Plan</h3>
                        </div>
                        <div class="modal-body">
                            <div class=" row">
                                <div class="col-md-6">
                                    <label class="text-primary" for="customer_name">Customer Name</label>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="hidden" name="customer_id" value="{{ $booking->customer_id }}">
                                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                        <input type="text" class="form-control" readonly name="customer_name" value="@if($booking->Customer_Name){{$booking->Customer_Name->name}}@endif">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="installment_amount" class="text-primary">Installment Amount</label>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="hidden" id="agreed_price-{{ $booking->id }}" value="{{ $booking->agreed_price }}">
                                        <input type="text" readonly value="{{ number_format($booking->installment_amount,2) }}" class="form-control" name="installment_amount">
                                    </div>
                                </div>
                            </div>
                            <div><h4  class="text-primary text-center">Sub Plan#1</h4></div>
                            <div class="row starter" >
                                <div class="col-md-5">
                                    <input type="hidden" name="subplan[]" value="1"/>
                                    <label  for="months" class="text-primary">Select Month</label>
                                    <select name="months[]"  onchange="getSuggestionAmount(this.value,{{ $booking->id }})" class="select2" required>
                                        <option value="">Select One</option>
                                        <option value="1">1-Month</option>
                                        <option value="2">2-Month</option>
                                        <option value="3">3-Month</option>
                                        <option value="4">4-Month</option>
                                        <option value="5">5-Month</option>
                                        <option value="6">6-Month</option>
                                        <option value="7">7-Month</option>
                                        <option value="8">8-Month</option>
                                        <option value="9">9-Month</option>
                                        <option value="10">10-Month</option>
                                        <option value="11">11-Month</option>
                                        <option value="12">12-Month</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label for="amount" class="text-primary">Amount</label>
                                    <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                        <input type="number" required name="amount[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2"><br><br>
                                    <a class="btn btn-danger delete-row" id="delete_row0" onclick="delete_row(0)"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                            <div class="plansrows" id="plansrows{{ $booking->id }}">
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <a class="btn btn-success btn-sm" onclick="addNewRow({{ $booking->id }})"><i class="fa fa-plus"></i> Add More</a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
                            <button   class="btn btn-primary ">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="view{{ $booking->id }}"  role="dialog" class="modal fade colored-header colored-header-primary">
            <div class="modal-dialog customModal">
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                        <h3 class="modal-title">View Plan</h3>
                    </div>
                    <div class="modal-body">
                        <div class=" row">
                            <div class="col-md-6">
                                <label class="text-primary" for="customer_name">Customer Name</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="hidden" name="customer_id" value="{{ $booking->customer_id }}">
                                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                    <input type="text" class="form-control" readonly name="customer_name" value="@if($booking->Customer_Name){{$booking->Customer_Name->name}}@endif">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="installment_amount" class="text-primary">Installment Amount</label>
                                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                    <input type="text" readonly value="{{ number_format($booking->installment_amount,2) }}" class="form-control" name="installment_amount">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Subplan#</th>
                                        <th>No. of Months</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--                                        {{dd($booking->BookingPlans)}}--}}
                                    @if($booking->BookingPlans)
                                        @foreach($booking->BookingPlans as $plan)
                                            <tr>
                                                <td>Subplan#{{ $plan->subplan }}</td>
                                                <td>{{ $plan->months }}-Months</td>
                                                <td>{{ number_format($plan->amount,2) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            //initialize the javascript
            // App.init();
            App.dataTables();
            App.formElements();
        });

        var row=1;
        var plan=1;
        function addNewRow(booking_id)
        {

            plan++;
            console.log('plan');
            console.log(plan);
            console.log('row');
            console.log(row);
            var new_row = `
               <div id="full_div${plan}">
               <div><h4  class="text-primary text-center">Sub Plan#${plan}</h4></div>
    <div class="row">
        <div class="col-md-5">
            <input type="hidden" name="subplan[]" value="${plan}"/>
            <label  for="months" class="text-primary">Select Month</label>
            <select name="months[]"   class="select2" required>
                <option value="">Select One</option>
                <option value="1">1-Month</option>
                <option value="2">2-Month</option>
                <option value="3">3-Month</option>
                <option value="4">4-Month</option>
                <option value="5">5-Month</option>
                <option value="6">6-Month</option>
                <option value="7">7-Month</option>
                <option value="8">8-Month</option>
                <option value="9">9-Month</option>
                <option value="10">10-Month</option>
                <option value="11">11-Month</option>
                <option value="12">12-Month</option>
            </select>
        </div>
        <div class="col-md-5">
            <label for="amount" class="text-primary">Amount</label>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input type="number" required name="amount[]" class="form-control">
            </div>
        </div>
        <div class="col-md-2"><br><br>
            <a class="btn btn-danger delete-row" id="delete_row${plan}" onclick="delete_row(${plan})">
              <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
  </div>
           `;
            $('#plansrows'+booking_id).append(new_row);
            App.formElements();
        }
        function delete_row(id) {
            //  alert("deleting row#"+row);
            if(plan>1) {
                $('#full_div'+id).remove();
                plan--;
            }
            return false;
        }

        function getSuggestionAmount(val,booking_id)
        {
            var agreed = $('#agreed_price-'+booking_id).val();
            console.log('agreed_price');
            console.log(agreed);
            $.ajax({
                url:"{{url('/getbookingamount')}}/"+booking_id,
                method:'GET',
                success: function (response)
                {
                    // let res = response.split("**");
                    console.log('response');
                    console.log(response);
                    var suggestion = agreed-response;
                    console.log('suggestion');
                    console.log(suggestion);
                    var suggestion_amount = suggestion/val;
                    $('#'+booking_id).val(suggestion_amount);
                },
                error: function (error) {
                    console.log('error');
                    console.log(error);
                }
            })

        }
    </script>
@endsection

