@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card p-4">

        <h2>Add Marks</h2>

        <form action="/marks/store" method="POST">

            @csrf

            <div class="mb-3">

                <label>Student</label>

                <select name="student_id" class="form-control">

                    @foreach($students as $student)

                    <option value="{{ $student->id }}">
                        {{ $student->name }}
                    </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Subject</label>

                <input type="text"
                name="subject"
                class="form-control">

            </div>

            <div class="mb-3">

                <label>Internal Mark</label>

                <input type="number"
                name="internal_mark"
                class="form-control">

            </div>

            <div class="mb-3">

                <label>External Mark</label>

                <input type="number"
                name="external_mark"
                class="form-control">

            </div>

            <button class="btn btn-primary">
                Save Marks
            </button>

        </form>

    </div>

</div>

@endsection
