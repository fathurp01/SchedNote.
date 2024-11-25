<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $fillable = [
        'title',
        'content',
        'user_id', // Relasi ke User
    ];

    /**
     * Get the user that owns the note.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The tags that belong to the note.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'note_tag');
    }

}
