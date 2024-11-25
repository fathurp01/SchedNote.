<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleElement extends Model
{
    use HasFactory;

    protected $table = 'schedule_elements';

    protected $fillable = [
        'schedule_id', // Relasi ke Schedule
        'element_type',
        'element_content'
    ];

    /**
     * Get the schedule that owns the element.
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
