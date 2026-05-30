<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Staff List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f7fb;">
    @extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card p-4 shadow">

        <div class="d-flex justify-content-between mb-4">

            <h2>Staff List</h2>

            <div>

                <form action="/staff" method="GET" class="d-flex">

                    <input type="text"
                    name="search"
                    class="form-control me-2"
                    placeholder="Search Staff">

                    <button class="btn btn-dark">
                        Search
                    </button>

                </form>

            </div>

            <a href="/staff/create" class="btn btn-primary">
                Add Staff
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
                    <th>Role</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                @foreach($staff as $item)

                <tr>

                    <td>{{ $item->id }}</td>

                    <td>{{ $item->name }}</td>

                    <td>{{ $item->email }}</td>

                    <td>{{ $item->phone }}</td>

                    <td>{{ $item->department }}</td>

                    <td>{{ $item->role }}</td>

                    <td>

                        <a href="/staff/edit/{{ $item->id }}"
                        class="btn btn-success">
                            Edit
                        </a>

                        <a href="/staff/delete/{{ $item->id }}"
                        class="btn btn-danger">
                            Delete
                        </a>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <div class="mt-3">
            {{ $staff->links() }}
        </div>

    </div>

</div>
@endsection
</body>
</html>