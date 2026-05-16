@extends('layouts.student')

@section('content')

<h2>Attendance</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Date</th>
        <th>Status</th>
    </tr>

    @foreach($attendance as $row)
    <tr>
        <td>{{ $row->date }}</td>
        <td>{{ $row->status }}</td>
    </tr>
    @endforeach

</table>

@endsection