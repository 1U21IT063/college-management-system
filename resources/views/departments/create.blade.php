<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Add Department</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f7fb;">

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h2 class="mb-4">Add Department</h2>

        <form action="/departments/store" method="POST">

            @csrf

            <div class="mb-3">

                <label>Department Name</label>

                <input type="text"
                name="department_name"
                class="form-control">

            </div>

            <div class="mb-3">

                <label>HOD Name</label>

                <input type="text"
                name="hod"
                class="form-control">

            </div>

            <button class="btn btn-primary">
                Add Department
            </button>

        </form>

    </div>

</div>

</body>
</html>