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
        Schema::create('project_worker', function (Blueprint $table) {
            $table->id();

            // FK
            $table->foreignId('project_id')->nullable()->constrained('projects')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('worker_id')->nullable()->constrained('workers')->cascadeOnUpdate()->nullOnDelete();

            // IDx
            $table->index('project_id');
            $table->index('worker_id');

            // Уникальность связок ключей
            $table->unique(['project_id', 'worker_id']);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_workers');
    }
};
