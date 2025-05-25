@extends('layout.layout1')

@section('title', 'Add Student')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-4 w-50">
        <h1 class="text-center mb-4">Add Student</h1>

        {{-- Display Session Message (Optional) --}}
        @if(session('message'))
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            {{-- Student ID --}}
            <div class="form-group mb-3">
                <label for="studentid">Student ID</label>
                <input type="text" name="studentid" id="studentid" class="form-control" value="{{ old('studentid') }}" autofocus>
                @error('studentid')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- First Name --}}
            <div class="form-group mb-3">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname" class="form-control" value="{{ old('fname') }}">
                @error('fname')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Middle Name --}}
            <div class="form-group mb-3">
                <label for="mname">Middle Name</label>
                <input type="text" name="mname" id="mname" class="form-control" value="{{ old('mname') }}">
                @error('mname')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Last Name --}}
            <div class="form-group mb-3">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname" class="form-control" value="{{ old('lname') }}">
                @error('lname')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Address --}}
            <div class="form-group mb-3">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Contact Number --}}
            <div class="form-group mb-4">
                <label for="contactno">Contact Number</label>
                <input type="text" name="contactno" id="contactno" class="form-control" value="{{ old('contactno') }}">
                @error('contactno')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Submit + Cancel --}}
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success">Add Student</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
