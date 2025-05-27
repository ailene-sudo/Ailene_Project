@extends('layout')

@section('title', 'Edit Student')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card p-4 shadow-sm">
                <h1 class="text-center mb-4">Edit Student</h1>

                <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-4">
                            {{-- Current Image --}}
                            <div class="form-group mb-4 text-center">
                                <label>Current Image</label>
                                <div class="mt-2">
                                    @if($student->image_path)
                                        <img src="{{ asset('storage/' . $student->image_path) }}" alt="Student Image" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                    @else
                                        <p class="text-muted">No image uploaded</p>
                                    @endif
                                </div>
                            </div>

                            {{-- New Image Upload --}}
                            <div class="form-group mb-4">
                                <label for="image">Update Image</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div id="imagePreview" class="mt-2 text-center" style="display: none;">
                                    <img src="" alt="Preview" style="max-width: 200px; max-height: 200px;" class="img-thumbnail">
                                </div>
                            </div>

                            {{-- Student ID --}}
                            <div class="form-group mb-3">
                                <label for="studentid">Student ID</label>
                                <input type="text" name="studentid" id="studentid" class="form-control" value="{{ old('studentid', $student->studentid) }}" readonly>
                                @error('studentid')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Middle Column -->
                        <div class="col-md-4">
                            {{-- First Name --}}
                            <div class="form-group mb-3">
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" id="fname" class="form-control" value="{{ old('fname', $student->fname) }}">
                                @error('fname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Middle Name --}}
                            <div class="form-group mb-3">
                                <label for="mname">Middle Name</label>
                                <input type="text" name="mname" id="mname" class="form-control" value="{{ old('mname', $student->mname) }}">
                                @error('mname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Last Name --}}
                            <div class="form-group mb-3">
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control" value="{{ old('lname', $student->lname) }}">
                                @error('lname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-4">
                            {{-- Address --}}
                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $student->address) }}">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Contact Number --}}
                            <div class="form-group mb-3">
                                <label for="contactno">Contact Number</label>
                                <input type="text" name="contactno" id="contactno" class="form-control" value="{{ old('contactno', $student->contactno) }}">
                                @error('contactno')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="form-group mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $student->email) }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Submit + Cancel --}}
                    <div class="form-group text-center mt-4">
                        <button type="submit" class="btn btn-primary">Update Student</button>
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