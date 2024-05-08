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
        Schema::create('modul_cooperatives', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('modul_id');
            $table->foreign('modul_id')->references('id')->on('modul');
            $table->unsignedBigInteger('koperasi_id')->nullable();
            $table->foreign('koperasi_id')->references('id')->on('cooperative_centers');
            $table->unsignedBigInteger('c_koperasi_id')->nullable();
            $table->foreign('c_koperasi_id')->references('id')->on('cooperative_branches');
            $table->enum('status', ['hidden', 'unhidden'])->default('unhidden');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modul_cooperatives');
    }
};
