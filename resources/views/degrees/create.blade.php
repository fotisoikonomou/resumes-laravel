{{-- Create Degree --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Degree</h2>
    <form action="{{ route('degrees.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="degreeTitle">Degree Title:</label>
            <input type="text" class="form-control" id="degreeTitle" name="degreeTitle" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection