@forelse($journals as $journal)
    <tr>
        <td style="padding:0px; margin:0px;" class="text-center" width="13%">{{ \Carbon\Carbon::parse()->format('d M Y') }}</td>
        @if($journal->debit>0)
        <td style="padding:0px; margin:0px;text-align: initial;padding-left: 20px;" class="">
            @if($journal->Account_Name)
                {{ $journal->Account_Name->account_name }}
            @endif
                &nbsp
            ({{ $journal->remarks }})
        </td>
        @else
            <td style="padding:0px; margin:0px;text-align: initial;padding-left: 90px;" class="">
                @if($journal->Account_Name)
                    {{ $journal->Account_Name->account_name }}
                @endif
                    &nbsp
                    ({{ $journal->remarks }})
            </td>
        @endif
        <td style="padding:0px; margin:0px;" class="text-center">{{ number_format($journal->debit,2) }}</td>
        <td style="padding:0px; margin:0px;" class="text-center">{{ number_format($journal->credit,2) }}</td>
    </tr>
@empty
    <tr><th colspan="4" class="text-center">Data Not Found </th></tr>
@endforelse
