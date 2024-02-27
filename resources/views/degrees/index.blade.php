{{--  Degrees --}}
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
    <h2>Degrees</h2>
    <a href="{{ route('degrees.create') }}" class="btn btn-primary">Add New Degree</a>
    <table class="table">
        <thead>
            <tr>
                <th>Degree Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($degrees as $degree)
            <tr>
                <td>{{ $degree->degreeTitle }}</td>
                <td>
                 
                    <form action="{{ route('degrees.destroy', $degree->id) }}" method="POST" style="display:inline">
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
@endsection