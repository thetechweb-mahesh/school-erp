<!DOCTYPE html>
<html>
<head>
    <title>Fee Collection Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Fee Collection Report</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Student</th>
            <th>Amount</th>
            <th>Mode</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $pay)
        <tr>
            <td>{{ $pay->id }}</td>
            <td>{{ $pay->student->name ?? '' }}</td>
            <td>₹{{ $pay->amount }}</td>
            <td>{{ ucfirst($pay->payment_mode) }}</td>
            <td>{{ $pay->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>