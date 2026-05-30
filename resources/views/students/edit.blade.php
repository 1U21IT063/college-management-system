<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Edit Student</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f7fb;">

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h2 class="mb-4">Edit Student</h2>

        <form action="/students/update/{{ $student->id }}" method="POST">

            @csrf

            <div class="mb-3">

                <label>Name</label>

                <input type="text"
                name="name"
                class="form-control"
                value="{{ $student->name }}">

            </div>

            <div class="mb-3">

                <label>Email</label>

                <input type="email"
                name="email"
                class="form-control"
                value="{{ $student->email }}">

            </div>

            <div class="mb-3">

                <label>Phone</label>

                <input type="text"
                name="phone"
                class="form-control"
                value="{{ $student->phone }}">

            </div>

            <div class="mb-3">

                <label>Department</label>

                <input type="text"
                name="department"
                class="form-control"
                value="{{ $student->department }}">

            </div>

            <div class="mb-3">

                <label>Year</label>

                <input type="text"
                name="year"
                class="form-control"
                value="{{ $student->year }}">

            </div>

            <button class="btn btn-primary">
                Update Student
            </button>

        </form>

    </div>

</div>

</body>
</html>