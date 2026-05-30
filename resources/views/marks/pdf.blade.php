<!DOCTYPE html>
<html>
<head>
    <title>Marks Report</title>

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

<h2 align="center">Marks Report</h2>

<table>

    <thead>

        <tr>

            <th>Student</th>
            <th>Subject</th>
            <th>Internal</th>
            <th>External</th>
            <th>Total</th>
            <th>Grade</th>

        </tr>

    </thead>

    <tbody>

        @foreach($marks as $mark)

        <tr>

            <td>{{ $mark->student->name }}</td>

            <td>{{ $mark->subject }}</td>

            <td>{{ $mark->internal_mark }}</td>

            <td>{{ $mark->external_mark }}</td>

            <td>{{ $mark->total_mark }}</td>

            <td>{{ $mark->grade }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

</body>
</html>