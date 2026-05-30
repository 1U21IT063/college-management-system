<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Students List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f7fb;">
    @extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card p-4 shadow">

        <div class="d-flex justify-content-between mb-4">

            <h2>Students List</h2>

            <div>

                <form action="/students" method="GET" class="d-flex">

                    <input type="text"
                    name="search"
                    class="form-control me-2"
                    placeholder="Search Student">

                    <button class="btn btn-dark">
                        Search
                    </button>

                </form>

            </div>

            <a href="/students/create" class="btn btn-primary">
                Add Student
            </a>

        </div>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Year</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                @foreach($students as $student)

                <tr>

                    <td>{{ $student->id }}</td>

                    <td><a href="/students/show/{{ $student->id }}">{{ $student->name }}</a></td>

                    <td>{{ $student->email }}</td>

                    <td>{{ $student->phone }}</td>

                    <td>{{ $student->department }}</td>

                    <td>{{ $student->year }}</td>

                    <td>

                        <a href="/students/edit/{{ $student->id }}"
                        class="btn btn-success">
                            Edit
                        </a>

                        <a href="/students/delete/{{ $student->id }}"
                        class="btn btn-danger">
                            Delete
                        </a>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <div class="mt-3">
            {{ $students->links() }}
        </div>

    </div>
    <div class="mb-3">

    <a href="/students/create" class="btn btn-primary">
        Add Student
    </a>

    <a href="/students/pdf" class="btn btn-danger">
        Download PDF
    </a>

</div>

</div>
@endsection
</body>
</html>