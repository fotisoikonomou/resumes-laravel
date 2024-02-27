{{-- Edit --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($candidate) ? 'Edit' : 'Add New' }} Candidate</h2>
    <form action="{{ isset($candidate) ? route('candidates.update', $candidate->id) : route('candidates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($candidate))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $candidate->lastName ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="firstName">First Name:</label>
            <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $candidate->firstName ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $candidate->email ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="mobile">Mobile:</label>
            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $candidate->mobile ?? '' }}" required pattern="\d{10}">
        </div>
        <div class="form-group">
            <label for="degree_id">Degree:</label>
            <select class="form-control" id="degree_id" name="degree_id" required>
                @foreach($degrees as $degree)
                    <option value="{{ $degree->id }}" {{ (isset($candidate) && $candidate->degree_id == $degree->id) ? 'selected' : '' }}>{{ $degree->degreeTitle }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="resume">Resume (PDF only):</label>
            <input type="file" class="form-control-file" id="resume" name="resume" required accept=".pdf">
        </div>
        <div class="form-group">
            <label for="jobAppliedFor">Job Applied For:</label>
            <input type="text" class="form-control" id="jobAppliedFor" name="jobAppliedFor" value="{{ $candidate->jobAppliedFor ?? '' }}" required>
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($candidate) ? 'Update' : 'Submit' }}</button>
    </form>
</div>
@endsection