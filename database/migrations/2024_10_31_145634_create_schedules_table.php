<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Menghubungkan dengan tabel users
            $table->string('title', 100); // Judul jadwal
            $table->text('description')->nullable(); // Deskripsi jadwal, opsional
            $table->date('event_date'); // Waktu mulai
            $table->time('event_time')->nullable(); // Waktu berakhir
            $table->date('due_date')->nullable();
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium');
            $table->boolean('reminder')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
