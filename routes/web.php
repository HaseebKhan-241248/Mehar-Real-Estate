<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something ugreat!
|
*/

//Route::group(['middleware' => ['auth', 'twofactor']]);
//Route::group(['middleware' => 'twofactor'], function () {
Route::get('verify/resend', [App\Http\Controllers\Auth\TwoFactorController::class, 'resend'])->name('verify.resend');
//Route::resource('verify',[App\Http\Controllers\Auth\TwoFactorController::class])->only(['index','store']);
Route::get('verify', [App\Http\Controllers\Auth\TwoFactorController::class,'index'])->name('verify.index');
Route::post('verify', [App\Http\Controllers\Auth\TwoFactorController::class,'store'])->name('verify.store');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'twofactor'], function () {

       /////////////////////////////////  voucher controller  /////////////////////////////////
        Route::get('/journal-vouchers-list',[\App\Http\Controllers\Voucher\VoucherController::class,'journal_voucher'])->name('journal.voucher');
        Route::get('/create-journal-voucher',[\App\Http\Controllers\Voucher\VoucherController::class,'create_journal_voucher'])->name('create.journal_voucher');
        Route::post('/save-journal-voucher',[\App\Http\Controllers\Voucher\VoucherController::class,'save_journal_voucher'])->name('save.journal_voucher');
        Route::get('/edit-journal-voucher/{id}',[\App\Http\Controllers\Voucher\VoucherController::class,'edit_journal_voucher'])->name('edit.journal_voucher');
        Route::post('/update-journal-voucher',[\App\Http\Controllers\Voucher\VoucherController::class,'update_journal_voucher'])->name('update.journal_voucher');
        Route::get('/delete-journal-voucher/{id}',[\App\Http\Controllers\Voucher\VoucherController::class,'delete_journal_voucher'])->name('delete.journal_voucher');
        Route::get('/journal_voucher_print/{id}',[\App\Http\Controllers\Voucher\VoucherController::class,'journal_voucher_print'])->name('journal_voucher_print');

        Route::get('/bank-receipt-vouchers-list',[\App\Http\Controllers\Voucher\VoucherController::class,'bank_receipt_voucherr'])->name('bank-receipt.voucher');
        Route::get('/create-bank-receipt-voucher',[\App\Http\Controllers\Voucher\VoucherController::class,'create_bank_receipt_voucher'])->name('create.bank_receipt_voucher');
        Route::post('/save-bank-receipt-voucher',[\App\Http\Controllers\Voucher\VoucherController::class,'save_bank_receipt_voucher'])->name('save.bank_receipt_voucher');
        Route::get('/delete-bank-receipt-voucher/{id}',[\App\Http\Controllers\Voucher\VoucherController::class,'delete_bank_receipt_voucher'])->name('delete.bank_receipt_voucher');
        Route::get('/edit-bank-receipt-voucher/{id}',[\App\Http\Controllers\Voucher\VoucherController::class,'edit_bank_receipt_voucher'])->name('edit.bank_receipt_voucher');
        Route::post('/update-bank-receipt-voucher',[\App\Http\Controllers\Voucher\VoucherController::class,'update_bank_receipt_voucher'])->name('update.bank_receipt_voucher');
        Route::get('/bank_receipt_voucher_print/{id}',[\App\Http\Controllers\Voucher\VoucherController::class,'bank_receipt_voucher_print'])->name('bank_receipt_voucher_print');

        Route::get('/cash-vouchers-list',[\App\Http\Controllers\Voucher\VoucherController::class,'cash_voucher_list'])->name('cash.voucher');
        Route::get('/create-cash-voucher',[\App\Http\Controllers\Voucher\VoucherController::class,'create_cash_voucher'])->name('create.cash_voucher');
        Route::post('/save-cash-voucher',[\App\Http\Controllers\Voucher\VoucherController::class,'save_cash_voucher'])->name('save.cash_voucher');
        Route::get('/delete-cash-voucher/{id}',[\App\Http\Controllers\Voucher\VoucherController::class,'delete_cash_voucher'])->name('delete.cash_receipt_voucher');
        Route::get('/edit-cash-voucher/{id}',[\App\Http\Controllers\Voucher\VoucherController::class,'edit_cash_voucher'])->name('edit.cash_receipt_voucher');
        Route::post('/update-cash-voucher',[\App\Http\Controllers\Voucher\VoucherController::class,'update_cash_voucher'])->name('update.cash_receipt_voucher');

        Route::get('debit-voucher',[\App\Http\Controllers\Voucher\VoucherController::class,'debit_voucher_list'])->name('debit.voucher');
        Route::get('/create-debit-voucher',[\App\Http\Controllers\Voucher\VoucherController::class,'create_debit_voucher'])->name('create.debit_voucher');
        Route::post('/save-debit-voucher',[\App\Http\Controllers\Voucher\VoucherController::class,'save_debit_voucher'])->name('save.debit_voucher');
        Route::get('/delete-debit-voucher/{id}',[\App\Http\Controllers\Voucher\VoucherController::class,'delete_debit_voucher'])->name('delete.debit_voucher');
        Route::get('/edit-debit-voucher/{id}',[\App\Http\Controllers\Voucher\VoucherController::class,'edit_debit_voucher'])->name('edit.debit_voucher');
        Route::post('/update-debit-voucher',[\App\Http\Controllers\Voucher\VoucherController::class,'update_debit_voucher'])->name('update.debit_voucher');

        /////////////////////////// admin contorller ////////////////////////////////////\

        Route::get('/update-permission',[App\Http\Controllers\Admin\AdminController::class, 'update_permission']);
        Route::get('/assign-project',[App\Http\Controllers\Admin\AdminController::class, 'assign_project'])->name('assign.project');
        Route::post('/save-assign-project',[App\Http\Controllers\Admin\AdminController::class, 'save_assign_project'])->name('save.assign_project');

        Route::get('/user-profile/{id}',[App\Http\Controllers\Admin\AdminController::class, 'profile_page'])->name('profile.page');
        Route::post('/adimn_password_update',[App\Http\Controllers\Admin\AdminController::class, 'update_profile_page'])->name('adimn.password.update');

        Route::get('/users-list',[App\Http\Controllers\Admin\AdminController::class, 'users_list'])->name('users.list');
        Route::get('/create-user',[App\Http\Controllers\Admin\AdminController::class, 'create'])->name('create.user');

        Route::get('/edit-user/{id}',[App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('edit.user');

        Route::post('/save-user',[App\Http\Controllers\Admin\AdminController::class, 'store'])->name('save.users');
        Route::post('/update-user',[App\Http\Controllers\Admin\AdminController::class, 'update'])->name('update.users');

        ///////////////////////////////   Dashboard Controller ///////////////////////////////
        Route::get('/', [\App\Http\Controllers\Dashboard\DashboardController::class, 'dashboard'])->name('dashboard.index');

        //////////////////////////////     Accounts Controller //////////////////////////////
        Route::get('/create-account', [\App\Http\Controllers\Accounts\AccountsController::class, 'index'])->name('add.accounts');
        Route::post('/save-account', [\App\Http\Controllers\Accounts\AccountsController::class, 'store'])->name('save.account');
        Route::get('/accounts-list', [\App\Http\Controllers\Accounts\AccountsController::class, 'list'])->name('list.accounts');
        Route::get('/edit-accounts/{id}', [\App\Http\Controllers\Accounts\AccountsController::class, 'edit'])->name('edit.account');

        Route::get('/subaccount-category-list', [\App\Http\Controllers\Accounts\AccountsController::class, 'account_subcategory_list'])->name('account.subcategory');
        Route::get('/edit-subaccount-category/{id}', [\App\Http\Controllers\Accounts\AccountsController::class, 'edit_account_subcategory'])->name('account.editsubcategory');
        Route::get('/create-subaccount-category', [\App\Http\Controllers\Accounts\AccountsController::class, 'create_account_subcategory'])->name('create.subaccount_category');
        Route::post('/save-subaccount-category', [\App\Http\Controllers\Accounts\AccountsController::class, 'save_account_subcategory'])->name('save.subaccount_category');
        Route::get('/delete-subaccount-category/{id}', [\App\Http\Controllers\Accounts\AccountsController::class, 'delete_account_subcategory'])->name('delete.subaccount_category');
        Route::get('/getSubacc_categories/{id}', [\App\Http\Controllers\Accounts\AccountsController::class, 'getSubacc_categories'])->name('getSubacc_category');


        ////////////////////////  Project Controller ///////////////////////////////////////////////////////
        Route::get('/projects-list',[\App\Http\Controllers\Projects\ProjectController::class,'list'])->name('project.list');
        Route::post('/save-projects',[\App\Http\Controllers\Projects\ProjectController::class,'store'])->name('save.project');

        //////////////////////////// sector controller /////////////////////////////////////////////////
        Route::get('/sectors-list',[\App\Http\Controllers\Sector\SectorController::class,'list'])->name('sector.list');
        Route::post('/save-sectors',[\App\Http\Controllers\Sector\SectorController::class,'store'])->name('save.sector');
        Route::get('/get_sectors/{id}',[\App\Http\Controllers\Sector\SectorController::class,'get_sectors'])->name('get.sectors');


        ////////////////////////////////////   Block COntroller //////////////////////////////////
        Route::get('/blocks-list',[\App\Http\Controllers\Block\BlockController::class,'list'])->name('block.list');
        Route::post('/save-blocks',[\App\Http\Controllers\Block\BlockController::class,'store'])->name('save.block');
        Route::get('/get_blocks/{id}',[\App\Http\Controllers\Block\BlockController::class,'get_blocks'])->name('get.blocks');


        ////////////////////////////////////////   plot controller here ///////////////////////////////////////////////
        Route::get('/plots-list',[\App\Http\Controllers\Plots\PlotController::class,'list'])->name('plot.list');
        Route::post('/save-plots',[\App\Http\Controllers\Plots\PlotController::class,'store'])->name('save.plot');
        Route::get('/get_plots/{id}',[\App\Http\Controllers\Plots\PlotController::class,'get_plots'])->name('get.plots');
        Route::get('/plot-detail/{id}',[\App\Http\Controllers\Plots\PlotController::class,'plot_detail'])->name('plot.detail');

        ///////////////////////////////// marla controller ///////////////////////////////////
        Route::get('/marla-list',[\App\Http\Controllers\Marlas\MarlaController::class,'list'])->name('marla.list');
        Route::get('/get_plot_marla/{id}',[\App\Http\Controllers\Marlas\MarlaController::class,'getMarla'])->name('get_plot.marla');
        Route::post('/save-marla',[\App\Http\Controllers\Marlas\MarlaController::class,'store'])->name('save.marla');

        /////////////////////////////// partners controller /////////////////////////////////
        Route::get('/partners-share',[\App\Http\Controllers\Partners\PartnerController::class,'partners_share'])->name('partners.share');
        Route::post('/partner-amount_detail',[\App\Http\Controllers\Partners\PartnerController::class,'partner_amount_detail'])->name('partner.amount_detail');

        Route::get('/partners-list',[\App\Http\Controllers\Partners\PartnerController::class,'list'])->name('partners.list');
        Route::post('/save-partner',[\App\Http\Controllers\Partners\PartnerController::class,'store'])->name('save.partner');

        Route::post('/pay-to-partner',[\App\Http\Controllers\Partners\PartnerController::class,'payToPartner'])->name('pay.partnerAmount');
///////////////////////////////////////////////////  customer controller /////////////////////////////////////////////
        Route::get('/customers-list',[\App\Http\Controllers\Customers\CustomerController::class,'list'])->name('customers.list');
        Route::post('/save-customers',[\App\Http\Controllers\Customers\CustomerController::class,'store'])->name('save.customer');
        Route::get('/customer-idcard-print/{id}',[\App\Http\Controllers\Customers\CustomerController::class,'id_card_print'])->name('customer.id_card_print');
        Route::get('/customer-detail/{id}',[\App\Http\Controllers\Customers\CustomerController::class,'customer_detail'])->name('customer.detail');
        Route::get('/delete-customer/{id}',[\App\Http\Controllers\Customers\CustomerController::class,'delete_customer'])->name('delete.customer');

        //////////////////////////////////////////////////////////// dealers controller ////////////////////////////////////////
        Route::get('/dealers-list',[\App\Http\Controllers\Dealers\DealerController::class,'list'])->name('dealers.list');
        Route::post('/save-dealers',[\App\Http\Controllers\Dealers\DealerController::class,'store'])->name('save.dealer');

/////////////////////////////////////////////////  contract controller ///////////////////////////////////////

        Route::get('/create-new-booking',[\App\Http\Controllers\Bookings\BookingController::class,'index'])->name('create.booking');
        Route::get('/edit-booking/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'edit'])->name('edit.booking');
        Route::post('/save-booking',[\App\Http\Controllers\Bookings\BookingController::class,'store'])->name('save.booking');
        Route::post('/update-booking',[\App\Http\Controllers\Bookings\BookingController::class,'update'])->name('update.booking');
        Route::get('/delete-booking/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'delete_booking'])->name('delete.booking');

        Route::get('/booking-list',[\App\Http\Controllers\Bookings\BookingController::class,'list'])->name('booking.list');
        Route::get('/plans-list',[\App\Http\Controllers\Bookings\BookingController::class,'planslist'])->name('plans.list');
        Route::get('/test',[\App\Http\Controllers\Bookings\BookingController::class,'test'])->name('test');

        Route::get('/receipts/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'booking_receipts'])->name('booking.receipts');
        Route::get('/receipt-view/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'receipt_view'])->name('receipt.view');

        Route::get('confirmation-sheet/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'confirmation_sheet'])->name('confirmation.sheet');
        Route::get('/allotment-letter/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'allotment_letter'])->name('allotment.letter');

        Route::get('/application-form/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'application_form'])->name('application.form');

        Route::get('/approved-booking/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'approved_booking'])->name('approved.booking');
        Route::get('/terms-condition/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'terms_condition'])->name('terms.condition');
        Route::get('/print-card/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'print_card'])->name('print.card');

        Route::post('/filter_bookings',[\App\Http\Controllers\Bookings\BookingController::class,'filter_bookings'])->name('filter.bookings');

        ////////////// intiqal controller  ///////////////////////////////////////////////////////
        Route::get('update-inqtiqal/{id}',[\App\Http\Controllers\Intiqal\IntiqalController::class,'update_intiqal'])->name('update.inqtiqal');
        Route::post('save-inqtiqal',[\App\Http\Controllers\Intiqal\IntiqalController::class,'save_intiqal'])->name('save.intiqal');

/////////////////////////////////////////////////   marketer controller //////////////////////////////////////
        Route::get('/marketers-list',[App\Http\Controllers\Marketers\MarketerController::class,'list'])->name('marketers.list');
        Route::post('/save-marketers',[App\Http\Controllers\Marketers\MarketerController::class,'store'])->name('save.marketer');

        //////////////////////////////////////////////// installment head controolerr/////////////////////////////////////////////R
        Route::get('/installments-head-list',[\App\Http\Controllers\InstallmentHeadController::class,'list'])->name('installmenthead.list');
        Route::post('/save-installment-head',[\App\Http\Controllers\InstallmentHeadController::class,'store'])->name('save.installmenthead');

        /////////////////////////////////////// installment controller ////////////////////////////////////////////////////
        Route::post('paid-installment',[\App\Http\Controllers\Installments\InstallmentController::class,'paid_installment'])->name('paid.installment');
        Route::post('save-paid-installment',[\App\Http\Controllers\Installments\InstallmentController::class,'save_paid_installment'])->name('save.installmentamount');
        Route::get('pay-installment/{id}',[\App\Http\Controllers\Installments\InstallmentController::class,'pay_installment'])->name('pay.amount');

        ///////////////////////////////////////// Accounting Controller //////////////////////////////////////////
        Route::get('/general-journal-entries',[\App\Http\Controllers\Accounting\AccountingController::class,'general_journal'])->name('general.journal');
        Route::post('/get-general-journal',[\App\Http\Controllers\Accounting\AccountingController::class,'get_general_journal'])->name('get.general_journal');

        Route::get('/general-ledger',[\App\Http\Controllers\Accounting\AccountingController::class,'general_ledger'])->name('general.ledger');

        ///////////////////////////// plans controllerr //////////////////////////////////////////////////////
        Route::post('/save-plan',[\App\Http\Controllers\Bookings\PlanController::class,'store'])->name('save.plan');
        Route::get('/getbookingamount/{id}',[\App\Http\Controllers\Bookings\PlanController::class,'getBookingAmount'])->name('getamount.booking');
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });
});

Auth::routes();


