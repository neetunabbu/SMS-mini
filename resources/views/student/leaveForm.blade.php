@extends('layouts.student') <!-- Use the same layout -->

@section('content')
    <h2>Apply for Leave</h2>

    <form action="{{ route('student.submitLeave') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="reason">Reason</label>
            <input type="text" name="reason" id="reason" required class="form-control">
        </div>

        <div class="form-group">
            <label for="from_date">From Date</label>
            <input type="date" name="from_date" id="from_date" required class="form-control">
        </div>

        <div class="form-group">
            <label for="to_date">To Date</label>
            <input type="date" name="to_date" id="to_date" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Submit Leave</button>
    </form>
@endsection
