<?php

namespace App\Http\Controllers\Bookings;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Account;
use App\Models\Blocks\Block;
use App\Models\Bookings\Booking;
use App\Models\Boooking\Bookgingattachment;
use App\Models\Dealers\Dealer;
use App\Models\InstallmentHead;
use App\Models\Installments\Installment;
use App\Models\Intiqal\Intiqal;
use App\Models\Ledger;
use App\Models\Marketers\Marketer;
use App\Models\Plots\Plot;
use App\Models\Projects\Project;
use App\Models\Receipts\Receipt;
use App\Models\Sectors\Sector;
use App\Models\Customers\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $user_role =    Auth::user()->role;
        if($user_role=="Super Admin")
        {
            $data['projects']  = Project::all();
            $data['customers'] = Customer::all();
            $data['dealers']   = Dealer::all();
            $data['marketers'] = Marketer::all();
        }
        else
        {
            $data['projects']  = Project::where('id',Auth::user()->project_id)->get();
            $data['customers'] = Customer::where('project_id',Auth::user()->project_id)->get();
            $data['dealers']   = Dealer::where('project_id',Auth::user()->project_id)->get();
            $data['marketers'] = Marketer::where('project_id',Auth::user()->project_id)->get();
        }
        
        $data['sectors']   = Sector::all();
        $data['blocks']    = Block::all();
        $data['plots']     = Plot::all();                        
        $data['heads']     = InstallmentHead::all();
        $data['accounts']  = Account::all();
        return view('admin.inventory_management.bookings.index',$data);
    }
    public function list()
    {
        $data['counter']   = 1;
        $data['bookings']  = Booking::orderby('day','desc')->get();
        return view('admin.inventory_management.bookings.list',$data);
    }
    public function store(Request $request)
    {
//        dd($request->all());
        request()->validate([
            'intiqal_no'         => ['required', 'unique:intiqals'],
            'intiqal_attachment' => ['required'],
            'intiqal_a'            => ['required'],
        ]);
        $booking  = Booking::saveBooking($request);
        Plot::where('id',$request->plot_id)->update(['status'=>0]);
        $response = Installment::saveInstallments($request,$booking->id);

        $account  = Ledger::saveBookingEntry($request,$booking->id);
        Ledger::savePartnerEntry($request,$booking->id);
        if($request->intiqal_a>0)
        {       
            Intiqal::saveIntiqalBooking($request,$booking->id);
        }

        if($request->dealer_id>0)
        {
            Ledger::saveDealerCommission($request,$booking->id);
        }
        if ($request->attachments)
        {
           Bookgingattachment::saveAttachments($request,$booking->id);
        }
        $data['booking'] = Booking::where('id',$booking->id)->first();
        return view('admin.inventory_management.bookings.card',$data);
//        return redirect()->route('booking.list')->withStatus(__($response['message']));
    }
    public function planslist()
    {
        $data['counter']   = 1;
        $data['bookings']  = Booking::all();
        return view('admin.inventory_management.bookings.plans',$data);
    }
    public function booking_receipts($id)
    {
        $data['booking']  = Booking::where('id',$id)->first();
        $data['receipts'] = Receipt::where('booking_id',$id)->get();
        $data['counter']  = 1;
        return view('admin.inventory_management.receipts.list',$data);
    }
    public function    test()
    {
        $data['booking'] = Booking::where('id',76)->first();
        return view('admin.inventory_management.bookings.card',$data);
    }
    public function receipt_view($id)
    {
        $data['receipt'] = $receipt = Receipt::where('id',$id)->first();
        $data['booking'] = Booking::where('id',$receipt->booking_id)->first();
        return view('admin.inventory_management.receipts.receipt_view',$data);
    }
    
    public function confirmation_sheet($id)
    {
       $data['booking'] = Booking::where('id',$id)->first();
       return view('admin.inventory_management.bookings.confirmation_sheet',$data);
    }

    public function allotment_letter($id)
    {
       $data['booking'] = Booking::where('id',$id)->first();
       return view('admin.inventory_management.bookings.allotment',$data);
    }

    public function approved_booking($booking_id)
    {
         Booking::where('id',$booking_id)->update([
             'status' => 1,
         ]);
         return redirect()->back()->withstatus('Booking Approved Successfully!');
    }
    public function application_form($id)
    {
        return view('admin.inventory_management.bookings.terms_conditions.office_file');
    }
}
