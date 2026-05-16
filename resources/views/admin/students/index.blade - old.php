<a href="{{ route('students.create') }}">Add Student</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Class</th>
        <th>Fee</th>
        <th>Action</th>
    </tr>

    @foreach($students as $student)
    <tr>
        <td>{{ $student->name }}</td>
        <td>{{ $student->class }}</td>
        <td>₹{{ $student->balance_fee }}</td>
        <td>
            <a href="{{ route('students.edit', $student->id) }}">Edit</a>
               <a href="{{ route('students.admit', $student->id) }}" target="_blank">Admit</a>

            <form action="{{ route('students.delete', $student->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Delete?')">Delete</button>
            </form>
        </td>
        <a href="{{ route('fee.create', $student->id) }}">Pay Fee</a>
    </tr>
    @endforeach
</table>