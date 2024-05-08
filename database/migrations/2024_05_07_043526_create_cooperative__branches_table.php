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
        Schema::create('cooperative_branches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('coop_name');
            $table->unsignedBigInteger('koperasi_id');
            $table->foreign('koperasi_id')->references('id')->on('cooperative_centers');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooperative_branches');
    }
};
