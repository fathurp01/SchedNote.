<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'title',
        'event_date',
        'event_time',
        'user_id',
        'description',
        'priority',
        'reminder',
        'due_date',
    ];

    // Definisikan relasi tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'schedule_tags', 'schedule_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function elements()
    {
        return $this->hasMany(ScheduleElement::class);
    }
}
