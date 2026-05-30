<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Add Staff</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f7fb;">

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h2 class="mb-4">Add Staff</h2>

        <form action="/staff/store" method="POST">

            @csrf

            <div class="mb-3">

                <label>Name</label>

                <input type="text"
                name="name"
                class="form-control">

            </div>

            <div class="mb-3">

                <label>Email</label>

                <input type="email"
                name="email"
                class="form-control">

            </div>

            <div class="mb-3">

                <label>Phone</label>

                <input type="text"
                name="phone"
                class="form-control">

            </div>

            <div class="mb-3">

                <label>Department</label>

                <input type="text"
                name="department"
                class="form-control">

            </div>

            <div class="mb-3">

                <label>Role</label>

                <input type="text"
                name="role"
                class="form-control">

            </div>

            <button class="btn btn-primary">
                Add Staff
            </button>

        </form>

    </div>

</div>

</body>
</html>