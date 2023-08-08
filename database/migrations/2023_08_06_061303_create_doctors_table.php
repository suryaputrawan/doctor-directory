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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('specialist_id')->constrained('specialists')->cascadeOnDelete();
            $table->foreignId('sub_specialist_id')->nullable()->constrained('sub_specialists')
                ->cascadeOnDelete();
            $table->string('keterangan');
            $table->string('notes')->nullable();
            $table->text('picture')->nullable();
            $table->foreignId('site_id')->constrained('sites')->cascadeOnDelete();
            $table->tinyInteger('isAktif')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
