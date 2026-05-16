<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3>Pay Fee - {{ $student->name }}</h3>

<form method="POST">
    @csrf

    <input type="number" name="amount" placeholder="Amount"><br>

    <select name="payment_mode">
        <option value="cash">Cash</option>
        <option value="online">Online</option>
    </select><br>

    <input type="text" name="remark" placeholder="Remark"><br>

    <button type="submit">Pay</button>
</form>
    </div>
</div>

</body>
</html>