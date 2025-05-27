<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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

    // Generate a unique student ID
    private function generateStudentId()
    {
        $year = Carbon::now()->format('y'); // Get last two digits of current year
        $lastStudent = Student::where('studentid', 'LIKE', "S-{$year}-%")
                            ->orderBy('studentid', 'desc')
                            ->first();

        if ($lastStudent) {
            // Extract the count from the last student ID and increment it
            $lastCount = intval(substr($lastStudent->studentid, strrpos($lastStudent->studentid, '-') + 1));
            $newCount = $lastCount + 1;
        } else {
            $newCount = 1; // First student of the year
        }

        return "S-{$year}-{$newCount}";
    }

    // Store a new student
    public function store(Request $request)
    {
        // Start database transaction
        DB::beginTransaction();

        try {
            // Manually validate the request
            $validator = Validator::make($request->all(), [
                'fname'     => 'required|min:3|max:20',
                'mname'     => 'nullable|min:2|max:20',
                'lname'     => 'required|min:3|max:20',
                'address'   => 'required|max:255',
                'contactno' => 'required|numeric',
                'email'     => 'required|email|max:255|unique:user_accounts,username',
                'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // If validation fails, redirect back to the form
            if ($validator->fails()) {
                return redirect()->route('students.create')
                                 ->withErrors($validator)
                                 ->withInput();
            }

            // Generate student ID
            $studentId = $this->generateStudentId();

            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('student-images', 'public');
            }

            // Create and save new student
            $student = new Student();
            $student->studentid = $studentId;
            $student->fname = $request->fname;
            $student->mname = $request->mname;
            $student->lname = $request->lname;
            $student->address = $request->address;
            $student->contactno = $request->contactno;
            $student->email = $request->email;
            $student->image_path = $imagePath;
            $student->save();

            // Generate default password (Studentid + first_name)
            $defaultPassword = $studentId . '-' . $request->fname;

            // Create user account
            $userAccount = new UserAccount();
            $userAccount->username = $request->email;
            $userAccount->password = Hash::make($defaultPassword);
            $userAccount->defaultpassword = true;
            $userAccount->role = 'student';
            $userAccount->status = 'active';
            $userAccount->save();

            // Log the newly created student and user account
            Log::info("Student: {$student->studentid} has been stored with the following details — First Name: {$student->fname}, Middle Name: {$student->mname}, Last Name: {$student->lname}, Address: {$student->address}, Contact No: {$student->contactno}");
            Log::info("User account created for student: {$student->studentid} with username: {$request->email}");

            // Commit the transaction
            DB::commit();

            // Redirect to index with success message and default password
            return redirect()->route('students.index')
                ->with('message', 'Student Successfully Saved!')
                ->with('password_message', "Default password for {$request->email} is: {$defaultPassword}");

        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollback();
            Log::error("Error creating student and user account: " . $e->getMessage());
            
            return redirect()->route('students.create')
                ->with('error', 'An error occurred while saving the student. Please try again.')
                ->withInput();
        }
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
            'email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Store original attributes for comparison
        $originalAttributes = $student->getAttributes();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($student->image_path) {
                Storage::disk('public')->delete($student->image_path);
            }
            
            // Store new image
            $imagePath = $request->file('image')->store('student-images', 'public');
            $request->merge(['image_path' => $imagePath]);
        }

        // Identify changes
        $changes = [];
        foreach (['studentid', 'fname', 'mname', 'lname', 'address', 'contactno', 'email', 'image_path'] as $field) {
            if ($student->$field != $request->$field) {
                $changes[] = ucfirst($field) . ": from {$student->$field} to {$request->$field}";
            }
        }

        // Update the student with new data
        $student->studentid = $request->studentid;
        $student->fname = $request->fname;
        $student->mname = $request->mname;
        $student->lname = $request->lname;
        $student->address = $request->address;
        $student->contactno = $request->contactno;
        $student->email = $request->email;
        if (isset($request->image_path)) {
            $student->image_path = $request->image_path;
        }
        $student->save();

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
            // Delete the student's image if it exists
            if ($student->image_path) {
                Storage::disk('public')->delete($student->image_path);
            }

            // Log the deleted student
            Log::info("Student: {$student->studentid} is deleted. Details — First Name: {$student->fname}, Middle Name: {$student->mname}, Last Name: {$student->lname}, Address: {$student->address}, Contact No: {$student->contactno}");
            $student->delete();
        }

        // Redirect to index with success message
        return redirect()->route('students.index')->with('message', 'Student Successfully Deleted!');
    }
}
