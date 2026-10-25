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
        Schema::create('reseps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('pemeriksaan_id')
                ->unique()
                ->constrained('pemeriksaans')
                ->restrictOnDelete();

            $table->foreignUuid('dokter_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignUuid('template_resep_id')
                ->nullable()
                ->constrained('template_reseps')
                ->nullOnDelete();

            $table->dateTime('tanggal_resep');
            $table->json('daftar_obat');
            $table->string('status', 20)->default('draft');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseps');
    }
};
