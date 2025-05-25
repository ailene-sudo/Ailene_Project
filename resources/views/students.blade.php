@extends('layout')

@section('content')
<div class="container py-5">

    @if(session('message'))
        <div class="alert alert-success text-center fw-semibold">
            {{ session('message') }}
        </div>
    @endif

    <h1 class="text-center mb-4 fw-bold text-success">Student Information</h1>

    <div class="table-container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- <h5 class="mb-0 text-muted">Manage student records</h5> -->
            <a href="{{ route('students.create') }}" class="btn btn-success shadow-sm">+ Add New Student</a>
        </div>

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-success">
                    <tr>
                        <th scope="col" style="color: darkgreen;">Student ID</th>
                        <th scope="col" style="color: darkgreen;">First Name</th>
                        <th scope="col" style="color: darkgreen;">Middle Name</th>
                        <th scope="col" style="color: darkgreen;">Last Name</th>
                        <th scope="col" style="color: darkgreen;">Address</th>
                        <th scope="col" style="color: darkgreen;">Contact Number</th>
                        <th scope="col" class="text-center" style="color: darkgreen;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $stud)
                        <tr>
                            <td>{{ $stud->studentid }}</td>
                            <td>{{ $stud->fname }}</td>
                            <td>{{ $stud->mname }}</td>
                            <td>{{ $stud->lname }}</td>
                            <td>{{ $stud->address }}</td>
                            <td>{{ $stud->contactno }}</td>
                            <td class="text-center">
                                <a href="{{ route('students.show', $stud->id) }}" class="btn btn-sm btn-info text-white me-1">View</a>
                                <a href="{{ route('students.edit', $stud->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                <form action="{{ route('students.destroy', $stud->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $students->links() }}
        </div>
    </div>
</div>
@endsection
