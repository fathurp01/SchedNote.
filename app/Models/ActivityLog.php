<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id', // Relasi ke User
        'activity_type',
        'activity_target',
        'target_id',
        'activity_time',
    ];

    /**
     * Get the user that owns the activity log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
