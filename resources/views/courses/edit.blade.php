<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Edit Course</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f7fb;">

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h2 class="mb-4">Edit Course</h2>

        <form action="/courses/update/{{ $course->id }}" method="POST">

            @csrf

            <div class="mb-3">

                <label>Course Name</label>

                <input type="text"
                name="course_name"
                class="form-control"
                value="{{ $course->course_name }}">

            </div>

            <div class="mb-3">

                <label>Course Code</label>

                <input type="text"
                name="course_code"
                class="form-control"
                value="{{ $course->course_code }}">

            </div>

            <div class="mb-3">

                <label>Duration</label>

                <input type="number"
                name="duration"
                class="form-control"
                value="{{ $course->duration }}">

            </div>

            <button class="btn btn-primary">
                Update Course
            </button>

        </form>

    </div>

</div>

</body>
</html>