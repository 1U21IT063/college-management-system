<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Edit Fees</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f7fb;">

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h2 class="mb-4">Edit Student Fees</h2>

        <form action="/fees/update/{{ $fee->id }}" method="POST">

            @csrf

            <div class="mb-3">

                <label>Select Student</label>

                <select name="student_id" class="form-control">

                    @foreach($students as $student)

                    <option value="{{ $student->id }}"
                        {{ $fee->student_id == $student->id ? 'selected' : '' }}>

                        {{ $student->name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Total Fees</label>

                <input type="number"
                name="total_fee"
                class="form-control"
                value="{{ $fee->total_fee }}">

            </div>

            <div class="mb-3">

                <label>Paid Fees</label>

                <input type="number"
                name="paid_fee"
                class="form-control"
                value="{{ $fee->paid_fee }}">

            </div>

            <div class="mb-3">

                <label>Payment Date</label>

                <input type="date"
                name="payment_date"
                class="form-control"
                value="{{ $fee->payment_date }}">

            </div>

            <button class="btn btn-primary">
                Update Fees
            </button>

        </form>

    </div>

</div>

</body>
</html>