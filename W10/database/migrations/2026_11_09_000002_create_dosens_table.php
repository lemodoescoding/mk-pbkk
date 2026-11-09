<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('departemen');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('nama');
            $table->index('departemen');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
