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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->text('city')->nullable();
            $table->text('skill')->nullable();
            $table->integer('experience')->nullable();
            $table->date('finished_study_at')->nullable();

            // FK
            $table->foreignId('worker_id')->nullable()->constrained('workers')->cascadeOnUpdate()->nullOnDelete();

            // IDx
            $table->index('worker_id');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
