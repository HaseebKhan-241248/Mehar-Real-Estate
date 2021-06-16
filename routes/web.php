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
| contains the "web" middleware group. Now create something great!
|
*/
//use SimpleSoftwareIO\QrCode\Facades\QrCode;
//
//Route::get('generate-qr-code', function () {
//
//    QrCode::size(500)
//        ->format('png')
//        ->generate('Online Web Tutor', public_path('images/owt.png'));
//
//    return view('generate-qr-code');
//
//});

Route::group(['middleware' => 'auth'], function () {

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

    //////////////////////////////////////////////////////////// dealers controller ////////////////////////////////////////
    Route::get('/dealers-list',[\App\Http\Controllers\Dealers\DealerController::class,'list'])->name('dealers.list');
    Route::post('/save-dealers',[\App\Http\Controllers\Dealers\DealerController::class,'store'])->name('save.dealer');

/////////////////////////////////////////////////  contract controller ///////////////////////////////////////

    Route::get('/create-new-booking',[\App\Http\Controllers\Bookings\BookingController::class,'index'])->name('create.booking');
    Route::post('/save-booking',[\App\Http\Controllers\Bookings\BookingController::class,'store'])->name('save.booking');

    Route::get('/booking-list',[\App\Http\Controllers\Bookings\BookingController::class,'list'])->name('booking.list');
    Route::get('/plans-list',[\App\Http\Controllers\Bookings\BookingController::class,'planslist'])->name('plans.list');
    Route::get('/test',[\App\Http\Controllers\Bookings\BookingController::class,'test'])->name('test');

    Route::get('/receipts/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'booking_receipts'])->name('booking.receipts');
    Route::get('/receipt-view/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'receipt_view'])->name('receipt.view');

    Route::get('confirmation-sheet/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'confirmation_sheet'])->name('confirmation.sheet');
    Route::get('/allotment-letter/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'allotment_letter'])->name('allotment.letter');

    Route::get('/application-form/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'application_form'])->name('application.form');

    Route::get('/approved-booking/{id}',[\App\Http\Controllers\Bookings\BookingController::class,'approved_booking'])->name('approved.booking');
    
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


    ///////////////////////////// plans controllerr //////////////////////////////////////////////////////
    Route::post('/save-plan',[\App\Http\Controllers\Bookings\PlanController::class,'store'])->name('save.plan');
    Route::get('/getbookingamount/{id}',[\App\Http\Controllers\Bookings\PlanController::class,'getBookingAmount'])->name('getamount.booking');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
