<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ManageStudentController extends Controller
{
    // Display all students
    public function index()
    {
        $students = Student::paginate(5);
        return view('students', compact('students'));
    }

    // Show form to create a new student
    public function create()
    {
        return view("addStudentForm");
    }

    // Store a new student
    public function store(Request $request)
    {
        // Manually validate the request
        $validator = Validator::make($request->all(), [
            'studentid' => 'required|min:4|max:20|unique:students',
            'fname'     => 'required|min:3|max:20',
            'mname'     => 'nullable|min:2|max:20',
            'lname'     => 'required|min:3|max:20',
            'address'   => 'required|max:255',
            'contactno' => 'required|numeric'
        ]);

        // If validation fails, redirect back to the form
        if ($validator->fails()) {
            return redirect()->route('students.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Create and save new student
        $student = new Student();
        $student->studentid = $request->studentid;
        $student->fname = $request->fname;
        $student->mname = $request->mname;
        $student->lname = $request->lname;
        $student->address = $request->address;
        $student->contactno = $request->contactno;
        $student->save();

        // Log the newly created student
        Log::info("Student: {$student->studentid} has been stored with the following details — First Name: {$student->fname}, Middle Name: {$student->mname}, Last Name: {$student->lname}, Address: {$student->address}, Contact No: {$student->contactno}");

        // Redirect to index with success message
        return redirect()->route('students.index')->with('message', 'Student Successfully Saved!');
    }

    // Show a student's details
    public function show($id)
    {
        $student = Student::find($id);
        return view('showStudent', compact('student'));
    }

    // Show form to edit a student
    public function edit($id)
    {
        $student = Student::find($id);
        return view('editStudentForm', compact('student'));
    }

    // Update a student's information
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        // Validation
        $validator = Validator::make($request->all(), [
            'studentid' => 'required|min:4|max:20|unique:students,studentid,' . $id,
            'fname' => 'required|min:3|max:20',
            'mname' => 'nullable|min:2|max:20',
            'lname' => 'required|min:3|max:20',
            'address' => 'required|max:255',
            'contactno' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Store original attributes for comparison
        $originalAttributes = $student->getAttributes();

        // Identify changes
        $changes = [];
        foreach (['studentid', 'fname', 'mname', 'lname', 'address', 'contactno'] as $field) {
            if ($student->$field != $request->$field) {
                $changes[] = ucfirst($field) . ": from {$student->$field} to {$request->$field}";
            }
        }

        // Update the student with new data
        $student->update($request->all());

        // Log changes
        if (!empty($changes)) {
            Log::info("Student: {$student->studentid} is updated with the following changes: " . implode(', ', $changes));
        } else {
            Log::info("Student: {$student->studentid} was updated but no changes were made.");
        }

        // Redirect to index with success message
        return redirect()->route('students.index')->with('message', 'Student Successfully Updated!');
    }

    // Delete a student
    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            // Log the deleted student
            Log::info("Student: {$student->studentid} is deleted. Details — First Name: {$student->fname}, Middle Name: {$student->mname}, Last Name: {$student->lname}, Address: {$student->address}, Contact No: {$student->contactno}");
            $student->delete();
        }

        // Redirect to index with success message
        return redirect()->route('students.index')->with('message', 'Student Successfully Deleted!');
    }
}
