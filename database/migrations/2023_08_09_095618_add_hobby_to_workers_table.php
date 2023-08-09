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
        Schema::table('workers', function (Blueprint $table) {
            $table->string('hobby', 255)->nullable()->after('position_id');

            // FK и IDx
            // $table->foreignId('some_id')->index()->nullable()->constrained('positions');

            // Уникальность колонок
            // $table->unique(['users_email_unique', 'users_slag_unique']);

            // Переименовать колонку
            // $table->renameColumn('age', 'age_worker');

            // Сделать колонку необязательной
            // $table->string('name', 200)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workers', function (Blueprint $table) {
            // Откатываем в обратном порядке
            // Сделать колонку необязательной
            // $table->string('name', 100)->nullable(false)->change();

            // Переименовать колонку
            // $table->renameColumn('age_worker', 'age');

            // Удаляем уникальность колонок
            // $table->dropUnique(['users_email_unique', 'users_slag_unique']);

            // FK и IDx
            //$table->dropIndex(['some_id']);
            // $table->dropForeign(['some_id'])->nullable(false);

            $table->dropColumn(['hobby',]);
        });
    }
};
