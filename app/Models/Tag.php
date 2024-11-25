<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['tag_name'];

    public function notes()
    {
        return $this->belongsToMany(Note::class, 'note_tag');
    }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'schedule_tags', 'tag_id', 'schedule_id');
    }
}
