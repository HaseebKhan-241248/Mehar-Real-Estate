
@forelse($ledgers as $ledger)
    @php  $balance=0; @endphp
    <tr>
        @if($ledger->debit>0)
            <td style="padding:0px; margin:0px;text-align: initial;padding-left: 20px;" class="">
                @if($ledger->Account_Name)
                    {{ $ledger->Account_Name->account_name }}
                @endif
            </td>
        @else
            <td style="padding:0px; margin:0px;text-align: initial;padding-left: 20px;" class="">
                @if($ledger->Account_Name)
                    {{ $ledger->Account_Name->account_name }}
                @endif
            </td>
        @endif
        @php
            $balance -= $ledger->credit;
            $balance += $ledger->debit;
        @endphp
        @if($balance>0)
            <td style="padding:0px; margin:0px;">{{ number_format($balance,2) }}</td>
            <td style="padding:0px; margin:0px;">0.00</td>
        @else
                <td style="padding:0px; margin:0px;">0.00</td>
                <td style="padding:0px; margin:0px;">{{ number_format($balance,2) }}</td>
        @endif
        <td style="padding:0px; margin:0px;">
            <form action="{{ route('account.ledger',[$ledger->account_id]) }}" method="post">
                @csrf
                <input type="hidden" name="start" value="{{ $startdate }}">
                <input type="hidden" name="end" value="{{ $enddate }}">
                <input type="hidden" name="project_name" value="{{ $project->name }}">
            <button  target="_blank" class="btn btn-success btn-sm">Acc/Ledger</button>
            </form>
        </td>
    </tr>
@empty
    <tr><th colspan="4">No Data Found</th></tr>
@endforelse
