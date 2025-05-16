@extends('student.layouts.app')

@section('content')
<div class="container">
    <h1>Your Marks</h1>
    <div class="card">
        <div class="card-header">Marks Records</div>
        <div class="card-body">
            <ul>
                @foreach($marks as $mark)
                    <li>{{ $mark->subject->name }} - {{ $mark->marks_obtained }} marks ({{ $mark->schoolClass->name }})</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
