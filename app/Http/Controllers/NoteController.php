<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NoteController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::with('tags')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(9);
        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.s
     */
    public function create()
    {
        $tags = \App\Models\Tag::all();
        return view('notes.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'tags' => 'nullable|array',
        ]);

        $note = Note::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if ($request->has('tags')) {
            $note->tags()->attach($request->tags);
        }

        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        $this->authorize('view', $note);
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        $this->authorize('update', $note);
        $tags = \App\Models\Tag::all();
        return view('notes.edit', compact('note', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'tags' => 'nullable|array',
        ]);

        $note->update($request->only('title', 'content'));

        if ($request->has('tags')) {
            $note->tags()->sync($request->tags);
        }

        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $this->authorize('delete', $note);
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
    }
}