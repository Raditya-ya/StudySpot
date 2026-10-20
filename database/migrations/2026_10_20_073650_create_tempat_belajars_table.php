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
    Schema::create('tempat_belajars', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('location');
        $table->string('distance');
        $table->string('category');
        $table->json('tags')->nullable();
        
        // Kolom Tambahan Halaman Detail
        $table->text('description')->nullable();
        $table->string('address')->nullable();
        $table->string('image_url')->nullable();
        $table->string('status_text')->default('Buka sekarang • hingga 22.00');
        $table->integer('available_seats')->default(8);
        $table->integer('total_seats')->default(15);
        $table->string('noise_level')->default('Sedang - 52 dB');
        $table->string('wifi_speed')->default('Wi-Fi cepat - ±48 Mbps');
        $table->float('rating', 2, 1)->default(4.0);
        $table->integer('total_reviews')->default(128);
        $table->json('facilities')->nullable();
        $table->text('student_note')->nullable();
        $table->string('student_note_author')->nullable();
        $table->string('best_time')->default('Sebelum 16.00');
        $table->string('price_range')->default('Rp18-35 ribu');
        $table->string('suitable_for')->default('Fokus & diskusi ringan');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempat_belajars');
    }
};
