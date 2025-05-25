<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    // Display message passed in the route
    public function showMessage($message)
    {
        return $message;
    }

    // Redirect to another action
    public function showSomething($message)
    {
        return "something";
    }

    // Handle the index function
    public function index()
    {
        return "This is an index function of RedirectController";
    }
}

