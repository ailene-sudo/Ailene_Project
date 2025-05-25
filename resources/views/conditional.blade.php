@extends('layout.layout1') <!-- Use your layout -->

@section('title', 'Student List and Grade Calculation')

@section('content')
<div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="row w-100 justify-content-center"> <!-- Added justify-content-center to row for proper centering -->

        <!-- Student List Section -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <!-- <h3 class="card-title custom-header">Students List</h3> -->
                    <h2 class="text-center mb-3 fw-bold text-success">STUDENT LISTS</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Course</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Define the student data directly in the Blade view
                                $students = [
                                    ["ID" => "22-SC-3101", "name" => "Mark", "age" => 14, "course" => "MD101"],
                                    ["ID" => "22-SC-3102", "name" => "Maariz", "age" => 15, "course" => "MD101"],
                                    ["ID" => "22-SC-3103", "name" => "May Marie", "age" => 18, "course" => "MD101"],
                                    ["ID" => "22-SC-3104", "name" => "Jenelyn", "age" => 13, "course" => "MD101"],
                                    ["ID" => "22-SC-3105", "name" => "Ailene", "age" => 16, "course" => "MD101"],
                                    ["ID" => "22-SC-3106", "name" => "Riza", "age" => 13, "course" => "MD101"],
                                    ["ID" => "22-SC-3107", "name" => "Joel", "age" => 15, "course" => "MD101"],
                                    ["ID" => "22-SC-3108", "name" => "Ashley", "age" => 16, "course" => "MD101"],
                                    ["ID" => "22-SC-3109", "name" => "Naizza", "age" => 15, "course" => "MD101"],
                                    ["ID" => "22-SC-31010", "name" => "Lj", "age" => 14, "course" => "MD101"]
                                ];
                            @endphp

                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student['ID'] }}</td>
                                    <td>{{ $student['name'] }}</td>
                                    <td>{{ $student['age'] }}</td>
                                    <td>{{ $student['course'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Grade Calculation Section -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <!-- <h3 class="card-title custom-header">Grade Calculation</h3> -->
                    <h2 class="text-center mb-3 fw-bold text-success">GRADE CALCULATION</h2>

                    @php
                        // For demonstration, using a fixed grade. You can replace this with dynamic input as needed.
                        $grade = request()->query('grade', 85); // Default to grade 85 if not provided
                    @endphp

                    <p class="card-text">
                        @if(is_null($grade) || !is_numeric($grade))
                            <strong class="text-danger">Invalid Grades</strong>
                        @elseif($grade >= 1 && $grade <= 74)
                            Your grade {{ $grade }} = 5.00
                        @elseif($grade == 75)
                            Your grade {{ $grade }} = 3.00
                        @elseif($grade >= 76 && $grade <= 79)
                            Your grade {{ $grade }} = 2.75
                        @elseif($grade >= 80 && $grade <= 81)
                            Your grade {{ $grade }} = 2.50
                        @elseif($grade >= 82 && $grade <= 84)
                            Your grade {{ $grade }} = 2.25
                        @elseif($grade >= 85 && $grade <= 87)
                            Your grade {{ $grade }} = 2.00
                        @elseif($grade >= 88 && $grade <= 90)
                            Your grade {{ $grade }} = 1.75
                        @elseif($grade >= 91 && $grade <= 93)
                            Your grade {{ $grade }} = 1.50
                        @elseif($grade >= 94 && $grade <= 96)
                            Your grade {{ $grade }} = 1.25
                        @elseif($grade >= 97 && $grade <= 100)
                            Your grade {{ $grade }} = 1.00
                        @else
                            <strong class="text-danger">Invalid Grades</strong>
                        @endif
                    </p>
                    <br>
                    <p>Star Pattern</p>
                    @php
                        $s = 10; // size of the pattern
                    @endphp
                    
                    @for ($i = 1; $i <= $s; $i++)
                        @for($j = 1; $j <= $i; $j++)
                            @if($j == 1 || $i == $s || $j == $i)
                                *
                            @else
                                _
                            @endif
                        @endfor
                        <br>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
