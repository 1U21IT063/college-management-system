<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Course List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f7fb;">
    @extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card p-4 shadow">

        <div class="d-flex justify-content-between mb-4">

            <h2>Course List</h2>

            <div>

                <form action="/courses" method="GET" class="d-flex">

                    <input type="text"
                    name="search"
                    class="form-control me-2"
                    placeholder="Search Course">

                    <button class="btn btn-dark">
                        Search
                    </button>

                </form>

            </div>

            <a href="/courses/create" class="btn btn-primary">
                Add Course
            </a>

        </div>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Course Name</th>
                    <th>Course Code</th>
                    <th>Duration</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                @foreach($courses as $course)

                <tr>

                    <td>{{ $course->id }}</td>

                    <td>{{ $course->course_name }}</td>

                    <td>{{ $course->course_code }}</td>

                    <td>{{ $course->duration }} Years</td>

                    <td>

                        <a href="/courses/edit/{{ $course->id }}"
                        class="btn btn-success">
                            Edit
                        </a>

                        <a href="/courses/delete/{{ $course->id }}"
                        class="btn btn-danger">
                            Delete
                        </a>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <div class="mt-3">
            {{ $courses->links() }}
        </div>

    </div>

</div>
@endsection
</body>
</html>