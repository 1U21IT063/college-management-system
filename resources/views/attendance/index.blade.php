<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Attendance Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f7fb;">
    @extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h2 class="mb-4">Student Attendance</h2>

        <form action="/attendance/store" method="POST">

            @csrf

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($students as $student)

                    <tr>

                        <td>{{ $student->id }}</td>

                        <td>{{ $student->name }}</td>

                        <td>{{ $student->department }}</td>

                        <td>

                            <select
                            name="status[{{ $student->id }}]"
                            class="form-control">

                                <option value="Present">
                                    Present
                                </option>

                                <option value="Absent">
                                    Absent
                                </option>

                            </select>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

            <button class="btn btn-primary">
                Save Attendance
            </button>

        </form>

    </div>

</div>
@endsection
</body>
</html>