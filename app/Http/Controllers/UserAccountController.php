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
            'username' => 'required|string|unique:user_accounts,username|min:4',
        ], [
            'username.required' => 'Username is required',
            'username.unique' => 'This username is already taken',
            'username.min' => 'Username must be at least 4 characters',
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
            'username' => 'required|string|unique:user_accounts,username|min:4',
        ], [
            'username.required' => 'A username is required',
            'username.unique' => 'This username is already taken',
            'username.min' => 'Username must be at least 4 characters'
        ]);

        // Use fixed default password "changepass123"
        $defaultPassword = "changepass123";

        // Create the user with a hashed password
        UserAccount::create([
            'username' => $request->username,
            'password' => Hash::make($defaultPassword),
            'defaultpassword' => true,
        ]);

        return redirect()->route('admin.users')
            ->with('success', "User {$request->username} created with default password: {$defaultPassword}");
    }

    /**
     * Show all user accounts (admin only)
     */
    public function index()
    {
        $users = UserAccount::all();
        return view('user_accounts.index', compact('users'));
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
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
                ->with('error', 'No account found with this username')
                ->withInput($request->except('password'));
        }

        if (!Hash::check($request->password, $user->password)) {
            Log::info("Login failed: Invalid password for user - " . $request->username);
            return back()
                ->with('error', 'Invalid password. For student accounts, remember to use your Student ID followed by a hyphen and your first name (e.g., S-24-1-John)')
                ->withInput($request->except('password'));
        }

        // Store username and last activity timestamp in session
        session([
            'username' => $user->username,
            'last_activity' => Carbon::now()
        ]);

        // Update last login timestamp
        $user->update([
            'last_login' => Carbon::now()
        ]);

        Log::info("Login successful for user: " . $user->username);

        // If user has default password, redirect to update password page
        if ($user->defaultpassword) {
            return redirect()->route('password.update')
                ->with('warning', 'You must update your default password before proceeding');
        }

        return redirect()->route('dashboard')
            ->with('success', 'Login successful! Welcome back.');
    }

    /**
     * Show password update form
     */
    public function showUpdatePasswordForm()
    {
        // Ensure session is valid
        if (!session()->has('username')) {
            return redirect()->route('login')
                ->with('error', 'Your session has expired. Please log in again.');
        }
        
        // Get the user to check if they have a default password
        $username = session('username');
        $user = UserAccount::where('username', $username)->first();
        
        $isDefaultPassword = $user->defaultpassword;
        
        // Check if this is a student account by looking up the email in students table
        $student = Student::where('email', $username)->first();
        $userRole = $student ? 'student' : 'user';
        
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
        // Clear all session data
        session()->flush();
        
        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully');
    }
}
