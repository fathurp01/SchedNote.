<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Mengaitkan dengan pengguna yang ada
            'title' => $this->faker->sentence, // Judul jadwal
            'description' => $this->faker->paragraph, // Deskripsi jadwal, opsional
            'event_date' => $this->faker->dateTimeBetween('now', '+1 month'), // Tanggal acara
            'event_time' => $this->faker->time, // Waktu acara, opsional
            'due_date' => $this->faker->dateTimeBetween('now', '+2 months'), // Tanggal jatuh tempo, opsional
            'priority' => $this->faker->randomElement(['Low', 'Medium', 'High']), // Prioritas
            'reminder' => $this->faker->boolean, // Pengingat
        ];
    }
}

