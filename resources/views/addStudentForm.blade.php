@extends('layout')

@section('title', 'Add Student')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card p-4 shadow-sm">
        <h1 class="text-center mb-4">Add Student</h1>

        {{-- Display Session Message (Optional) --}}
        @if(session('message'))
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Student Image --}}
            <div class="form-group mb-4">
                <label for="image">Student Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div id="imagePreview" class="mt-2 text-center" style="display: none;">
                    <img src="" alt="Preview" style="max-width: 200px; max-height: 200px;" class="img-thumbnail">
                </div>
            </div>

            {{-- First Name --}}
            <div class="form-group mb-3">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname" class="form-control" value="{{ old('fname') }}" autofocus>
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

            {{-- Email --}}
            <div class="form-group mb-4">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                @error('email')
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
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const img = preview.querySelector('img');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endpush
@endsection
