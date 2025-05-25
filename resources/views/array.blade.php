@extends('layout.layout1')

@section('title', 'Contact Us')
<div class="container">
    <h2 class="mb-4">Student List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            @php
                $students = [
                    ['id' => 123, 'name' => 'Kim Taehyung', 'age' => 20, 'gender' => 'Male'],
                    ['id' => 234, 'name' => 'Kim Seokjin', 'age' => 22, 'gender' => 'Male'],
                    ['id' => 345, 'name' => 'Min Yoongi', 'age' => 21, 'gender' => 'Female'],
                    ['id' => 456, 'name' => 'Jeon Jungkook', 'age' => 23, 'gender' => 'Male'],
                    ['id' => 567, 'name' => 'Park Jimin', 'age' => 19, 'gender' => 'Male'],
                    ['id' => 678, 'name' => 'Jung Hoseok', 'age' => 24, 'gender' => 'Female'],
                    ['id' => 789, 'name' => 'Kim Namjoon', 'age' => 22, 'gender' => 'Male'],
                    ['id' => 891, 'name' => 'Lee MinHo', 'age' => 20, 'gender' => 'Male'],
                    ['id' => 912, 'name' => 'Heesung', 'age' => 21, 'gender' => 'Male'],
                    ['id' => 101, 'name' => 'Ken Suson', 'age' => 23, 'gender' => 'Male'],
                ];
            @endphp
            
            @foreach($students as $student)
                <tr>
                    <td>{{ $student['id'] }}</td>
                    <td>{{ $student['name'] }}</td>
                    <td>{{ $student['age'] }}</td>
                    <td>{{ $student['gender'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>