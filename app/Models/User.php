<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the notes for the user.
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Get the schedules for the user.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get the activity logs for the user.
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    // Catatan tambahan untuk pengembangan selanjutnya
    // Pastikan untuk menggunakan hashing saat membuat pengguna baru
    // Contoh penggunaan Hash::make saat menyimpan password:

    // use Illuminate\Support\Facades\Hash;

    // @param array $data
    // @return User

    // public static function createUser(array $data)
    // {
    //     return self::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']), // Menggunakan hashing untuk password
    //     ]);
    // }
}