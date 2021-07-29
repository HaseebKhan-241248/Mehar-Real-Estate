@foreach($bookings as $booking)
    <tr class="gradeC">
        <td>{{$counter++}}</td>
        <td>
            @if($booking->Customer_Name)
                {{$booking->Customer_Name->name}}
            @endif
        </td>
        <td>
            @if($booking->Sector_Name)
                {{$booking->Sector_Name->name}}
            @endif
        </td>
        <td>
            @if($booking->Block_Name)
                {{$booking->Block_Name->name}}
            @endif
        </td>
        <td>
            @if($booking->Plot_Name)
                {{$booking->Plot_Name->name}}
            @endif
        </td>
        <td>{{$booking->customer_contact}}</td>
        <td>{{ number_format($booking->agreed_price,2) }}</td>
        <td>{{number_format($booking->received,2)}}</td>
        @php
            $outstandings = \App\Models\Installments\Installment::where('booking_id',$booking->id)->where('installment_amount','>','0')->where('description','!=','Booking')->where('date','<',date('Y-m-d'))->get();
            $total_outstanding = 0;
            foreach ($outstandings as $outstanding)
            {
              $total_outstanding += $outstanding->installment_amount;
            }
        @endphp
        <td>
            {{ number_format($total_outstanding,2) }}
        </td>
        <td>
            <div class="input-group-btn">
                <button type="button" data-toggle="dropdown"
                        class="btn btn-xs btn-primary dropdown-toggle"
                        aria-expanded="false">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right">
                    @if((Auth::user()->role) == 'Super Admin')
                        <li>
                            <a  target="_blank" href="{{ route('terms.condition',[$booking->id]) }}">
                                <i class="fa fa-gavel"></i> Terms & Condition
                            </a>
                        </li>
                        @if($booking->status==1)

                        @else
                            <li>
                                <a  target="_blank" href="{{ route('edit.booking',[$booking->id]) }}">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </li>
                            <li>
                                <a   href="{{ route('delete.booking',[$booking->id]) }}">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </li>
                        @endif
                        @if($booking->status==1)
                        @else
                            <li>
                                <a  href="{{ route('approved.booking',[$booking->id]) }}">
                                    <i class="fa fa-check"></i>
                                    Booking Approved
                                </a>
                            </li>
                        @endif
                        <li>
                            <a target="_blank"
                               href="{{ route('print.card',[$booking->id]) }}">
                                <i class="fa fa-id-card"></i>
                                Print Card
                            </a>
                        </li>
                        <li>
                            <a target="_blank"
                               href="{{ route('application.form',[$booking->id]) }}">
                                <i class="fa fa-wpforms"></i>
                                Application Form
                            </a>
                        </li>
                        <li>
                            <a target="_blank"
                               href="{{ route('plot.detail',[$booking->id]) }}">
                                <i class="fa fa-calendar"></i>
                                Payment Schedule
                            </a>
                        </li>
                        <li>
                            <a target="_blank"
                               href="{{ route('pay.amount',[$booking->id]) }}">
                                <i class="fa fa-credit-card"></i>
                                Pay Amount
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="{{ route('booking.receipts',[$booking->id]) }}">
                                <i class="fa fa-files-o"></i> Receipts
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('confirmation.sheet',[$booking->id]) }}" target="_blank">
                                <i class="fa fa-check"></i> Confirmation Sheet
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="{{ route('update.inqtiqal',[$booking->id]) }}">
                                <i class="fa fa-refresh"></i> Update Intiqal
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="{{ route('allotment.letter',[$booking->id]) }}">
                                <i class="fa fa-tasks"></i> Allotment Letter
                            </a>
                        </li>

                        {{-- ////// else if part ///////////// --}}
                    @elseif((Auth::user()->role)=="GM")
                        <li>
                            <a  href="{{ route('approved.booking',[$booking->id]) }}">
                                <i class="fa fa-check"></i>
                                Booking Approved
                            </a>
                        </li>
                        <li>
                            <a target="_blank"
                               href="{{ route('print.card',[$booking->id]) }}">
                                <i class="fa fa-id-card"></i>
                                Print Card
                            </a>
                        </li>
                        <li>
                            <a target="_blank"
                               href="{{ route('application.form',[$booking->id]) }}">
                                <i class="fa fa-wpforms"></i>
                                Application Form
                            </a>
                        </li>
                        <li>
                            <a target="_blank"
                               href="{{ route('plot.detail',[$booking->id]) }}">
                                <i class="fa fa-calendar"></i>
                                Payment Schedule
                            </a>
                        </li>
                        <li>
                            <a target="_blank"
                               href="{{ route('pay.amount',[$booking->id]) }}">
                                <i class="fa fa-credit-card"></i>
                                Pay Amount
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="{{ route('booking.receipts',[$booking->id]) }}"><i class="fa fa-files-o"></i> Receipts</a>
                        </li>
                        <li>
                            <a href="{{ route('confirmation.sheet',[$booking->id]) }}" target="_blank"><i class="fa fa-check"></i> Confirmation
                                Sheet</a>
                        </li>
                        <li>
                            <a target="_blank" href="{{ route('update.inqtiqal',[$booking->id]) }}"><i class="fa fa-refresh"></i> Update
                                Intiqal
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('allotment.letter',[$booking->id]) }}" target="_blank"><i class="fa fa-tasks"></i> Allotment
                                Letter</a>
                        </li>
                        {{-- else part from here                                                         --}}
                    @else
                        @if($booking->status==1)

                            @can('Manage Booking','Payment Schedule')
                                <li>
                                    <a target="_blank"
                                       href="{{ route('plot.detail',[$booking->id]) }}">
                                        <i class="fa fa-calendar"></i>
                                        Payment Schedule
                                    </a>
                                </li>
                            @endcan
                            @can('Manage Booking','Pay Amount')
                                <li>
                                    <a target="_blank"
                                       href="{{ route('pay.amount',[$booking->id]) }}">
                                        <i class="fa fa-credit-card"></i>
                                        Pay Amount
                                    </a>
                                </li>
                            @endcan
                            @can('Manage Booking','Receipts')
                                <li>
                                    <a
                                        href="{{ route('booking.receipts',[$booking->id]) }}" target="_blank"><i class="fa fa-files-o"></i> Receipts</a>
                                </li>
                            @endcan
                            @can('Manage Booking','Confirmation Sheet')
                                <li>
                                    <a href="{{ route('confirmation.sheet',[$booking->id]) }}" target="_blank"><i class="fa fa-check"></i> Confirmation
                                        Sheet</a>
                                </li>
                            @endcan
                            @can('Manage Booking','Update Intiqal')
                                <li>
                                    <a href="{{ route('update.inqtiqal',[$booking->id]) }}" target="_blank"><i class="fa fa-refresh"></i> Update
                                        Intiqal
                                    </a>
                                </li>
                            @endcan
                            @can('Manage Booking','Allotment Letter')
                                <li>
                                    <a href="{{ route('allotment.letter',[$booking->id]) }}" target="_blank"><i class="fa fa-tasks"></i> Allotment
                                        Letter</a>
                                </li>
                            @endcan
                            <li>
                                <a target="_blank"
                                   href="{{ route('print.card',[$booking->id]) }}">
                                    <i class="fa fa-id-card"></i>
                                    Print Card
                                </a>
                            </li>
                        @else
                            @can('Manage Booking','Update')
                                <li>
                                    <a  target="_blank" href="{{ route('edit.booking',[$booking->id]) }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </li>
                            @endcan
                            @can('Manage Booking','Delete')
                                <li>
                                    <a   href="{{ route('delete.booking',[$booking->id]) }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </li>
                            @endcan
                        @endif
                    @endif
                </ul>
            </div>
        </td>
    </tr>
@endforeach
