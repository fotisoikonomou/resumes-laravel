{{-- Listing Candidates --}}
@extends('layouts.app')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Υποψήφιοι</h2>
            <a href="{{ route('candidates.create') }}" class="btn btn-primary">Add New Candidate</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Degree</th>
                        <th>Job Applied For</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($candidates as $candidate)
                    <tr>
                        <td>{{ $candidate->lastName }}</td>
                        <td>{{ $candidate->firstName }}</td>
                        <td>{{ $candidate->email }}</td>
                        <td>{{ $candidate->mobile }}</td>
                        <td>{{ $candidate->degree->degreeTitle }}</td>
                        <td>{{ $candidate->jobAppliedFor }}</td>
                        <td>
                            <a href="{{ route('candidates.edit', $candidate->id) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection