@extends('admin.pdf.layout')

@section('content')
<main>
  <div>
    <header id="order_head">
      <span>*Cutomers Orders Details || {{ Date('F j, Y', strtotime(Carbon\Carbon::now())) }}</span>
    </header>
    <div id="customers">
      <table>
        <thead>
          <tr>
            <th>Trace No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date</th>
            <th>Payment</th>
            <th>Total Pay</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
          <tr>
            <td>{{ $order->tracking_no }}</td>
            <td>{{ $order->firstname . " " . $order->lastname }}</td>
            <td>{{ $order->email }}</td>
            <td>{{ date('F j, Y', strtotime($order->created_at)) }}</td>
            <td>{{ $order->payment_mode == "Paid by Paypal" ? "Paypal" : "COD" }}</td>
            <td> &#8369;{{ $order->total_price }}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot style="background-color: gray">
          <tr>
            <td colspan="5" style="text-align: center">Total Sales for the month of {{ date('F Y',
              strtotime($order->created_at)) }}</td>
            <td colspan="1" style="text-align: center">&#8369;{{ $monthly_income }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  {{-- <div class="page_break"></div>

  <div>
    <h1>Page two</h1>
  </div> --}}
</main>
@endsection