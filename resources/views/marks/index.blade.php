@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-3">

        <h2>Marks Management</h2>

        <a href="/marks/create" class="btn btn-primary">
            Add Marks
        </a>

    </div>

    <table class="table table-bordered">

        <thead>

            <tr>

                <th>ID</th>
                <th>Student</th>
                <th>Subject</th>
                <th>Internal</th>
                <th>External</th>
                <th>Total</th>
                <th>Grade</th>
                <th>Action</th>

            </tr>

        </thead>

        <tbody>

            @foreach($marks as $mark)

            <tr>

                <td>{{ $mark->id }}</td>

                <td>{{ $mark->student->name }}</td>

                <td>{{ $mark->subject }}</td>

                <td>{{ $mark->internal_mark }}</td>

                <td>{{ $mark->external_mark }}</td>

                <td>{{ $mark->total_mark }}</td>

                <td>{{ $mark->grade }}</td>

                <td>

                    <a href="/marks/edit/{{ $mark->id }}"
                    class="btn btn-success btn-sm">
                        Edit
                    </a>

                    <a href="/marks/delete/{{ $mark->id }}"
                    class="btn btn-danger btn-sm">
                        Delete
                    </a>

                    <a href="/marks/pdf" class="btn btn-danger mb-3">Download PDF</a>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection