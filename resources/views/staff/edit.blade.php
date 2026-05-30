<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Edit Staff</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f7fb;">

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h2 class="mb-4">Edit Staff</h2>

        <form action="/staff/update/{{ $staff->id }}" method="POST">

            @csrf

            <div class="mb-3">

                <label>Name</label>

                <input type="text"
                name="name"
                class="form-control"
                value="{{ $staff->name }}">

            </div>

            <div class="mb-3">

                <label>Email</label>

                <input type="email"
                name="email"
                class="form-control"
                value="{{ $staff->email }}">

            </div>

            <div class="mb-3">

                <label>Phone</label>

                <input type="text"
                name="phone"
                class="form-control"
                value="{{ $staff->phone }}">

            </div>

            <div class="mb-3">

                <label>Department</label>

                <input type="text"
                name="department"
                class="form-control"
                value="{{ $staff->department }}">

            </div>

            <div class="mb-3">

                <label>Role</label>

                <input type="text"
                name="role"
                class="form-control"
                value="{{ $staff->role }}">

            </div>

            <button class="btn btn-primary">
                Update Staff
            </button>

        </form>

    </div>

</div>

</body>
</html>