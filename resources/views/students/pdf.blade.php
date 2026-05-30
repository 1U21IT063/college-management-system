<!DOCTYPE html>
<html>
<head>

    <title>Students Report</title>

    <style>

        body{
            font-family: Arial, sans-serif;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table, th, td{
            border:1px solid black;
        }

        th, td{
            padding:10px;
            text-align:left;
        }

        h2{
            text-align:center;
        }

    </style>

</head>
<body>

<h2>Students Report</h2>

<table>

    <thead>

        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Department</th>
            <th>Year</th>

        </tr>

    </thead>

    <tbody>

        @foreach($students as $student)

        <tr>

            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>
            <td>{{ $student->department }}</td>
            <td>{{ $student->year }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

</body>
</html>