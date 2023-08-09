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
        // Schema::dropIfExists('workers');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::create('workers', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name', 100);
        //     $table->string('surname', 100);
        //     $table->string('email', 100);
        //     $table->integer('age')->nullable();
        //     $table->text('description')->nullable();
        //     $table->boolean('is_married')->default(FALSE);
        //
        //     // FK
        //     $table->foreignId('position_id')->nullable()->constrained('positions')->cascadeOnUpdate()->nullOnDelete();
        //
        //     // IDx
        //     $table->index('position_id');
        //
        //     $table->timestamp('created_at')->useCurrent();
        //     $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        //
        // });

        // Либо просто ID для ссылки
        // Schema::create('workers', function (Blueprint $table) {
        //     $table->id();
        // });

    }
};
