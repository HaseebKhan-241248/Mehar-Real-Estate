$(document).ready(function () {
    //initialize the javascript
    // App.init();
    App.dataTables();
    App.formElements();
});


$("#customer_id").change(function () {
    let phone = jQuery(this).children(":selected").attr("dphone");
    let customer = jQuery(this).children(":selected").text();
    $('#customer_name').val(customer);
    $('#customer_contact').val(phone);
});
$("#project_id").change(function () {
    let per = jQuery(this).children(":selected").attr("datapercent");
    let partnerid = jQuery(this).children(":selected").attr("partner_ID");
    console.log('partnerid');
    console.log(partnerid);
    $('#partner_percent').val(per);
    $('#partner_id').val(partnerid);
});

/////////////////////////////////////   calculation  ////////////////////////////////////
function formatMoney(number, decPlaces, decSep, thouSep) {
    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
        decSep = typeof decSep === "undefined" ? "." : decSep;
    thouSep = typeof thouSep === "undefined" ? "," : thouSep;
    var sign = number < 0 ? "-" : "";
    var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
    var j = (j = i.length) > 3 ? j % 3 : 0;
    return sign + (j ? i.substr(0, j) + thouSep : "") +
        i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
        (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
}
//////////////////////////////// for the making of multiple plans/////////////////////////


/////////////////// for making installments //////////////////////
var c = 0;

function MakingInstallments(counter) {

    var head_months = $("#head_id option:selected").attr("dmonths");
    var enddate = $('#end_date').val();
    enddate = enddate.split("-");
    var to = new Date(enddate[0], enddate[1], enddate[2]);
    var start = $('#start_date').val();
    start = start.split("-");
    from = new Date(start[0], start[1], start[2]);
    var months = to.getMonth() - from.getMonth() + (12 * (to.getFullYear() - from.getFullYear()));
    if (to.getDate() < from.getDate()) {
        var newFrom = new Date(to.getFullYear(), to.getMonth(), from.getDate());
        if (to < newFrom && to.getMonth() == newFrom.getMonth() && to.getYear() % 4 != 0) {
            months--;
        }
    }
    console.log(months);
    var no_of_months = months / head_months;
    $('#no_of_installments').val(no_of_months);


    var agreePrice = $('#agreed_price').val();
    var receievedmount = $('#received').val();
    var head = $('#head_id').val();
    var s_date = $('#start_date').val();
    var sub_start_date = $('#start_date').val();

    var discount = $('#discount').val();
    agreePrice = agreePrice - discount;
    // agreePrice         = agreePrice/no_of_months;
    // alert(agreePrice);
    if (head == null || head === "") {
        // alert("Please Select the Installment Head First");
        $('#head_id').focus();
        $('#head_id').css('border-color', 'red');
        return false;
    } else {
        $('#head_id' + counter).css('border-color', 'lightgreen');
    }
    //////////////////////////////// date functions///////////////////////////////
    s_date = s_date.split("-");
    var start_date = new Date(s_date[0], s_date[1], s_date[2]);
    ///////////////////////// end date function ///////////////////////////////////

    ///////////////////////// sub date functions //////////////////////////////////
    sub_start_date = sub_start_date.split("-");
    var sub_start_date = new Date(sub_start_date[0], sub_start_date[1], sub_start_date[2]);
    /////////////////////////  end sub date rfunctions ///////////////////////////

    $('#rowTable').html('');
    var no_installments = $('#no_of_installments').val();
    var totalAmount = $('#remaining_amount_hidden').val();
    var insAmount = $('#installment_amount').val();
    var possession_val = $('#possession').val();
    var mode = "Cash";
    var customer = $('#customer_name').val();
    var end_date = enddate = $('#end_date').val();

    ////////////////// if mode of payment is empty//////////////
    // insAmount = agreePrice/no_of_months;
    // console.log();




    ///////////////////  if installment amount is empty////////////////
    if (insAmount == null || insAmount == "" || insAmount == 0) {
        // alert("Enter Amount ");
        $('#installment_amount').focus();
        $('#installment_amount').css('border-color', 'red');
        return false;
    }
    /////////////// checking installment amount and the agreed price////////////
    var checking_amount = parseFloat(insAmount) * parseFloat(no_installments);
    if (totalAmount != "" && no_installments != "") {
        if (checking_amount > totalAmount) {
            alert("Amount Not Match According to Installment");
            $('#installment_amount').focus();
            $('#installment_amount').css('border-color', 'red');
            return false;
        } else {
            $('#installment_amount').css('border-color', 'lightgreen');
        }
    }
    $('#installment_amount').css('border-color', 'lightgreen');

    let totalA = totalAmount / no_installments;
    if (mode == "Cash") {
        CashMode(receievedmount, no_installments, start_date, agreePrice, head_months, insAmount, end_date);
    }
    ///////////////////////////////  start the else part  /////////////////////////////////////////
    else

    {
        ChequeMode(receievedmount, no_installments, start_date, agreePrice, head_months, insAmount, customer);
    }
    console.log('check');
    console.log(check);

    for (var j = 1; j <= check; j++) {
        planInstallments(j, 1);
    }


}

function appendCashRows(i, subplanamout, installmentdescription, date) {
    let Tblhtml = '';
    if (installmentdescription === "Booking" && i == 1) {
        // alert(installmentdescription);
        global = global - 1;
        console.log(global);
        let d= $('#day').val();
        Tblhtml = `<tr Cdate="${date}">
        <td class="text-center"></td>
        <td>
           <div class="col-md-12 input-group input-group-sm xs-mb-15">
            <input readonly type="number" class="form-control amount_before_vat${global} "   name="amount[]" value="${subplanamout}" />
           </div>
        </td>
        <td>
           <div class="col-md-12 input-group input-group-sm xs-mb-15">
            <input type="text"  name="particular[]" readonly class="form-control particulars${global}"  value="${installmentdescription}" />
           </div>
        </td>
        <td>
          <div class="col-md-12 input-group input-group-sm xs-mb-15">
           <input  readonly  type="" value="${d}" class="form-control " name="check_date[]" />
          </div>
        </td>
        </tr>`;
    } else {
        Tblhtml = `<tr Cdate="${date}">
                <td class="text-center">${global}</td>
                <td>
                   <div class="col-md-12 input-group input-group-sm xs-mb-15">
                    <input readonly type="number" class="form-control amount_before_vat${global} amount"   name="amount[]" value="${subplanamout}" />
                   </div>
                </td>
                <td>
                   <div class="col-md-12 input-group input-group-sm xs-mb-15">
                    <input type="text"  name="particular[]" readonly class="form-control particulars${global}"  value="${installmentdescription}-${global}" />
                   </div>
                </td>
                <td>
                  <div class="col-md-12 input-group input-group-sm xs-mb-15">
                   <input  readonly  type="date" value="${date}" class="form-control customdate" name="check_date[]" />
                  </div>
                </td>
                </tr>`;
    }
    $('#rowTable').append(Tblhtml);
    ApplyPlans();
}

function appendPossessionRow(global, i, possessionamt, date) {
    let Tblhtml = `<tr id="Prow">
        <td class="text-center">${global+1}</td>
        <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input readonly type="number" class="form-control amount_before_vat${i} " id="amount"  name="amount[]" value="${possessionamt}" />
            </div>
        </td>
        <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input type="text"  name="particular[]" class="form-control particulars${i}" value="Possession Amount" />
            </div>
        </td>
        <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input   type="date" value="${date}" class="form-control" name="check_date[]" />
            </div>
        </td>
        </tr>`;
    $('#rowTable').append(Tblhtml);
}

function appendchequeRows(i, AmountofIns, installmentdescription, customer, date) {
    let Tblhtml = `<tr Cdate="${date}">
        <td class="text-center"> ${i}</td>
        <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input readonly type="number" class="form-control amount_before_vat${i} amount"   name="amount[]" value="${subplanamout}" />
            </div>
        </td>
        <td>
        <div class="col-md-12 input-group input-group-sm xs-mb-15">
            <input type="text"  name="particular[]" readonly class="form-control particulars${i} customdate" value="${installmentdescription}-${i}" />
        </div>
        </td>
        <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input  type="number" name="check_no[]" class="form-control" />
            </div>
        </td>
        <td>
        <div class="col-md-12 input-group input-group-sm xs-mb-15">
            <input readonly  type="date" value="${date}" class="form-control" name="check_date[]" />
        </div>
        </td>
        <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input  type="text" name="check_issue[]" class="form-control"/>
            </div>
        </td>
        <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input class="form-control LandlordName${i}" type="text"  value="${customer}" name="party_name[]" />
            </div>
        </td>
        </tr>`;
    $('#rowTable').append(Tblhtml);
}

function chequePossession(i, possessionamt, date, customer) {
    let Tblhtml = `<tr>
        <td class="text-center">${i}</td>
        <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input readonly type="number" class="form-control amount_before_vat${i} " id="amount"   name="amount[]" value="${possessionamt}" />
            </div>
        </td>
        <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input type="text" readonly  name="particular[]" class="form-control particulars${i}" value="Possession Amount" />
            </div>
        </td>
        <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input type="number" name="check_no[]" class="form-control" />
            </div>
        </td>
        <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input readonly type="date" value="${date}" class="form-control" name="check_date[]" />
            </div>
        </td>
        <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input type="text" name="check_issue[]" class="form-control"/>
            </div>
        </td>
        <td>
            <div class="col-md-12 input-group input-group-sm xs-mb-15">
                <input class="form-control LandlordName${i}" type="text" value="${customer}"  name="party_name[]" />
            </div>
        </td>
        </tr>`;
    $('#rowTable').append(Tblhtml);
}
var global = 0;

function CashMode(receievedmount, no_installments, start_date, agreePrice, head_months, insAmount, end_date) {
    $('#cheque_party').hide();
    $('#cheque_bank').hide();
    $('#cheque').hide();

    ///////////////////////////////////////// start for loop////////////////////////////////////
    if (receievedmount > 0) {
        var no_of_installmentsnew = parseInt(no_installments) + 1;
    } else {
        no_of_installmentsnew = no_installments;
    }
    var pamt = 0;
    global = 0;
    for (var i = 1; i <= no_of_installmentsnew; i++) {
        global++;
        if (head_months == 12) {
            if (i == 1) {
                //////////// if we get advance amount //////////////
                if (receievedmount > 0) {
                    var AmountofIns            = receievedmount;
                    var subplanamout           = AmountofIns;
                    var installmentdescription = "Booking";
                    console.log("1");
                    console.log(subplanamout);

                } else {
                    AmountofIns            = insAmount;
                    subplanamout           = AmountofIns;
                    installmentdescription = "Installment ";
                    console.log("2");
                }
                ///////////////////////// end after get advance amount //////////
                start_date.setYear(start_date.getFullYear());
            } else {
                if (receievedmount > 0) {
                    installmentdescription = "Installment";
                    AmountofIns            = insAmount;
                    subplanamout           = AmountofIns;
                    console.log("3");
                }
                if(global===1)
                {

                }
                else
                {
                    start_date.setYear(start_date.getFullYear() + 1);
                }

            }
            // console.log(start_date.setYear(start_date.getFullYear()+1));

            var date = (start_date.getMonth() == 0 ? `${start_date.getFullYear()-1}` : `${start_date.getFullYear()}`) + '-' + (start_date.getMonth() <= 9 ? `${start_date.getMonth()==0 ? `12` : `0${start_date.getMonth()}`}` : `${start_date.getMonth()}`) + '-' + (start_date.getDate() <= 9 ? `0${start_date.getDate()}` : `${start_date.getDate()}`);

            if (date > end_date) {
                alert("Can't Make a Installments Beacause End Date is: " + end_date);
                $('#end_date').focus();
                $('#end_date').css('border-color', 'red');
                return false;
            } else {
                $('#end_date').css('border-color', 'lightgreen');
            }
            // HeadMonthsYearly(i,head_months,receievedmount,insAmount,start_date);
        } else {
            console.log('less than 12 months');
            console.log(start_date.getMonth());
            if (i === 1) {
                if (receievedmount > 0) {
                    var AmountofIns = receievedmount;
                    subplanamout    = AmountofIns;
                    var installmentdescription = "Booking";
                } else {
                    AmountofIns  = insAmount;
                    subplanamout = AmountofIns;
                    installmentdescription = "Installment";
                }
                // start_date.setMonth(start_date.getMonth());
            } else {
                if (receievedmount > 0) {
                    installmentdescription = "Installment";
                    AmountofIns  = insAmount;
                    subplanamout = AmountofIns;
                }
                if(global===1)
                {

                }
                else
                {
                    start_date.setMonth(start_date.getMonth() + parseInt(head_months));
                }

            }
            var date = (start_date.getMonth() == 0 ? `${start_date.getFullYear()-1}` : `${start_date.getFullYear()}`) + '-' + (start_date.getMonth() <= 9 ? `${start_date.getMonth()==0 ? `12` : `0${start_date.getMonth()}`}` : `${start_date.getMonth()}`) + '-' + (start_date.getDate() <= 9 ? `0${start_date.getDate()}` : `${start_date.getDate()}`);
            if (date > end_date) {
                alert("Can't Make a Installments Because End Date is: " + end_date);
                $('#end_date').focus();
                $('#end_date').css('border-color', 'red');
                return false;
            } else {
                $('#end_date').css('border-color', 'lightgreen');
            }
        }

        ////////////////// calculating amount of possession ///////////////////
        pamt += parseInt(subplanamout);
        appendCashRows(i, subplanamout, installmentdescription, date);
    }

    //////////////////  assign value to the possession amount/////////////////////////


    totalInstallmentAmount(agreePrice, pamt);
    var possessionamt = parseInt(agreePrice) - pamt;
    $('#possession').val(possessionamt);
    /////////////// end possession amount areaa////////////////////
    console.log('agreePrice');
    console.log(agreePrice);
    console.log('pamt');
    console.log(pamt);
    if (possessionamt > 0) {
        appendPossessionRow(global, i, possessionamt, date);
    }
}

function ChequeMode(receievedmount, no_installments, start_date, agreePrice, head_months, insAmount, customer) {
    $('#cheque_party').show();
    $('#cheque_bank').show();
    $('#cheque').show();

    if (receievedmount > 0) {
        var no_of_installmentsnew = parseInt(no_installments) + 1;
    } else {
        no_of_installmentsnew = no_installments;
    }
    ///////////////// loop for the else part ///////////
    var pamt = 0;
    for (var i = 1; i <= no_of_installmentsnew; i++) {
        if (head_months === 12) {
            HeadMonthsYearly(i, head_months, receievedmount, insAmount, start_date);
        } else {
            console.log(start_date.getMonth());
            if (i === 1) {
                if (receievedmount > 0) {
                    var AmountofIns = receievedmount;
                    subplanamout = AmountofIns;
                    var installmentdescription = "Booking";
                } else {
                    AmountofIns = insAmount;
                    subplanamout = AmountofIns;
                    installmentdescription = "Installment ";
                }
                start_date.setMonth(start_date.getMonth());
            } else {
                if (receievedmount > 0) {
                    installmentdescription = "Installment";
                    AmountofIns = insAmount;
                    subplanamout = AmountofIns;
                }
                start_date.setMonth(start_date.getMonth() + parseInt(head_months));
            }

            var date = (start_date.getMonth() == 0 ? `${start_date.getFullYear()-1}` : `${start_date.getFullYear()}`) + '-' + (start_date.getMonth() <= 9 ? `${start_date.getMonth()==0 ? `12` : `0${start_date.getMonth()}`}` : `${start_date.getMonth()}`) + '-' + (start_date.getDate() <= 9 ? `0${start_date.getDate()}` : `${start_date.getDate()}`);
            if (date > end_date) {
                alert("Can't Make a Installments Beacause End Date is: " + end_date);
                $('#end_date').focus();
                $('#end_date').css('border-color', 'red');
                return false;
            } else {
                $('#end_date').css('border-color', 'lightgreen');
            }
            ////////////////// calculating amount of possession ///////////////////
        }

        pamt += parseInt(subplanamout);
        appendchequeRows(i, AmountofIns, installmentdescription, customer, date);

    }
    totalInstallmentAmount(agreePrice, pamt);
    var possessionamt = parseInt(agreePrice) - pamt;
    $('#possession').val(possessionamt);

    if (possessionamt > 0) {
        chequePossession(i, possessionamt, date, customer);
    }
}

function HeadMonthsYearly(i, head_months, receievedmount, insAmount, start_date) {
    if (i == 1) {
        //////////// if we get advance amount //////////////
        if (receievedmount > 0) {
            var AmountofIns = receievedmount;
            var subplanamout = AmountofIns;

            var installmentdescription = "Booking";
            console.log("1");
            console.log(subplanamout);

        } else {
            AmountofIns = insAmount;
            subplanamout = AmountofIns;
            installmentdescription = "Installment ";
            console.log("2");
        }
        ///////////////////////// end after get advance amount //////////
        start_date.setYear(start_date.getFullYear());
    } else {
        if (receievedmount > 0) {
            installmentdescription = "Installment";
            AmountofIns = insAmount;
            subplanamout = AmountofIns;
            console.log("3");
        }
        start_date.setYear(start_date.getFullYear() + 1);
    }
    // console.log(start_date.setYear(start_date.getFullYear()+1));

    var date = (start_date.getMonth() == 0 ? `${start_date.getFullYear()-1}` : `${start_date.getFullYear()}`) + '-' + (start_date.getMonth() <= 9 ? `${start_date.getMonth()==0 ? `12` : `0${start_date.getMonth()}`}` : `${start_date.getMonth()}`) + '-' + (start_date.getDate() <= 9 ? `0${start_date.getDate()}` : `${start_date.getDate()}`);

    if (date > end_date) {
        alert("Can't Make a Installments Beacause End Date is: " + end_date);
        $('#end_date').focus();
        $('#end_date').css('border-color', 'red');
        return false;
    } else {
        $('#end_date').css('border-color', 'lightgreen');
    }
}

function totalInstallmentAmount(agreePrice, pamt) {
    if (pamt > agreePrice) {
        alert("Amount Not Match According to Installment");
        return false;
    } else {

    }
}

var check = 1;

function planInstallments(counter, val, e) {
    let event = $(e);
    let rowParent = event.parent().parent();
    let selection = event.find("option:selected").attr("dmonths");
    if (selection === '-1') {
        rowParent.find('.plandecsion').html(`
          <div class="col-md-3"  id="replacement_date${counter}">
      <label class="text-primary">Replacement Date</label>
      <select class="select2 appenddates" >

      </select>
      </div>
    <div class="col-md-3">
      <label for="" class="text-primary">Installment Amount</label>
      <div class="col-md-12 input-group input-group-sm xs-mb-15">
          <input type="number" class="form-control" onkeyup="planInstallments(${counter},0)"  name="" placeholder="0" id="sub_installment_amount${counter}" value="">
                </div>
            </div>

            <div class="col-md-3">
             <br><br>
            <a class="btn btn-danger delete-row" id="delete_row" onclick="delete_row(${counter})">
              <i class="fa fa-trash"></i>
            </a>
            </div>
        `);
        $(".customdate").html('');
        $('.customdate').each(function () {
            rowParent.find('.appenddates').append(`
             <option value="${$(this).val()}">${$(this).val()}</option>
           `);
        })
        App.formElements();
    } else {
        rowParent.find('.plandecsion').html(`
      <div class="col-md-3">
      <label for="" class="text-primary">Installment Amount</label>
      <div class="col-md-12 input-group input-group-sm xs-mb-15">
          <input type="number" class="form-control" onkeyup="planInstallments(${counter},0)"  name="" placeholder="0" id="sub_installment_amount${counter}" value="">
        </div>
    </div>
    <div class="col-md-3">
             <br><br>
    <a class="btn btn-danger delete-row" id="delete_row" onclick="delete_row(${counter})">
      <i class="fa fa-trash"></i>
    </a>
    </div>
        `);
        App.formElements();
    }
    if (val === 1) {

    } else {
        check = counter;
    }
    console.log('check');
    console.log(check);
    var end_date        = $('#end_date').val();
    var s_date          = $('#start_date').val();
    s_date              = s_date.split("-");
    var start_date      = new Date(s_date[0], s_date[1], s_date[2]);
    var subheadmonths   = $('#sub_head_id' + counter).val();
    var subinsAmount    = $('#sub_installment_amount' + counter).val();
    var agreed          = $('#agreed_price').val();
    var discount        = $('#discount').val();
    agreed              = agreed - discount;
    var subhead_months  = $("#sub_head_id" + counter + " option:selected").attr("dmonths");
    var no_installments = $('#no_of_installments').val();
    var rowselect       = [];

    if (subhead_months === -1) {

    } else {

    }
    rowselect = [];
    for (var i = 1; i <= no_installments; i++) {
        start_date.setMonth(start_date.getMonth() + parseInt(subhead_months));
        var date = (start_date.getMonth() == 0 ? `${start_date.getFullYear()-1}` : `${start_date.getFullYear()}`) + '-' + (start_date.getMonth() <= 9 ? `${start_date.getMonth()==0 ? `12` : `0${start_date.getMonth()}`}` : `${start_date.getMonth()}`) + '-' + (start_date.getDate() <= 9 ? `0${start_date.getDate()}` : `${start_date.getDate()}`);
        if (end_date > date) {
            rowselect.push(date);
        }
    }
    console.log(rowselect);
    if (selection == '-1') {
        rowselect = [];
        rowselect.push(rowParent.find('.appenddates ').val());
        console.log('rowselect');
        console.log(rowselect);
        return;
    }

    rowselect.forEach(function (date) {
        var a = $(`tr[Cdate=${date}]`);
        var assignamount = a.find('.amount');
        assignamount.val(subinsAmount);
    })
    var tamount = 0;
    $('.amount').each(function () {
        tamount += parseInt($(this).val());
    })
   var r = $('#received').val();
    $('#possession').val(agreed - tamount-r);
    if (agreed - tamount > 0) {
        $('#amount').val(agreed - tamount-r);
    }



    if (tamount > agreed) {
        alert("Can't Make Installment Installment Amount Not Match With Agreed Price");
        return false;
    }
    // MakingInstallments(0);
}


$('body').on('change', '.Installmentsplan', function () {
    let selection = $(this).find("option:selected").attr("dmonths");
    let rowParent = $(this).parent().parent();
    if (selection === '-1') {
        rowParent.find('.plandecsion').html(`
          <div class="col-md-3"  id="replacement_date">
      <label class="text-primary">Replacement Date</label>
      <select class="select2 appenddates" >

      </select>
      </div>
    <div class="col-md-3">
      <label for="" class="text-primary">Installment Amount</label>
      <div class="col-md-12 input-group input-group-sm xs-mb-15">
          <input type="number" class="form-control installmentAmount"  name="" placeholder="0" id="sub_installment_amount" value="">
                </div>
            </div>

            <div class="col-md-3">
             <br><br>
            <a class="btn btn-danger delete-row" id="delete_row" >
              <i class="fa fa-trash"></i>
            </a>
            </div>
        `);
        $(".customdate").html('');
        $('.customdate').each(function () {
            rowParent.find('.appenddates').append(`
             <option value="${$(this).val()}">${$(this).val()}</option>
           `);
        })
        App.formElements();
    } else {
        rowParent.find('.plandecsion').html(`
  <div class="col-md-3"  id="replacement_date">
      <label class="text-primary">Plan Start Date</label>
      <select class="select2 appenddates2" >

      </select>
      </div>
      <div class="col-md-3">
      <label for="" class="text-primary">Installment Amount</label>
      <div class="col-md-12 input-group input-group-sm xs-mb-15">
          <input type="number" class="form-control installmentAmount"   name="" placeholder="0" id="sub_installment_amount" value="">
        </div>
    </div>
    <div class="col-md-3">
             <br><br>
            <a class="btn btn-danger delete-row" id="delete_row" >
              <i class="fa fa-trash"></i>
            </a>
            </div>
        `);
        $(".customdate").html('');
        $('.customdate').each(function () {
            rowParent.find('.appenddates2').append(`
             <option value="${$(this).val()}">${$(this).val()}</option>
           `);
        })
        App.formElements();
    }
})

$('body').on('change', '.installmentAmount', function () {

    ResetTable();
    ApplyPlans();

})
var default_amount = 0;
var default_row = null;
$('body').on('keyup', '.installmentAmountcustom', function () {
    var parent = $(this).parent().parent().parent().parent();
    let head = parent.find(".Installmentsplan").val();
    let appenddate = parent.find(".appenddates ").val();
    // alert(appenddate);
    let planamount = $(this).val();
    var end_date = $('#end_date').val();
    var s_date = $('#start_date').val();
    s_date = s_date.split("-");
    var start_date = new Date(s_date[0], s_date[1], s_date[2]);
    var agreed = $('#agreed_price').val();
    var discount = $('#discount').val();
    agreed = agreed - discount;
    var no_installments = $('#no_of_installments').val();
    var rowselect = [];

    // if(default_row)
    // {
    //     default_row.find('.amount').val($('.default_installment_amount').val());
    //
    // }
    rowselect.push(appenddate);
    rowselect.forEach(function (appenddate) {
        var a = $(`tr[Cdate=${appenddate}]`);
        default_row = a;
        var assignamount = a.find('.amount');
        assignamount.val(planamount);
    })
})



function RerendarRows(planamount, rowselect) {
    console.log('rowselect');
    console.log(rowselect);
    var agreed   = $('#agreed_price').val();
    var discount = $('#discount').val();
    agreed       = agreed - discount;
    var cc=0;
    rowselect.forEach(function (date) {
        var change_amount = 0;
        var a = $(`tr[Cdate=${date}]`);
        var assignamount  = a.find('.amount');
         change_amount = a.find('.amount').val();
        console.log('change_amount');
        console.log(parseInt(planamount));
        console.log(parseInt(change_amount));
        // if(change_amount===NaN || change_amount==="NaN" || change_amount<0 || change_amount=="")
        // {
        //     change_amount=0;
        // }
        // let res = parseInt(planamount)+parseInt(change_amount);
        assignamount.val(planamount);
        // assignamount.val(parseInt(planamount)+parseInt(change_amount));
        cc++;
    });
    // alert(cc);
    var tamount = 0;
    $('.amount').each(function () {
        tamount += parseInt($(this).val());
    })
    if (agreed - tamount == 0) {
        $('#Prow').remove();
    }
    if (tamount > agreed) {
        alert("Can't Make Installment Installment Amount Not Match With Agreed Price");
        return false;
    }
    var r = $('#received').val();
    $('#possession').val(agreed - tamount-r);
    $('#amount').val(agreed - tamount-r);
}

function ResetTable() {
    MakingInstallments(0);
}

function ApplyPlans() {
    $('body').find('.planRow').each(function () {
        var dates = [];
        let row = $(this);
        let plan = row.find('.Installmentsplan').val();
        let amount = row.find('.installmentAmount').val();

        if (plan == -1) {
            dates = [];
            let date = row.find('.appenddates').val();
            dates.push(date);

        } else {

            dates = [];
            var no_installments = $('#no_of_installments').val();
            // var s_date          = $('#start_date').val();
            var s_date          = $('.appenddates2').val();
            console.log(s_date);
            s_date              = s_date.split("-");
            var start_date      = new Date(s_date[0], s_date[1], s_date[2]);
            var end_date        = $('#end_date').val();
            var head            = plan;
            for (var i = 1; i <= no_installments; i++)
            {
                if(i==1)
                {
                    start_date.setMonth(start_date.getMonth() );
                }
                else
                {
                    start_date.setMonth(start_date.getMonth() + parseInt(head));
                }
                var date = (start_date.getMonth() == 0 ? `${start_date.getFullYear()-1}` : `${start_date.getFullYear()}`) + '-' + (start_date.getMonth() <= 9 ? `${start_date.getMonth()==0 ? `12` : `0${start_date.getMonth()}`}` : `${start_date.getMonth()}`) + '-' + (start_date.getDate() <= 9 ? `0${start_date.getDate()}` : `${start_date.getDate()}`);
                if (end_date > date)
                {
                    dates.push(date);
                }
            }

        }
        RerendarRows(amount, dates);

        $('.amount').each(function (){
           var amount= $(this).val();
           if(amount.length==0)
           {
               $(this).val($('.default_installment_amount').val());
           }
        });
        var tamount = 0;
        $('.amount').each(function () {
            tamount += parseInt($(this).val());
        });
        let agreed = $('#agreed_price').val();
        let discount = $('#discount').val();
        agreed = agreed -discount;
        if (agreed - tamount == 0) {
            $('#Prow').remove();
        }
        if (tamount > agreed) {
            alert("Can't Make Installment Installment Amount Not Match With Agreed Price");
            return false;
        }
        var r = $('#received').val();
        $('#possession').val(agreed - tamount-r);
        $('#amount').val(agreed - tamount-r);
    })
}
