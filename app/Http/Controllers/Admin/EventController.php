<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'poster' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:available,full,finished,cancelled',
        ]);

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $validated['poster'] = $path;
        }

        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    public function show(Event $event)
    {
        return redirect()->route('admin.events.edit', $event);
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:available,full,finished,cancelled',
        ]);

        if ($request->hasFile('poster')) {
            // Delete old poster if it exists and is not an external URL
            if ($event->poster && !str_starts_with($event->poster, 'http')) {
                Storage::disk('public')->delete($event->poster);
            }
            $path = $request->file('poster')->store('posters', 'public');
            $validated['poster'] = $path;
        }

        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        if ($event->poster && !str_starts_with($event->poster, 'http')) {
            Storage::disk('public')->delete($event->poster);
        }
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus!');
    }
}
