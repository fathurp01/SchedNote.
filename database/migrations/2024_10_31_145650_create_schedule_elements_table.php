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
        Schema::create('schedule_elements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade'); // Menghubungkan dengan tabel schedules
            $table->enum('element_type', ['Location', 'Sub-task', 'Other']); // Jenis elemen, seperti 'location', 'sub-task', dll.
            $table->text('element_content'); // Nilai elemen, misalnya lokasi atau deskripsi tugas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_elements');
    }
};
