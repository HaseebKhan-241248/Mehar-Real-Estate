<table class="table table-bordered text-center">
    <thead>
    <tr class="">
        <th class="text-center text-uppercase">Sr#</th>
        <th class="text-center text-uppercase">Project Name</th>
        <th class="text-center text-uppercase">Sector Name</th>
        <th class="text-center text-uppercase">Block Name</th>
        <th class="text-center text-uppercase">Plot#</th>
        <th class="text-center text-uppercase">Date</th>
        <th class="text-center text-uppercase">Amount</th>
        <th class="text-center text-uppercase">Status</th>
        <th class="text-center text-uppercase">Amount Pay</th>
        <th class="text-center text-uppercase">-</th>
    </tr>
    </thead>
@foreach($bookings as $booking)
        <tr>
            <td>{{ $counter++ }}</td>
            <td>
                @if($booking->Project_Name)
                    {{ $booking->Project_Name->name }}
                @endif
            </td>
            <td>
                @if($booking->Sector_Name)
                    {{ $booking->Sector_Name->name }}
                @endif
            </td>
            <td>
                @if($booking->Block_Name)
                    {{ $booking->Block_Name->name }}
                @endif
            </td>
            <td>
                <input type="hidden" name="plot_id[]" value="{{ $booking->plot_id }}">
                <input type="hidden" name="booking_id[]" value="{{ $booking->id }}">
                @if($booking->Plot_Name)
                    {{ $booking->Plot_Name->name }}
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($booking->day)->format('d M Y') }}</td>
            <td>{{ number_format(($booking->partner_amount - $booking->paid_to_partner),2) }}</td>
            <td>
                @if($booking->partner_amount - $booking->paid_to_partner==0) 
                <span class="text-success">Paid</span> 
                @endif
            </td>
            <td>
                <input type="number"  @if($booking->partner_amount - $booking->paid_to_partner==0) readonly @endif class="CustomAmount" value="0" name="amount_pay[]" onkeyup="TotalAmount()" class="form-control " style="height: 29px;">
            </td>
            <td>
                {{-- <input type="hidden" name="amount_pay[]" value="{{ $booking->partner_amount }}"> --}}
                 <input  @if($booking->partner_amount - $booking->paid_to_partner==0) checked disabled @endif type="checkbox" value="{{ $booking->id }}-{{ $booking->partner_amount }}" name="checkboxArray[]" data_Amount="{{ $booking->partner_amount }}" class="checkboxClass">
            </td>
        </tr>

@endforeach
</table>
