<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Student</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="card p-4">

        <h2>Add Student</h2>

        <form action="/students/store" method="POST">

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
                <label>Year</label>

                <input type="text"
                name="year"
                class="form-control">
            </div>

            <button class="btn btn-primary">
                Add Student
            </button>

        </form>

    </div>

</div>

</body>
</html>