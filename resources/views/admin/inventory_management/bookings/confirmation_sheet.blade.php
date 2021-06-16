<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #030303;
  text-align: left;
  padding: 8px;
}
.header {text-align: center;}
.table_header{
text-align: center; 
border-bottom: 4px solid #030303;
text-align: center;
font-size: 33px;
}
.table_data {
    text-align: center;
}
.table_margin {
    margin: 65px;
}
</style>
</head>
<body>
   <div class="header">
     <img alt="Logo" @if($booking->Project_Name) src="{{ asset('images') }}/{{ $booking->Project_Name->logo }}" @endif style="margin-top: 50px;">
    <br>
    <h1 style="color: grey;"> @if($booking->Project_Name)
        {{$booking->Project_Name->name}}@endif
    </h1>
</div>
<div class="table_margin">
<table>
    <tr>
      <th colspan="2" class="table_header "><b>Confirmation Sheet</b></th>
    </tr>
    <tr>
      <th colspan="2"><span style="text-align: left;">  Name : @if($booking->Customer_Name->name)
        {{ $booking->Customer_Name->name }}
         @endif </span>
          <span style="float: right;"> Date : {{ \Carbon\Carbon::parse($booking->day)->format('d m Y') }} </span> </th>
    </tr>
    <tr>
        <th>BOOKING NO.:</th>
      <td class="table_data">{{ $booking->id }}</td>
    </tr>
    <tr>
        <th>PLOT NO:</th>
      <td class="table_data">@if($booking->Plot_Name) {{ $booking->Plot_Name->name }}@endif</td>
    </tr>
    <tr>
        <th>UNIT SIZE:</th>
      <td class="table_data"> @if($booking->MarlaSize) {{ $booking->MarlaSize->marla}} Marla @endif</td>
    </tr>
    <tr>
        <th>BLOCK:</th>
      <td class="table_data">@if($booking->Block_Name){{ $booking->Block_Name->name }}@endif</td>
    </tr>
    <tr>
        <th>SECTOR NAME:</th>
      <td class="table_data">@if($booking->sector_Name){{ $booking->sector_Name->name }}@endif</td>
    </tr>
    <tr>
        <th>TOTAL PRICE:</th>
      <td class="table_data">RS. {{ number_format($booking->agreed_price,2) }}/-</td>
    </tr>
    <tr>
        <th>DISCOUNT:</th>
      <td class="table_data">
        @if($booking->dicsount>0)  
        {{ $booking->dicsount }}
    @else 0
    @endif
    </td>
    </tr>
    <tr>
        <th>AGREED PRICE:</th>
      <td class="table_data">{{ $booking->agreed_price - $booking->dicsount }}</td>
    </tr>
    <tr>
        <th>CLIENT SIGNATURE:</th>
      <td class="table_data"></td>
    </tr>
    <tr>
        <th>APROVED BY:</th>
      <td class="table_data"></td>
    </tr>
    <tr>
        <th>AUTHORIZED BY:</th>
      <td class="table_data"></td>
    </tr>
    <tr>
        <th>BOOKED BY:</th>
      <td class="table_data">Softsuite Technologies</td>
    </tr>
  </table> 

</div>

</body>
</html>