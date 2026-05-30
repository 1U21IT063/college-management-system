<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Department List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f7fb;">
    @extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card p-4 shadow">

        <div class="d-flex justify-content-between mb-4">

            <h2>Department List</h2>

            <div>

                <form action="/departments" method="GET" class="d-flex">

                    <input type="text"
                    name="search"
                    class="form-control me-2"
                    placeholder="Search Department">

                    <button class="btn btn-dark">
                        Search
                    </button>

                </form>

            </div>

            <a href="/departments/create" class="btn btn-primary">
                Add Department
            </a>

        </div>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Department Name</th>
                    <th>HOD</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                @foreach($departments as $department)

                <tr>

                    <td>{{ $department->id }}</td>

                    <td>{{ $department->department_name }}</td>

                    <td>{{ $department->hod }}</td>

                    <td>

                        <a href="/departments/edit/{{ $department->id }}"
                        class="btn btn-success">
                            Edit
                        </a>

                        <a href="/departments/delete/{{ $department->id }}"
                        class="btn btn-danger">
                            Delete
                        </a>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <div class="mt-3">
            {{ $departments->links() }}
        </div>

    </div>

</div>
@endsection

</body>
</html>