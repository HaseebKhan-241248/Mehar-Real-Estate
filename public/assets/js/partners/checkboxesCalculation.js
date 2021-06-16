$(document).ready(function(){
    //initialize the javascript
    // App.init();
    App.dataTables();
    App.formElements();
});
/////////////////////// for the scroll ////////////////
window.onscroll = function() {myFunction()};
var header = document.getElementById("header");
var sticky = header.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}




$('body').on('change','.daysend',function(){
    $('#day').val($(this).val());
});
$('body').on('keyup','.amouny_payTo_partner',function()
{
    let amount        = $(this).val();
    $('#amount_paid_to_partner').val(amount);
    var amount_paid  = $('#partner_amount');
    if (parseInt(amount) === parseInt(amount_paid))
    {
        document.getElementById("pay_to_partner").disabled = false;
    }
    else
    {
        document.getElementById("pay_to_partner").disabled = true;
    }
});





$('body').on('click','.checkboxClass',function()
{
    var amount_paid  = $('#partner_amount').val();
    var amount_payto = $('#amouny_payTo_partner').val();
    if(amount_payto==0)
    {
        alert("Please Enter the Amount First");
        $('#amouny_payTo_partner').focus();
        return;
    }
    $('#day').val($('daysend').val());
    $('#amount_paid_to_partner').val(amount_payto);
    var amount_paying = 0;

    if($(this).prop("checked") === true)
    {
        amount_paying = $(this).attr("data_amount");
        $(this).parent().parent().find('.CustomAmount').val(amount_paying);
        console.log(parent);
        $('#partner_amount').val(parseInt(amount_paid) + parseInt(amount_paying));

    }
    else if($(this).prop("checked") === false)
    {
        $(this).parent().parent().find('.CustomAmount').val("0");
        amount_paying = $(this).attr("data_amount");
        $('#partner_amount').val(parseInt(amount_paid) - parseInt(amount_paying));
    }

    var amount_paid_new  = $('#partner_amount').val();
    console.log(parseInt(amount_payto));
    console.log(parseInt(amount_paid_new));
    if (parseInt(amount_payto) === parseInt(amount_paid_new))
    {
        document.getElementById("pay_to_partner").disabled = false;
    }
    else
    {
        document.getElementById("pay_to_partner").disabled = true;
    }
});

function checkTotal()
{
    var amount_paid_new  = $('#partner_amount').val();
    var amount_payto = $('#amouny_payTo_partner').val();
    console.log(parseInt(amount_payto));
    console.log(parseInt(amount_paid_new));
    if (parseInt(amount_payto) === parseInt(amount_paid_new))
    {
        document.getElementById("pay_to_partner").disabled = false;
    }
    else
    {
        document.getElementById("pay_to_partner").disabled = true;
    }
}

//////////////   for the paying payment //////////////////////////
$('body').on('click','.pay_to_partner',function(){
    $('#saveBtn').click();
});

function validateForm() {
    var amount_paid_new  = $('#partner_amount').val();
    $('#day').val($('#daysend').val());
    $('#partner_id').val($('#partner').val());
    $('#account_id').val($('#on_account_of').val());
    if($('#on_account_of').val()=='' || $('#on_account_of').val()==null)
    {
        alert("Please Select the Account");
        return false;
    }
    if (amount_paid_new==0) {
        alert("Please Checked the Checkboxes");
        return false;
    }
}

////////////////////////////////////////  for the custom amount for partner paying/////////////////////////////
function TotalAmount()
{
    var amt = 0;
 $('.CustomAmount').each(function()
 {
     amt += parseInt($(this).val());
 });
 $('#partner_amount').val(amt);
//  console.log(amt);
checkTotal();
}
