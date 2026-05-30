@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <a href="/students" class="btn btn-secondary mb-3">
        ← Back to Students
    </a>

    <div class="card shadow mb-4">

        <div class="card-header bg-primary text-white">
            <h3>Student Profile</h3>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <h4>{{ $student->name }}</h4>

                    <p><strong>Email:</strong> {{ $student->email }}</p>

                    <p><strong>Phone:</strong> {{ $student->phone }}</p>

                    <p><strong>Department:</strong> {{ $student->department }}</p>

                    <p><strong>Year:</strong> {{ $student->year }}</p>

                </div>

            </div>

        </div>

    </div>

    <!-- Fees Details -->

    <div class="card shadow mb-4">

        <div class="card-header">
            <h4>Fees Details</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead class="table-dark">

                    <tr>
                        <th>Total Fee</th>
                        <th>Paid Fee</th>
                        <th>Balance Fee</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($fees as $fee)

                    <tr>

                        <td>₹{{ $fee->total_fee }}</td>

                        <td>₹{{ $fee->paid_fee }}</td>

                        <td>₹{{ $fee->balance_fee }}</td>

                        <td>{{ $fee->status }}</td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            No Fee Records Found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- Marks Details -->

    <div class="card shadow mb-4">

        <div class="card-header">
            <h4>Marks Details</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead class="table-dark">

                    <tr>

                        <th>Subject</th>
                        <th>Internal</th>
                        <th>External</th>
                        <th>Total</th>
                        <th>Grade</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($marks as $mark)

                    <tr>

                        <td>{{ $mark->subject }}</td>

                        <td>{{ $mark->internal_mark }}</td>

                        <td>{{ $mark->external_mark }}</td>

                        <td>{{ $mark->total_mark }}</td>

                        <td>{{ $mark->grade }}</td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            No Marks Records Found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- Attendance Details -->

    <div class="card shadow">

        <div class="card-header">
            <h4>Attendance Details</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead class="table-dark">

                    <tr>

                        <th>Date</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($attendance as $a)

                    <tr>

                        <td>{{ $a->date }}</td>

                        <td>{{ $a->status }}</td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="2" class="text-center">
                            No Attendance Records Found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection