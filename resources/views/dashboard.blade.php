
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h1 class="mb-4">College Dashboard</h1>

    <div class="row">

        <div class="col-md-3 mb-3">
            <a href="/students" class="text-decoration-none">
                <div class="card shadow border-0">
                    <div class="card-body text-center">
                        <h5>Total Students</h5>
                        <h2>{{ $students }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="/staff" class="text-decoration-none">
                <div class="card shadow border-0">
                    <div class="card-body text-center">
                        <h5>Total Staff</h5>
                        <h2>{{ $staff }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="/courses" class="text-decoration-none">
                <div class="card shadow border-0">
                    <div class="card-body text-center">
                        <h5>Courses</h5>
                        <h2>{{ $courses }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="/departments" class="text-decoration-none">
                <div class="card shadow border-0">
                    <div class="card-body text-center">
                        <h5>Departments</h5>
                        <h2>{{ $departments }}</h2>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <div class="card shadow mt-4">
        <div class="card-header">
            <h4>Students vs Staff Chart</h4>
        </div>

        <div class="card-body">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <div class="card shadow mt-4">

        <div class="card-header d-flex justify-content-between">

            <h4>Recent Students</h4>

            <a href="/students" class="btn btn-primary">
                View All
            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Year</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($recentStudents as $student)

                    <tr>

                        <td>{{ $student->id }}</td>

                        <td>
                            <a href="/students/show/{{ $student->id }}">
                                {{ $student->name }}
                            </a>
                        </td>

                        <td>{{ $student->email }}</td>

                        <td>{{ $student->department }}</td>

                        <td>{{ $student->year }}</td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Students', 'Staff'],
        datasets: [{
            label: 'College Statistics',
            data: [{{ $students }}, {{ $staff }}]
        }]
    }
});

</script>

@endsection

