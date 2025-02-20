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
        Schema::create('cerita_kamis', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->date('tanggal')->nullable();
            $table->text('cerita')->nullable();
            $table->text('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cerita_kamis');
    }
};
