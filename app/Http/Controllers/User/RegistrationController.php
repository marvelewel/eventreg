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

        if ($event->price == 0) {
            // Success: Create Registration
            Registration::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'status' => 'pending',
            ]);
            return redirect()->route('user.dashboard')->with('success', 'Berhasil mendaftar! Silakan pantau status pendaftaran Anda.');
        }

        return redirect()->route('user.events.payment', $event->id);
    }

    public function payment(Event $event)
    {
        if ($event->price == 0) {
            return redirect()->route('user.dashboard')->with('error', 'Event ini gratis, tidak perlu pembayaran.');
        }

        $alreadyRegistered = Registration::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->whereIn('status', ['pending', 'accepted'])
            ->exists();

        if ($alreadyRegistered) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar di event ini.');
        }

        return view('user.payment', compact('event'));
    }

    public function uploadProof(Request $request, Event $event)
    {
        $request->validate([
            'payment_proof' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $registeredCount = $event->registrations()->whereIn('status', ['pending', 'accepted'])->count();
        if ($registeredCount >= $event->quota) {
            return redirect()->route('user.dashboard')->with('error', 'Mohon maaf, kuota event ini sudah penuh.');
        }

        $path = $request->file('payment_proof')->store('payments', 'public');

        Registration::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'status' => 'pending',
            'payment_proof' => $path
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.');
    }
}
