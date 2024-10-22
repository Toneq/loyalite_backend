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
        Schema::create('resources_img', function (Blueprint $table) {
            $table->id();
            $table->integer('channel_id');
            $table->string('name', 30);
            $table->integer('tier');
            $table->string('image');
            $table->string('prefix', 5)->nullable();
            $table->string('type', 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources_img');
    }
};
