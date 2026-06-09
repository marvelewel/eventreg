<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalRegistered = $user->registrations()->count();
        $pendingCount = $user->registrations()->where('status', 'pending')->count();
        $acceptedCount = $user->registrations()->where('status', 'accepted')->count();

        $history = $user->registrations()->with('event')->latest()->get();

        return view('user.dashboard', compact('totalRegistered', 'pendingCount', 'acceptedCount', 'history'));
    }
}
