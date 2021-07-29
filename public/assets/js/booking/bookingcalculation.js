function calc()
{
    var token_amount  = $('#token_amount').val();
    var discount      = $('#discount').val();
    var intiqalg      = $('#intiqal_g').val();
    var agree_price   = $('#agreed_price').val();
    var marla         = $('#size_name').val();
    var marketer_comm = $('#marketer_commision_per').val();
    var dealer_comm   = $('#dealer_commision_per').val();
    var mar_dea_comm  = 15/100;
    //// total rcvd amount
    var receieved_amt = $('#received').val();
    if (typeof receieved_amt == "Nan")
    {
        receieved_amt = 0;
    }
    agree_price = agree_price-discount;
    var partner_per   = $('#partner_percent').val();
    /// amount paid to partner

    var rcvdamount    = $('#partner_amount').val();
    var percentage    = partner_per/100;

    if (marla==null || marla=="")
    {
        alert("Please Enter the Plot size ");
        $('#size_name').focus();
        $('#size_name').css('border-color','red');
        return false;
    }
    else
    {

        /////////////// calculating the rate per marlaa /////////////////

        $('#size_name').css('border-color','white');
        var rate_per_marla = parseFloat(agree_price) / parseFloat(marla);

        $('#rate_marla').val(rate_per_marla.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#rate_marla_hidden').val(rate_per_marla.toFixed(2));
        $('#total_amount').val(agree_price);

        ////////////////// calculating the remaing amount ///////////////

        var remaining = parseFloat(agree_price) - receieved_amt;
        $('#remaining_amount').val(remaining.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#remaining_amount_hidden').val(remaining.toFixed(2));

        /////////////////// partener amount A//////////////////

        var rcvdamount= parseFloat(agree_price) * parseFloat(percentage);
        $('#partner_amount').val(rcvdamount.toFixed(2));
        var partnerA    = parseFloat(receieved_amt) * parseFloat(percentage);

        $('#partner_amount_a').val(partnerA.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#partner_amount_a_hidden').val(partnerA.toFixed(2));

        ///////////////// difference of partner amount////////////////

        var diff_partner  = parseFloat(rcvdamount)-partnerA;
        $('#equity_difference').val(diff_partner.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#equity_difference_hidden').val(diff_partner.toFixed(2));

        /////////////////// calculation intiqal (A) /////////////////////
        console.log('percentage');
        console.log(percentage);
        console.log('rate_per_marla');
        console.log(rate_per_marla);
        var intiqalA = parseFloat(rate_per_marla);
        console.log('intiqalA');
        console.log(intiqalA.toFixed(2));
        var intiqalA2 = receieved_amt/intiqalA.toFixed(2);
        var intiqalA3 = agree_price/intiqalA.toFixed(2);

        $("#intiqal_g").attr('max',intiqalA2);
        console.log('see');
        console.log($("#intiqal_g").attr('max'));
        $('#intiqal_g').val(intiqalA2.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#intiqal_a').val(intiqalA3.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#intiqal_a_hidden').val(intiqalA3.toFixed(2));

        /////////////////////////// calculate dp% ///////////////////

        var dp_percent = receieved_amt/agree_price;
        $('#dp_per').val((dp_percent*100).toFixed(2));

        ///////////////////// calculate intiqal difference //////////////

        var in_diff =  intiqalA2 - intiqalA3;

        $('#intiqal_diff').val(in_diff.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#intiqal_diff_hidden').val(in_diff.toFixed(2));

        ////////////////// calculate marketer commision ///////////////////

        var marketer_percenage = parseFloat(marketer_comm)/100;
        var m_comm_val         = parseFloat(agree_price) * marketer_percenage;

        $('#marketer_commision_value').val(m_comm_val.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#marketer_commision_value_hidden').val(m_comm_val.toFixed(2));

        /////////////////// calculate dealer commision////////////////

        var dealer_percenage = parseFloat(dealer_comm)/100;
        var d_comm_val       = parseFloat(agree_price) * dealer_percenage;

        $('#dealer_commision_value').val(d_comm_val.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#dealer_commision_value_hidden').val(d_comm_val.toFixed(2));

        ///////////////////////////  marketer commision value////////////
        var mar_comm = parseFloat(mar_dea_comm) * parseFloat(receieved_amt);

        $('#marketer_coms_formula').val(mar_comm.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#marketer_coms_formula_hidden').val(mar_comm.toFixed(2));

        $('#marketer_commision_due').val(mar_comm.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#marketer_commision_due_hidden').val(mar_comm.toFixed(2));

        $('#coms_formula').val(mar_comm.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#coms_formula_hidden').val(mar_comm.toFixed(2));
        ////////////////////////////  dealer commision value////////////
    }
}
$("body").on('keyup','.intiqal_given',function (){
   var intiqal_given = $(this).val();
   var intiqal_actual = $('#intiqal_a').val();
   $('#intiqal_diff').val(intiqal_given-intiqal_actual);
   $('#intiqal_diff_hiddens').val(intiqal_given-intiqal_actual);
});



