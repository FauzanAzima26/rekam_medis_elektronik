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
        Schema::create('template_resep_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('template_resep_id')
                ->constrained('template_reseps')
                ->cascadeOnDelete();

            $table->string('nama_obat', 150);
            $table->string('aturan_pakai', 255);
            $table->unsignedInteger('jumlah')->nullable();
            $table->text('catatan')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_resep_details');
    }
};
