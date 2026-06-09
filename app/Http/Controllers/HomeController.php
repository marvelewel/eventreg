<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch the 3 latest events for the Home page
        $latestEvents = Event::latest()->take(3)->get();
        return view('home', compact('latestEvents'));
    }
}
