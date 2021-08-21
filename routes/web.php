<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Bookings\PlanController;
use App\Http\Controllers\Accounting\AccountingController;
use App\Http\Controllers\Installments\InstallmentController;
use App\Http\Controllers\InstallmentHeadController;
use App\Http\Controllers\Marketers\MarketerController;
use App\Http\Controllers\Intiqal\IntiqalController;
use App\Http\Controllers\Bookings\BookingController;
use App\Http\Controllers\Dealers\DealerController;
use App\Http\Controllers\Customers\CustomerController;
use App\Http\Controllers\Partners\PartnerController;
use App\Http\Controllers\Marlas\MarlaController;
use App\Http\Controllers\Plots\PlotController;
use App\Http\Controllers\Block\BlockController;
use App\Http\Controllers\Sector\SectorController;
use App\Http\Controllers\Projects\ProjectController;
use App\Http\Controllers\Accounts\AccountsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Voucher\VoucherController;
use App\Http\Controllers\Auth\TwoFactorController;

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
Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
//Route::resource('verify',[TwoFactorController::class])->only(['index','store']);
Route::get('verify', [TwoFactorController::class,'index'])->name('verify.index');
Route::post('verify', [TwoFactorController::class,'store'])->name('verify.store');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'twofactor'], function () {

       /////////////////////////////////  voucher controller  /////////////////////////////////
        Route::get('/journal-vouchers-list',[VoucherController::class,'journal_voucher'])->name('journal.voucher');
        Route::get('/create-journal-voucher',[VoucherController::class,'create_journal_voucher'])->name('create.journal_voucher');
        Route::post('/save-journal-voucher',[VoucherController::class,'save_journal_voucher'])->name('save.journal_voucher');
        Route::get('/edit-journal-voucher/{id}',[VoucherController::class,'edit_journal_voucher'])->name('edit.journal_voucher');
        Route::post('/update-journal-voucher',[VoucherController::class,'update_journal_voucher'])->name('update.journal_voucher');
        Route::get('/delete-journal-voucher/{id}',[VoucherController::class,'delete_journal_voucher'])->name('delete.journal_voucher');
        Route::get('/journal_voucher_print/{id}',[VoucherController::class,'journal_voucher_print'])->name('journal_voucher_print');

        Route::get('/bank-receipt-vouchers-list',[VoucherController::class,'bank_receipt_voucherr'])->name('bank-receipt.voucher');
        Route::get('/create-bank-receipt-voucher',[VoucherController::class,'create_bank_receipt_voucher'])->name('create.bank_receipt_voucher');
        Route::post('/save-bank-receipt-voucher',[VoucherController::class,'save_bank_receipt_voucher'])->name('save.bank_receipt_voucher');
        Route::get('/delete-bank-receipt-voucher/{id}',[VoucherController::class,'delete_bank_receipt_voucher'])->name('delete.bank_receipt_voucher');
        Route::get('/edit-bank-receipt-voucher/{id}',[VoucherController::class,'edit_bank_receipt_voucher'])->name('edit.bank_receipt_voucher');
        Route::post('/update-bank-receipt-voucher',[VoucherController::class,'update_bank_receipt_voucher'])->name('update.bank_receipt_voucher');
        Route::get('/bank_receipt_voucher_print/{id}',[VoucherController::class,'bank_receipt_voucher_print'])->name('bank_receipt_voucher_print');

        Route::get('/cash-vouchers-list',[VoucherController::class,'cash_voucher_list'])->name('cash.voucher');
        Route::get('/create-cash-voucher',[VoucherController::class,'create_cash_voucher'])->name('create.cash_voucher');
        Route::post('/save-cash-voucher',[VoucherController::class,'save_cash_voucher'])->name('save.cash_voucher');
        Route::get('/delete-cash-voucher/{id}',[VoucherController::class,'delete_cash_voucher'])->name('delete.cash_receipt_voucher');
        Route::get('/edit-cash-voucher/{id}',[VoucherController::class,'edit_cash_voucher'])->name('edit.cash_receipt_voucher');
        Route::post('/update-cash-voucher',[VoucherController::class,'update_cash_voucher'])->name('update.cash_receipt_voucher');

        Route::get('debit-voucher',[VoucherController::class,'debit_voucher_list'])->name('debit.voucher');
        Route::get('/create-debit-voucher',[VoucherController::class,'create_debit_voucher'])->name('create.debit_voucher');
        Route::post('/save-debit-voucher',[VoucherController::class,'save_debit_voucher'])->name('save.debit_voucher');
        Route::get('/delete-debit-voucher/{id}',[VoucherController::class,'delete_debit_voucher'])->name('delete.debit_voucher');
        Route::get('/edit-debit-voucher/{id}',[VoucherController::class,'edit_debit_voucher'])->name('edit.debit_voucher');
        Route::post('/update-debit-voucher',[VoucherController::class,'update_debit_voucher'])->name('update.debit_voucher');

        /////////////////////////// admin contorller ////////////////////////////////////\

        Route::get('/update-permission',[AdminController::class, 'update_permission']);
        Route::get('/assign-project',[AdminController::class, 'assign_project'])->name('assign.project');
        Route::post('/save-assign-project',[AdminController::class, 'save_assign_project'])->name('save.assign_project');

        Route::get('/user-profile/{id}',[AdminController::class, 'profile_page'])->name('profile.page');
        Route::post('/adimn_password_update',[AdminController::class, 'update_profile_page'])->name('adimn.password.update');

        Route::get('/users-list',[AdminController::class, 'users_list'])->name('users.list');
        Route::get('/create-user',[AdminController::class, 'create'])->name('create.user');

        Route::get('/edit-user/{id}',[AdminController::class, 'edit'])->name('edit.user');

        Route::post('/save-user',[AdminController::class, 'store'])->name('save.users');
        Route::post('/update-user',[AdminController::class, 'update'])->name('update.users');

        ///////////////////////////////   Dashboard Controller ///////////////////////////////
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard.index');

        //////////////////////////////     Accounts Controller //////////////////////////////
        Route::get('/create-account', [AccountsController::class, 'index'])->name('add.accounts');
        Route::post('/save-account', [AccountsController::class, 'store'])->name('save.account');
        Route::get('/accounts-list', [AccountsController::class, 'list'])->name('list.accounts');
        Route::get('/edit-accounts/{id}', [AccountsController::class, 'edit'])->name('edit.account');

        Route::get('/subaccount-category-list', [AccountsController::class, 'account_subcategory_list'])->name('account.subcategory');
        Route::get('/edit-subaccount-category/{id}', [AccountsController::class, 'edit_account_subcategory'])->name('account.editsubcategory');
        Route::get('/create-subaccount-category', [AccountsController::class, 'create_account_subcategory'])->name('create.subaccount_category');
        Route::post('/save-subaccount-category', [AccountsController::class, 'save_account_subcategory'])->name('save.subaccount_category');
        Route::get('/delete-subaccount-category/{id}', [AccountsController::class, 'delete_account_subcategory'])->name('delete.subaccount_category');
        Route::get('/getSubacc_categories/{id}', [AccountsController::class, 'getSubacc_categories'])->name('getSubacc_category');


        ////////////////////////  Project Controller ///////////////////////////////////////////////////////
        Route::get('/projects-list',[ProjectController::class,'list'])->name('project.list');
        Route::post('/save-projects',[ProjectController::class,'store'])->name('save.project');

        //////////////////////////// sector controller /////////////////////////////////////////////////
        Route::get('/sectors-list',[SectorController::class,'list'])->name('sector.list');
        Route::post('/save-sectors',[SectorController::class,'store'])->name('save.sector');
        Route::get('/get_sectors/{id}',[SectorController::class,'get_sectors'])->name('get.sectors');


        ////////////////////////////////////   Block COntroller //////////////////////////////////
        Route::get('/blocks-list',[BlockController::class,'list'])->name('block.list');
        Route::post('/save-blocks',[BlockController::class,'store'])->name('save.block');
        Route::get('/get_blocks/{id}',[BlockController::class,'get_blocks'])->name('get.blocks');


        ////////////////////////////////////////   plot controller here ///////////////////////////////////////////////
        Route::get('/plots-list',[PlotController::class,'list'])->name('plot.list');
        Route::post('/save-plots',[PlotController::class,'store'])->name('save.plot');
        Route::get('/get_plots/{id}',[PlotController::class,'get_plots'])->name('get.plots');
        Route::get('/project_plots/{id}',[PlotController::class,'project_plots']);
        Route::get('/plot-detail/{id}',[PlotController::class,'plot_detail'])->name('plot.detail');

        ///////////////////////////////// marla controller ///////////////////////////////////
        Route::get('/marla-list',[MarlaController::class,'list'])->name('marla.list');
        Route::get('/get_plot_marla/{id}',[MarlaController::class,'getMarla'])->name('get_plot.marla');
        Route::post('/save-marla',[MarlaController::class,'store'])->name('save.marla');

        /////////////////////////////// partners controller /////////////////////////////////
        Route::get('/partners-share',[PartnerController::class,'partners_share'])->name('partners.share');
        Route::post('/partner-amount_detail',[PartnerController::class,'partner_amount_detail'])->name('partner.amount_detail');

        Route::get('/partners-list',[PartnerController::class,'list'])->name('partners.list');
        Route::post('/save-partner',[PartnerController::class,'store'])->name('save.partner');

        Route::post('/pay-to-partner',[PartnerController::class,'payToPartner'])->name('pay.partnerAmount');
        ///////////////////////////////////  customer controller /////////////////////////////////////////////
        Route::get('/customers-list',[CustomerController::class,'list'])->name('customers.list');
        Route::post('/save-customers',[CustomerController::class,'store'])->name('save.customer');
        Route::get('/customer-idcard-print/{id}',[CustomerController::class,'id_card_print'])->name('customer.id_card_print');
        Route::get('/customer-detail/{id}',[CustomerController::class,'customer_detail'])->name('customer.detail');
        Route::get('/delete-customer/{id}',[CustomerController::class,'delete_customer'])->name('delete.customer');

        /////////////////////////////////////////// dealers controller ////////////////////////////////////////
        Route::get('/dealers-list',[DealerController::class,'list'])->name('dealers.list');
        Route::post('/save-dealers',[DealerController::class,'store'])->name('save.dealer');

        ////////////////////////////////////////  contract controller ///////////////////////////////////////

        Route::get('/create-new-booking',[BookingController::class,'index'])->name('create.booking');
        Route::get('/edit-booking/{id}',[BookingController::class,'edit'])->name('edit.booking');
        Route::post('/save-booking',[BookingController::class,'store'])->name('save.booking');
        Route::post('/update-booking',[BookingController::class,'update'])->name('update.booking');
        Route::get('/delete-booking/{id}',[BookingController::class,'delete_booking'])->name('delete.booking');

        Route::get('/booking-list',[BookingController::class,'list'])->name('booking.list');
        Route::get('/plans-list',[BookingController::class,'planslist'])->name('plans.list');
        Route::get('/test',[BookingController::class,'test'])->name('test');

        Route::get('/receipts/{id}',[BookingController::class,'booking_receipts'])->name('booking.receipts');
        Route::get('/receipt-view/{id}',[BookingController::class,'receipt_view'])->name('receipt.view');

        Route::get('confirmation-sheet/{id}',[BookingController::class,'confirmation_sheet'])->name('confirmation.sheet');
        Route::get('/allotment-letter/{id}',[BookingController::class,'allotment_letter'])->name('allotment.letter');

        Route::get('/application-form/{id}',[BookingController::class,'application_form'])->name('application.form');

        Route::get('/approved-booking/{id}',[BookingController::class,'approved_booking'])->name('approved.booking');
        Route::get('/terms-condition/{id}',[BookingController::class,'terms_condition'])->name('terms.condition');
        Route::get('/print-card/{id}',[BookingController::class,'print_card'])->name('print.card');

        Route::post('/filter_bookings',[BookingController::class,'filter_bookings'])->name('filter.bookings');

        ////////////// intiqal controller  ///////////////////////////////////////////////////////
        Route::get('update-inqtiqal/{id}',[IntiqalController::class,'update_intiqal'])->name('update.inqtiqal');
        Route::post('save-inqtiqal',[IntiqalController::class,'save_intiqal'])->name('save.intiqal');

/////////////////////////////////////////////////   marketer controller //////////////////////////////////////
        Route::get('/marketers-list',[MarketerController::class,'list'])->name('marketers.list');
        Route::post('/save-marketers',[MarketerController::class,'store'])->name('save.marketer');

        //////////////////////////////////////////////// installment head controolerr/////////////////////////////////////////////R
        Route::get('/installments-head-list',[InstallmentHeadController::class,'list'])->name('installmenthead.list');
        Route::post('/save-installment-head',[InstallmentHeadController::class,'store'])->name('save.installmenthead');

        /////////////////////////////////////// installment controller ////////////////////////////////////////////////////
        Route::post('paid-installment',[InstallmentController::class,'paid_installment'])->name('paid.installment');
        Route::post('save-paid-installment',[InstallmentController::class,'save_paid_installment'])->name('save.installmentamount');
        Route::get('pay-installment/{id}',[InstallmentController::class,'pay_installment'])->name('pay.amount');

        ///////////////////////////////////////// Accounting Controller //////////////////////////////////////////
        Route::get('/general-journal-entries',[AccountingController::class,'general_journal'])->name('general.journal');
        Route::post('/get-general-journal',[AccountingController::class,'get_general_journal'])->name('get.general_journal');

        Route::get('/general-ledger',[AccountingController::class,'general_ledger'])->name('general.ledger');
        Route::post('/get-general-ledger',[AccountingController::class,'get_general_ledger'])->name('get.general_ledger');

        Route::post('/account-ledger/{id}',[AccountingController::class,'account_ledger'])->name('account.ledger');

        ///////////////////////////// plans controllerr //////////////////////////////////////////////////////
        Route::post('/save-plan',[PlanController::class,'store'])->name('save.plan');
        Route::get('/getbookingamount/{id}',[PlanController::class,'getBookingAmount'])->name('getamount.booking');
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('/total-receivable',[ReportsController::class,'total_receiveable'])->name('admin.totalreceivable');
        Route::post('/get-total-receivable',[ReportsController::class,'get_total_receiveable'])->name('get.total_receivable');
    });
});

Auth::routes();


