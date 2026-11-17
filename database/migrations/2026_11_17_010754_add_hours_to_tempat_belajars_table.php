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
    Schema::table('tempat_belajars', function (Blueprint $table) {
        $table->string('opening_time')->nullable()->after('status_text');
        $table->string('closing_time')->nullable()->after('opening_time');
    });
}

public function down(): void
{
    Schema::table('tempat_belajars', function (Blueprint $table) {
        $table->dropColumn(['opening_time', 'closing_time']);
    });
}
};
