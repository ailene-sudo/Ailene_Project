@extends('layout')

@section('title', 'Students')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-success fw-bold">Students List</h1>
        <a href="{{ route('students.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i>Add New Student
        </a>
    </div>

    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('password_message'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('password_message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="bg-success text-white">
                            <th class="py-3">Image</th>
                            <th class="py-3">Student ID</th>
                            <th class="py-3">Name</th>
                            <th class="py-3">Address</th>
                            <th class="py-3">Contact No</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td class="align-middle" style="width: 100px;">
                                    @if($student->image_path)
                                        <img src="{{ asset('storage/' . $student->image_path) }}" 
                                             alt="Student Image" 
                                             class="img-thumbnail"
                                             style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" 
                                             style="width: 80px; height: 80px;">
                                            <i class="bi bi-person-circle text-secondary" style="font-size: 2rem;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="align-middle fw-bold text-success">{{ $student->studentid }}</td>
                                <td class="align-middle">
                                    {{ $student->fname }} 
                                    {{ $student->mname ? $student->mname . ' ' : '' }}
                                    {{ $student->lname }}
                                </td>
                                <td class="align-middle">{{ $student->address }}</td>
                                <td class="align-middle">{{ $student->contactno }}</td>
                                <td class="align-middle">{{ $student->email }}</td>
                                <td class="align-middle">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('students.show', $student->id) }}" 
                                           class="btn btn-info btn-sm text-white">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('students.edit', $student->id) }}" 
                                           class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('students.destroy', $student->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this student?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $students->links() }}
    </div>
</div>
@endsection
