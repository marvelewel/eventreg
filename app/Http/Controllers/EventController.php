<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // Fetch events with optional search filter and pagination (9 per page)
        $events = Event::when($request->search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%");
        })->latest()->paginate(9)->withQueryString();

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        // Count active registrations (pending or accepted) to show current participants
        $registeredCount = $event->registrations()->whereIn('status', ['pending', 'accepted'])->count();

        // Check if current logged-in user is already registered
        $isRegistered = false;
        if (auth()->check()) {
            $isRegistered = $event->registrations()
                ->where('user_id', auth()->id())
                ->whereIn('status', ['pending', 'accepted'])
                ->exists();
        }

        return view('events.show', compact('event', 'registeredCount', 'isRegistered'));
    }
}
