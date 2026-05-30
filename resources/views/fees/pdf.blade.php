<!DOCTYPE html>
<html>
<head>
    <title>Fees Report</title>

    <style>

        body{
            font-family: Arial;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table,th,td{
            border:1px solid black;
        }

        th,td{
            padding:8px;
        }

    </style>

</head>
<body>

<h2 align="center">Fees Report</h2>

<table>

    <thead>

        <tr>

            <th>Student</th>
            <th>Total Fee</th>
            <th>Paid Fee</th>
            <th>Balance Fee</th>
            <th>Status</th>

        </tr>

    </thead>

    <tbody>

        @foreach($fees as $fee)

        <tr>

            <td>{{ $fee->student->name }}</td>

            <td>₹{{ $fee->total_fee }}</td>

            <td>₹{{ $fee->paid_fee }}</td>

            <td>₹{{ $fee->balance_fee }}</td>

            <td>{{ $fee->status }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

</body>
</html>