<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', static function (Blueprint $table) {
            $table->id();

            $table->string('title', 255);
            $table->text('content');

            $table->timestamps();

            // Отношение один ко многим полиморф (One To Many (Polymorphic))
            $table->unsignedBigInteger('reviewable_id');
            $table->string('reviewable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
