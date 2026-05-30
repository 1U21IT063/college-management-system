<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Fees Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f7fb;">
    @extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card p-4 shadow">

        <div class="d-flex justify-content-between mb-4">

            <h2>Fees Management</h2>

            <a href="/fees/create" class="btn btn-primary">
                Add Fees
            </a>

        </div>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Total Fees</th>
                    <th>Paid Fees</th>
                    <th>Balance Fees</th>
                    <th>Status</th>
                    <th>Payment Date</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                @foreach($fees as $fee)

                <tr>

                    <td>{{ $fee->id }}</td>

                    <td>{{ $fee->student->name }}</td>

                    <td>₹ {{ $fee->total_fee }}</td>

                    <td>₹ {{ $fee->paid_fee }}</td>

                    <td>₹ {{ $fee->balance_fee }}</td>

                    <td>

                        @if($fee->status == 'Paid')

                            <span class="badge bg-success">
                                Paid
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Pending
                            </span>

                        @endif

                    </td>

                    <td>{{ $fee->payment_date }}</td>

                        <td>
                            <a href="/fees/edit/{{ $fee->id }}"class="btn btn-success">Edit</a>
                            <a href="/fees/delete/{{ $fee->id }}"class="btn btn-danger">Delete</a>
                            <a href="/fees/pdf" class="btn btn-danger">Download PDF</a>
                        </td>

                </tr>

                

                @endforeach

            </tbody>

        </table>

    </div>

</div>
@endsection
</body>
</html>



