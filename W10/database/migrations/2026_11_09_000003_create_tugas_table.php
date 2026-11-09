<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('mata_kuliah');
            $table->foreignId('dosen_id')->nullable()->constrained('dosens')->nullOnDelete();
            $table->dateTime('deadline');
            $table->string('status')->default('aktif');
            $table->timestamps();

            $table->index('judul');
            $table->index('status');
            $table->index('deadline');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
