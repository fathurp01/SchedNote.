<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ScheduleController extends Controller
{
    use AuthorizesRequests;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Hapus $this->middleware('auth');
        // Pindahkan ke routes/web.php
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with('tags')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(7);
        return view('schedules.index', compact('schedules'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = \App\Models\Tag::all();
        return view('schedules.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'description' => 'nullable|string',
            'tags' => 'nullable|array',
        ]);

        $schedule = Schedule::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'description' => $request->description,
        ]);

        if ($request->has('tags')) {
            $schedule->tags()->attach($request->tags);
        }

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        $this->authorize('view', $schedule);
        return view('schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $this->authorize('update', $schedule);
        $tags = \App\Models\Tag::all();
        return view('schedules.edit', compact('schedule', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'title' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'description' => 'nullable',
            'tags' => 'nullable|array',
        ]);

        $schedule->update($validated);
        $schedule->tags()->sync($request->tags ?? []);

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $this->authorize('delete', $schedule);
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}