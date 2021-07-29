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
                        <div class="panel-heading panel-heading-divider">Create Cash Voucher
                            <span class="panel-subtitle">From here you can create Cash Voucher</span>
                        </div>
                        <div class="panel-body">
                            <div class="p-2">
                                <center>
                                    <h3>
                                        <b>Create New Cash Voucher</b>
                                    </h3>
                                </center>
                                <form class="user" action="{{ route('save.cash_voucher') }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="voucher_no" class="text-primary">Voucher No.</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="number" readonly @if($voucher_no) value="{{ $voucher_no }}"@endif name="voucher_no" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="day" class="text-primary">Date</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="date" value="{{ date('Y-m-d') }}" name="day" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="text-primary">Particulars</label>
                                            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                <input type="text" value="{{ old('particulars') }}" name="particulars" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="id_posted" class="text-primary">Is Posted</label><br>
                                            <input type="hidden" class="" value="0" name="is_posted">
                                            <input type="checkbox" class="" value="1" name="is_posted">

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <a class="btn btn-primary btn-sm" id="internaluse-row"><i class="fa fa-plus"></i> Add More</a>
                                            </center>
                                            <table class="table table-bordered" id="customer">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Account Name</th>
                                                    <th class="text-center">Description</th>
                                                    <th class="text-center">Debit</th>
                                                    <th class="text-center">Credit</th>
                                                    <th class="text-center">-</th>
                                                </tr>
                                                </thead>
                                                <tbody id="internaluse-body">
                                                <tr id="row0">
                                                    <td style="width: 275px;">
                                                        <select class="select2 CustominpuWidth"  id="account_id[]" name="account_id[]">
                                                            <option    value="">Select One</option>
                                                            @foreach($accounts as $account)
                                                                <option value="{{$account->id}}" >{{$account->account_name}} - @if($account->Project_Name) ({{ $account->Project_Name->name }}) @endif</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                            <input type="text" name="description[]" class="form-control CustominpuWidth" placeholder="Description"/>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                            <input type="number" readonly class="form-control CustominpuWidth debit" name="debit[]" id="debit0" onkeyup="enable_disable(this.id,this.value,0)" value="0" placeholder="0">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                            <input type="number" id="credit0" onkeyup="enable_disable(this.id,this.value,0)" class="form-control CustominpuWidth credit" name="credit[]" value="0" placeholder="0">
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <tr>
                                                    <td colspan="1"></td>
                                                    <th class="text-right" style="font-size: 20px;">Total: </th>
                                                    <td style="border:1px solid black;">
                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                        <input type="number" id="debit_total" readonly name="debit_total" class="form-control">
                                                        </div>
                                                    </td>
                                                    <td style="border:1px solid black;">
                                                        <div class="col-md-12 input-group input-group-sm xs-mb-15">
                                                        <input type="number" id="credit_total" readonly name="credit_total" class="form-control">
                                                        <input type="hidden" id="credit_total2"  class="form-control">
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label for="" class="text-primary">Amount In Words</label>
                                                    <textarea name="amount_in_words" id="amount_in_words" class="form-control" cols="30" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                                <button type="submit" name=""  id="" class="btn btn-primary save_data2">Create</button>
                                        </div>
                                    </div>
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
        var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
        var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

        function inWords (num) {
            if ((num = num.toString()).length > 9) return 'overflow';
            n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
            if (!n) return; var str = '';
            str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
            str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
            str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
            str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
            str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
            return str;
        }
        const baseurl = "{{url('/')}}";
        var row1=1;
        var inc =1;
        var c=1;
        $(document).on("click", "#internaluse-row", function () {
            inc++;
            var new_row = `<tr id="row'  ${row1}  '">
                <td>
                <select class="select2" required name="account_id[]">
                 <option    value="" >Select One</option>
                  @foreach($accounts as $account)
            <option value="{{$account->id}}">{{$account->account_name}}</option>
                @endforeach
            </select>
            </td>
            <td id="date_from">
                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input type="text" name="description[]" class="form-control" placeholder="Description"/>
                </div>
                </td>
            <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
            <input type="number" class="form-control debit" readonly  id="debit${inc}" onkeyup="enable_disable(this.id,this.value,${inc})" value="0" name="debit[]" placeholder="0">
            </div>
                </td>
                <td>
                <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input type="number" class="form-control credit" onkeyup="enable_disable(this.id,this.value,${inc})" id="credit${inc}" value="0"  name="credit[]" placeholder="0">
                </div>
                </td>
                <td>
                <button class="security btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </td>
                </tr>`;
            $('#internaluse-body').append(new_row);
            App.formElements();
            c++;
            calc();
            row1++;
            return false;
        });

        function calc()
        {
            $('#customer tbody tr').each(function(i, element) {
                var html = $(this).html();
                if(html!='')
                {

                    $(this).find('.credit').val();
                    $(this).find('.debit').val();

                    calc_total();
                    calc_total2();
                }
            });


        }

        function enable_disable(id,str,count){
// alert(id)  ;alert(str);alert(count);
            db = 'debit'+count;
            cr = 'credit'+count;
            if(id==db){

                if(str>0){
                    //block credit
                    $("#credit"+count).attr("readonly","true");
                    $("#credit"+count).removeAttr("onkeyup","enable_disable(this.id,this.value,"+count+")");
                }

            }
            else if(id==cr){

                if(str>0){
                    $("#debit"+count).attr("readonly","true");
                    $("#debit"+count).removeAttr("onkeyup","enable_disable(this.id,this.value,"+count+")");
                }

            }

            if(str==0){
                $("#credit"+count).removeAttr("readonly");
                $("#debit"+count).removeAttr("readonly");
                $("#credit"+count).attr("onkeyup","enable_disable(this.id,this.value,"+count+")");
                $("#debit"+count).attr("onkeyup","enable_disable(this.id,this.value,"+count+")");
            }
            calc_total();
            calc_total2();

        }


        function calc_total()
        {
            credit=0;
            $('.credit').each(function() {
                credit += parseInt($(this).val());
            });
            $('#credit_total').val(credit.toFixed(2));
            $('#credit_total2').val(credit);
            Credit_Debit_Equal();
        }


        function calc_total2()
        {
            debit=0;
            $('.debit').each(function() {
                debit += parseInt($(this).val());
            });

            $('#debit_total').val(debit.toFixed(2));
            Credit_Debit_Equal();
        }

        function Credit_Debit_Equal()
        {
            var debit_total  = $('#debit_total').val();
            var credit_total = $('#credit_total').val();

            if ((debit_total == 0.00) && (credit_total==0.00)) {
                $('.save_data').attr('disabled', 'disabled');
                return false;
            }

            else if ((debit_total == "") && (credit_total=="")) {
                $('.save_data').attr('disabled', 'disabled');
                return false;
            }
            if(debit_total == credit_total){

                $('.save_data').removeAttr('disabled');
                return false;
            }
            if(debit_total != credit_total){
                {
                    $('.save_data').attr('disabled', 'disabled');
                    return false;
                }
            }
        }
        $(document).on("click", ".security", function () {
            //  alert("deleting row#"+row);
            if(row1>1) {
                $(this).closest('tr').remove();
                row1--;
            }
            calc();
            Amount_IN_Words();
            return false;
        });
        $("body").on('keyup','.credit',function (){
            // alert($('#debit_total2').val());
            Amount_IN_Words();
        });
        function Amount_IN_Words()
        {
            const str = inWords($('#credit_total2').val());
            const str2 = str.charAt(0).toUpperCase() + str.slice(1);
            $('#amount_in_words').val(str2);
        }
    </script>

    {{--    <script src="{{ asset('/assets/js/booking/bookingcalculation.js') }}"></script>--}}
    {{--    <script src="{{ asset('/assets/js/Master/master.js') }}"></script>--}}
    <script src="{{ asset('/assets/js/booking/makinginatallments.js') }}"></script>
@endsection
