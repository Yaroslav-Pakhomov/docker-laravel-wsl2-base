<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('avatars', static function (Blueprint $table) {
            $table->id();

            $table->string('path');

            $table->timestamps();

            // Отношение один к одному полиморф (One To One (Polymorphic))
            $table->unsignedBigInteger('avatarable_id');
            $table->string('avatarable_type');

            // Уникальность связки
            $table->unique(['avatarable_id', 'avatarable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avatars');
    }
};
