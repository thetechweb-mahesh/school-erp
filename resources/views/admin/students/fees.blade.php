@extends('layouts.student')

@section('content')

<h2>Fee Payments</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Amount</th>
        <th>Status</th>
    </tr>

    @foreach($payments as $payment)
    <tr>
        <td>{{ $payment->amount }}</td>
        <td>{{ $payment->status }}</td>
    </tr>
    @endforeach
</table>

@endsection