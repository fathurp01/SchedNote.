<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Schedule;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display the dashboard with notes and schedules.
     */
    public function dashboard()
    {
        $userId = Auth::id();
        
        // Get total counts for the authenticated user
        $totalNotes = Note::where('user_id', $userId)->count();
        $totalSchedules = Schedule::where('user_id', $userId)->count();
        $totalTags = Tag::whereHas('notes', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        // Get recent notes and schedules
        $notes = Note::where('user_id', $userId)
            ->latest()
            ->take(1)
            ->get();
            
        $schedules = Schedule::where('user_id', $userId)
            ->orderBy('event_date', 'asc')
            ->orderBy('event_time', 'asc')
            ->limit(5)
            ->get();

        return view('layouts.app', compact(
            'notes', 
            'schedules', 
            'totalNotes', 
            'totalSchedules', 
            'totalTags'
        ));
    }
}