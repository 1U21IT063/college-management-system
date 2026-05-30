@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card p-4">

        <h2>Edit Marks</h2>

        <form action="/marks/update/{{ $mark->id }}" method="POST">

            @csrf

            <div class="mb-3">

                <label>Student</label>

                <select name="student_id" class="form-control">

                    @foreach($students as $student)

                    <option value="{{ $student->id }}"
                    {{ $mark->student_id == $student->id ? 'selected' : '' }}>

                        {{ $student->name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Subject</label>

                <input type="text"
                name="subject"
                class="form-control"
                value="{{ $mark->subject }}">

            </div>

            <div class="mb-3">

                <label>Internal Mark</label>

                <input type="number"
                name="internal_mark"
                class="form-control"
                value="{{ $mark->internal_mark }}">

            </div>

            <div class="mb-3">

                <label>External Mark</label>

                <input type="number"
                name="external_mark"
                class="form-control"
                value="{{ $mark->external_mark }}">

            </div>

            <button class="btn btn-success">
                Update Marks
            </button>

        </form>

    </div>

</div>

@endsection