<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        // Fetch registrations with related user and event data, paginated
        $registrations = Registration::with(['user', 'event'])->latest()->paginate(15);
        return view('admin.registrations.index', compact('registrations'));
    }

    public function update(Request $request, Registration $registration)
    {
        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected,pending',
        ]);

        $registration->update(['status' => $validated['status']]);

        return back()->with('success', 'Status pendaftaran atas nama ' . $registration->user->name . ' berhasil diperbarui.');
    }
}
