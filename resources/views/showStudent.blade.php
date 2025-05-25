@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="student-card">
         <!-- <h2>Student Details</h2> -->
          <h2 class="text-center mb-3 fw-bold text-success">STUDENT DETAILS</h2> 
        <div class="student-info">
            <p><strong>Student ID:</strong> {{ $student->studentid }}</p>
            <p><strong>First Name:</strong> {{ $student->fname }}</p>
            <p><strong>Middle Name:</strong> {{ $student->mname }}</p>
            <p><strong>Last Name:</strong> {{ $student->lname }}</p>
            <p><strong>Address:</strong> {{ $student->address }}</p>
            <p><strong>Contact Number:</strong> {{ $student->contactno }}</p>
            <p><strong>Email:</strong> {{ $student->email }}</p>
        </div>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection
