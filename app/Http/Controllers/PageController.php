<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Handle contact form submission.
     */
    public function store(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // ✅ Process the data (e.g., save to DB, send mail, etc.)
        return back()->with('success', 'Your message has been sent!');
    }

    /**
     * Show grade calculation and student list.
     */
    public function showGradeAndStudents(Request $request)
    {
        $students = [
            ['name' => 'John Doe', 'age' => 20, 'color' => 'blue'],
            ['name' => 'Jane Smith', 'age' => 21, 'color' => 'red'],
            ['name' => 'Alice Brown', 'age' => 19, 'color' => 'green'],
        ];

        $score = $request->query('score');

        return view('controlstructure', compact('students', 'score'));
    }

    /**
     * Show the maintenance page.
     */
    public function maintenance()
    {
        return view('maintenance');
    }

    /**
     * Show the contact form.
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Show grade calculation and star pattern based on grade.
     */
    public function conditional($grade = null, $rows = 10)
    {
        return view('conditional', compact('grade', 'rows'));
    }
}
