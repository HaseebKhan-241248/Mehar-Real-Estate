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
            $data['customers'] = Customer::where('status','=','1')->get();
            $data['dealers']   = Dealer::all();
            $data['marketers'] = Marketer::all();
        }
        else
        {
            $data['projects']  = Project::where('id',Auth::user()->project_id)->get();
            $data['customers'] = Customer::where('status','=','1')->where('project_id',Auth::user()->project_id)->get();
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
        if((Auth::user()->role)=="Super Admin")
        {
            $data['bookings']  = Booking::orderby('day','desc')->get();
        }
        else
        {
            $data['bookings']  = Booking::where('project_id',Auth::user()->project_id)->orderby('day','desc')->get();
        }

        return view('admin.inventory_management.bookings.list',$data);
    }
    public function store(Request $request)
    {
        request()->validate([
            // 'intiqal_no'  => ['required', 'unique:intiqals'],
            'customer_id' => ['required'],
            'intiqal_a'   => ['required'],
            'project_id'  => ['required'],
            'sector_id'   => ['required'],
            'block_id'    => ['required'],
            'plot_id'     => ['required'],
        ]);
        $booking  = Booking::saveBooking($request);
        Plot::where('id',$request->plot_id)->update(['status'=>0]);
        if($request->amount)
        {
            $response = Installment::saveInstallments($request,$booking->id);
        }

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
        $data['booking'] = Booking::where('id',85)->first();
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
            'approved_by' => Auth::user()->id,
            'status'      => 1,
        ]);
        return redirect()->back()->withstatus('Booking Approved Successfully!');
    }
    public function application_form($id)
    {
        $data['booking'] = Booking::where('id',$id)->first();
        return view('admin.inventory_management.bookings.terms_conditions.office_file',$data);
    }
    public function  edit($id)
    {
        $user_role =    Auth::user()->role;
        if($user_role=="Super Admin")
        {
            $data['projects']  = $project = Project::all();
            $data['customers'] = Customer::where('status','=','1')->get();
            $data['dealers']   = Dealer::all();
            $data['marketers'] = Marketer::all();
            $data['accounts']  = Account::all();
        }
        else
        {
            $data['projects']  = $project = Project::where('id',Auth::user()->project_id)->get();
            $data['customers'] = Customer::where('status','=','1')->where('project_id',Auth::user()->project_id)->get();
            $data['dealers']   = Dealer::where('project_id',Auth::user()->project_id)->get();
            $data['marketers'] = Marketer::where('project_id',Auth::user()->project_id)->get();
            $data['accounts']  = Account::where('project_id',Auth::user()->project_id)->get();
        }
        $data['booking']      = $booking = Booking::where('id',$id)->first();
        $data['attachments']  = Bookgingattachment::where('booking_id',$id)->get();
        $data['installments'] = Installment::where('booking_id',$id)->get();
        $data['sectors']   = $sector = Sector::where('project_id',$booking->project_id)->get();
        $data['blocks']    = $block = Block::where('sector_id',$booking->sector_id)->get();
        $data['plots']     = Plot::where('block_id',$booking->block_id)->get();
        $data['heads']     = InstallmentHead::all();

//        dd($id);
        return view('admin.inventory_management.bookings.edit',$data);
    }

    public function  update(Request $request)
    {
//        dd($request->all());
        $booking  = Booking::saveBooking($request);

        ///////// delete the installments first then add new //////////////
        Installment::where('booking_id',$request->booking_id)->delete();
        if($request->amount)
        {
            $response = Installment::saveInstallments($request,$request->booking_id);
        }


        ////////////  booking entry ///////////////////////////////
        Ledger::where('booking_id',$request->booking_id)->delete();

        $account  = Ledger::saveBookingEntry($request,$request->booking_id);
        Ledger::savePartnerEntry($request,$request->booking_id);

        if($request->intiqal_a>0)
        {
            Intiqal::where('booking_id',$request->booking_id)->delete();
            Intiqal::saveIntiqalBooking($request,$request->booking_id);
        }

        if($request->dealer_id>0)
        {
            Ledger::saveDealerCommission($request,$request->booking_id);
        }
//        if ($request->attachments)
//        {
        Bookgingattachment::UpdateAttachments($request,$request->booking_id);
//        }
        return redirect()->route('booking.list')->withstatus("Booking Updated Successfully");
    }
    public function  delete_booking($id)
    {
        Booking::where('id',$id)->delete();
        Installment::where('booking_id',$id)->delete();
        Ledger::where('booking_id',$id)->delete();
        $intiqals = Intiqal::where('booking_id',$id)->get();
        if(isset($intiqals))
        {
            foreach ($intiqals as $intiqal)
            {
                if(isset($intiqal->intiqal_attachment)  && file_exists(public_path($intiqal->intiqal_attachment)))
                {
                    unlink($intiqal->intiqal_attachment);
                }
            }
            Intiqal::where('booking_id',$id)->delete();
        }
        $attachments = Bookgingattachment::where('booking_id',$id)->get();
        if(isset($attachments))
        {
            foreach ($attachments as $attachment)
            {
                if(isset($attachment->attachments)  && file_exists(public_path($attachment->attachments)))
                {
                    unlink($attachment->attachments);
                }
            }
            Bookgingattachment::where('booking_id',$id)->delete();
        }
        return redirect()->back()->withstatus("Booking Deleted Successfully!");
    }
    public function  terms_condition($id)
    {
        $data['booking'] = Booking::where('id',$id)->first();
        return view('admin.inventory_management.bookings.terms_conditions.term_condition',$data);
    }
    public function  print_card($id)
    {
        $data['booking'] = Booking::where('id',$id)->first();
        return view('admin.inventory_management.bookings.card',$data);
    }

    public function  filter_bookings(Request $request)
    {
        if($request->project==null && $request->sector_id==null && $request->customer==null)
        {
            $data['bookings']  = Booking::orderby('day','desc')->get();
        }
        elseif($request->project!=null && $request->sector_id==null && $request->customer==null)
        {
            $data['bookings']  = Booking::where('project_id',$request->project)->orderby('day','desc')->get();
        }
        elseif($request->project!=null && $request->sector_id!=null && $request->customer==null)
        {
            $data['bookings']  = Booking::where('project_id',$request->project)->where('sector_id',$request->sector_id)->orderby('day','desc')->get();
        }
        elseif($request->project!=null && $request->sector_id==null && $request->customer!=null)
        {
            $data['bookings']  = Booking::where('project_id',$request->project)->where('customer_id',$request->customer)->orderby('day','desc')->get();
        }
        elseif($request->project!=null && $request->sector_id!=null && $request->customer!=null)
        {
            $data['bookings']  = Booking::where('project_id',$request->project)->where('sector_id',$request->sector_id)->where('customer_id',$request->customer)->orderby('day','desc')->get();
        }
        elseif($request->project==null && $request->sector_id==null && $request->customer!=null)
        {
            $data['bookings']  = Booking::where('customer_id',$request->customer)->orderby('day','desc')->get();
        }
        else
        {
            return "1";
        }
        $data['counter'] = 1;
        $result          = view('admin.inventory_management.bookings.render_list',$data)->render();

        return response()->json([
            'result' => $result
        ]);
    }
}
