@extends('layouts.student')

@section('content')

<h2>Student Dashboard</h2>

<div style="background:#3498db;color:white;padding:20px;width:250px;border-radius:10px;">
<h3>Name</h3>
{{ $student->name ?? 'N/A' }}
</div>

<br>

<div style="background:#e74c3c;color:white;padding:20px;width:250px;border-radius:10px;">
<h3>Pending Fees</h3>
<h2>₹{{ $student->balance_fee }}</h2>
</div>

@endsection