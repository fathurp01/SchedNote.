<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount(['notes', 'schedules'])
            ->orderByRaw('(notes_count + schedules_count) DESC')
            ->paginate(7);
        
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tag_name' => 'required|string|max:50|unique:tags'
        ]);

        Tag::create([
            'tag_name' => $request->tag_name
        ]);

        return redirect()->route('tags.index')
            ->with('success', 'Tag berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'tag_name' => 'required|string|max:50|unique:tags,tag_name,' . $id
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update([
            'tag_name' => $request->tag_name
        ]);

        return redirect()->route('tags.index')
            ->with('success', 'Tag berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag berhasil dihapus');
    }
}
