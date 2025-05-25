@extends('layout.layout1')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh; overflow: hidden;">
    <div class="card shadow-sm border-0 p-4 w-100" style="max-width: 500px;">
        <h2 class="text-center mb-3 fw-bold text-success">Edit Student</h2>
        
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-2">
                <label for="studentid" class="form-label fw-semibold">Student ID</label>
                <input type="text" name="studentid" id="studentid" class="form-control"
                       value="{{ strlen(old('studentid')) ? old('studentid') : $student->studentid }}">
                @error('studentid')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="fname" class="form-label fw-semibold">First Name</label>
                <input type="text" name="fname" id="fname" class="form-control"
                       value="{{ strlen(old('fname')) ? old('fname') : $student->fname }}">
                @error('fname')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="mname" class="form-label fw-semibold">Middle Name</label>
                <input type="text" name="mname" id="mname" class="form-control"
                       value="{{ strlen(old('mname')) ? old('mname') : $student->mname }}">
                @error('mname')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="lname" class="form-label fw-semibold">Last Name</label>
                <input type="text" name="lname" id="lname" class="form-control"
                       value="{{ strlen(old('lname')) ? old('lname') : $student->lname }}">
                @error('lname')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="address" class="form-label fw-semibold">Address</label>
                <input type="text" name="address" id="address" class="form-control"
                       value="{{ strlen(old('address')) ? old('address') : $student->address }}">
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="contactno" class="form-label fw-semibold">Contact Number</label>
                <input type="text" name="contactno" id="contactno" class="form-control"
                       value="{{ strlen(old('contactno')) ? old('contactno') : $student->contactno }}">
                @error('contactno')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success px-4 fw-bold">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
