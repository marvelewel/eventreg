<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvents = Event::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalRegistrations = Registration::count();
        $pendingRegistrations = Registration::where('status', 'pending')->count();

        // Fetch 5 latest registrations for the table
        $recentRegistrations = Registration::with(['user', 'event'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalEvents', 'totalUsers', 'totalRegistrations', 'pendingRegistrations', 'recentRegistrations'
        ));
    }
}
