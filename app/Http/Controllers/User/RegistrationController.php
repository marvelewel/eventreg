<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $user = Auth::user();

        // Rule 1: Event must be 'available'
        if ($event->status !== 'available') {
            return back()->with('error', 'Pendaftaran gagal. Event ini sudah tidak tersedia.');
        }

        // Rule 2: Cannot register twice
        $alreadyRegistered = Registration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->whereIn('status', ['pending', 'accepted'])
            ->exists();

        if ($alreadyRegistered) {
            return back()->with('error', 'Anda sudah terdaftar di event ini.');
        }

        // Rule 3: Check Quota
        $registeredCount = $event->registrations()->whereIn('status', ['pending', 'accepted'])->count();
        if ($registeredCount >= $event->quota) {
            return back()->with('error', 'Mohon maaf, kuota event ini sudah penuh.');
        }

        // Success: Create Registration
        Registration::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'status' => 'pending',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Berhasil mendaftar! Silakan pantau status pendaftaran Anda.');
    }
}
