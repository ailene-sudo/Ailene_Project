<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserAccountController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegisterForm()
    {
        return view('user_accounts.register');
    }

    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:user_accounts,username|min:4|max:50',
        ], [
            'username.required' => 'Username is required',
            'username.unique' => 'This username is already taken',
            'username.min' => 'Username must be at least 4 characters',
            'username.max' => 'Username cannot exceed 50 characters',
        ]);

        // Default password
        $defaultPassword = "changepass123";

        // Create the user with a hashed password
        UserAccount::create([
            'username' => $request->username,
            'password' => Hash::make($defaultPassword),
            'defaultpassword' => true, // Mark as default password
        ]);

        // Auto-login after registration
        session([
            'username' => $request->username,
            'last_activity' => Carbon::now()
        ]);

        // Redirect to password update page since user has default password
        return redirect()->route('password.update')
            ->with('warning', 'Your account has been created with a default password. Please update your password now to continue.');
    }

    /**
     * Show the form to create a new user account
     */
    public function create()
    {
        return view('user_accounts.create');
    }

    /**
     * Store a new user account
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:user_accounts,username|min:4|max:50',
            'fname' => 'required|string',
            'lname' => 'required|string',
        ], [
            'username.required' => 'A username is required',
            'username.unique' => 'This username is already taken',
            'username.min' => 'Username must be at least 4 characters',
            'username.max' => 'Username cannot exceed 50 characters',
            'fname.required' => 'First name is required',
            'lname.required' => 'Last name is required',
        ]);

        // Use fixed default password "changepass123"
        $defaultPassword = "changepass123";

        // Generate a student ID (S-YY-sequence)
        $year = date('y'); // Current year (2 digits)
        $latestStudent = Student::where('studentid', 'like', "S-{$year}-%")
            ->orderBy('id', 'desc')
            ->first();
            
        $sequence = 1;
        if ($latestStudent) {
            $parts = explode('-', $latestStudent->studentid);
            if (count($parts) == 3) {
                $sequence = intval($parts[2]) + 1;
            }
        }
        
        $studentId = "S-{$year}-{$sequence}";
        
        // Create the user with a hashed password
        UserAccount::create([
            'username' => $request->username,
            'password' => Hash::make($defaultPassword),
            'defaultpassword' => true,
            'user_account_id' => $studentId
        ]);
        
        // Create a corresponding student record
        Student::create([
            'studentid' => $studentId,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->username, // Use username as email
            'address' => 'Not provided', // Default address
            'contactno' => 'Not provided', // Default contact number
            'mname' => '', // Empty middle name
        ]);

        return redirect()->route('admin.users')
            ->with('success', "User {$request->username} created with default password: {$defaultPassword} and added to student list with ID: {$studentId}");
    }

    /**
     * Show all user accounts (admin only)
     */
    public function index()
    {
        $users = UserAccount::paginate(10); // Show 10 users per page
        return view('user_accounts.index', compact('users'));
    }
    
    /**
     * Show form to edit a user account
     */
    public function edit($id)
    {
        $user = UserAccount::findOrFail($id);
        $student = Student::where('email', $user->username)->first();
        return view('user_accounts.edit', compact('user', 'student'));
    }
    
    /**
     * Update a user account
     */
    public function update(Request $request, $id)
    {
        $user = UserAccount::findOrFail($id);
        
        $request->validate([
            'username' => 'required|string|min:4|max:50|unique:user_accounts,username,'.$id,
            'fname' => 'required|string',
            'lname' => 'required|string',
        ]);
        
        // Update user account
        $user->username = $request->username;
        $user->save();
        
        // Update associated student record
        $student = Student::where('email', $user->username)->first();
        if ($student) {
            $student->fname = $request->fname;
            $student->lname = $request->lname;
            $student->email = $request->username;
            $student->save();
            
            // Update user_account_id to match studentid
            $user->user_account_id = $student->studentid;
            $user->save();
        }
        
        return redirect()->route('admin.users')
            ->with('success', 'User account updated successfully');
    }
    
    /**
     * Delete a user account
     */
    public function destroy($id)
    {
        $user = UserAccount::findOrFail($id);
        $username = $user->username;
        
        // Delete associated student record
        $student = Student::where('email', $user->username)->first();
        if ($student) {
            $student->delete();
        }
        
        // Delete user account
        $user->delete();
        
        return redirect()->route('admin.users')
            ->with('success', "User account '{$username}' has been deleted");
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        if (session()->has('username')) {
            return redirect()->route('dashboard');
        }
        return view('user_accounts.login');
    }

    /**
     * Authenticate user
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username is required',
            'password.required' => 'Password is required'
        ]);

        $user = UserAccount::where('username', $request->username)->first();

        // Log authentication attempt
        Log::info("Login attempt for username: " . $request->username);

        if (!$user) {
            Log::info("Login failed: User not found - " . $request->username);
            return back()
                ->withInput()
                ->withErrors(['username' => 'Invalid username or password']);
        }

        if (!Hash::check($request->password, $user->password)) {
            Log::info("Login failed: Invalid password for user - " . $request->username);
            return back()
                ->withInput()
                ->withErrors(['password' => 'Invalid username or password']);
        }

        // Update last login timestamp
        try {
            $user->last_login = Carbon::now();
            $user->save();
        } catch (\Exception $e) {
            Log::error("Error updating last login time: " . $e->getMessage());
            // Continue with login even if updating timestamp fails
        }

        // Set session
        session([
            'username' => $user->username,
            'last_activity' => Carbon::now()
        ]);

        Log::info("Login successful for user: " . $request->username);

        // If user has default password, redirect to password update page
        if ($user->defaultpassword) {
            return redirect()->route('password.update')
                ->with('warning', 'Please update your password to continue.');
        }

        return redirect()->route('dashboard');
    }

    /**
     * Show password update form
     */
    public function showUpdatePasswordForm()
    {
        if (!session()->has('username')) {
            return redirect()->route('login');
        }

        $username = session('username');
        $user = UserAccount::where('username', $username)->first();
        
        if (!$user) {
            session()->flush();
            return redirect()->route('login');
        }

        $isDefaultPassword = $user->defaultpassword;
        $userRole = $user->role;
        
        // Get associated student record if it exists
        $student = Student::where('email', $username)->first();
        
        // Set the default password based on user role
        $defaultPassword = null;
        if ($isDefaultPassword) {
            if ($userRole === 'student') {
                $defaultPassword = $student->studentid . '-' . $student->fname;
            } else {
                $defaultPassword = 'changepass123';
            }
        }
        
        return view('user_accounts.update_password', compact('isDefaultPassword', 'userRole', 'defaultPassword'));
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        $username = session('username');
        $user = UserAccount::where('username', $username)->first();
        
        // Check if this is a student account
        $student = Student::where('email', $username)->first();
        $isStudent = !is_null($student);
        
        // Validate the request
        $request->validate([
            'current_password' => 'required|string',
            'password' => ['required', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
        ], [
            'current_password.required' => 'Current password is required',
            'password.required' => 'New password is required',
            'password.confirmed' => 'Password confirmation does not match'
        ]);

        // If this is a default password, check the appropriate format
        if ($user->defaultpassword) {
            if ($isStudent) {
                // For students, check if current password matches StudentID-FirstName format
                $expectedPassword = $student->studentid . '-' . $student->fname;
                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->with('error', 'Current password is incorrect. For student accounts, your default password is your Student ID followed by a hyphen and your first name (e.g., S-24-1-John)');
                }
            } else {
                // For regular users, check if current password is "changepass123"
                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->with('error', 'Current password is incorrect. For new users, the default password is "changepass123"');
                }
            }
        } else {
            // For non-default passwords, just check if the current password matches
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Current password is incorrect');
            }
        }

        // Update the password
        $user->update([
            'password' => Hash::make($request->password),
            'defaultpassword' => false,
        ]);

        // Update last activity timestamp
        session(['last_activity' => Carbon::now()]);

        return redirect()->route('dashboard')
            ->with('success', 'Password updated successfully');
    }

    /**
     * Show dashboard
     */
    public function dashboard()
    {
        $username = session('username');
        return view('user_accounts.dashboard', compact('username'));
    }

    /**
     * Logout user
     */
    public function logout()
    {
        $username = session('username');
        session()->flush();
        Log::info("User logged out: " . $username);
        return redirect()->route('login');
    }
}
