<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DepartmentSeeder::class);
        $this->command->info('Таблица отделов загружена данными!');

        $this->call(PositionSeeder::class);
        $this->command->info('Таблица должностей загружена данными!');

        $this->call([
            WorkerSeeder::class,
            ProfileSeeder::class
        ]);
        $this->command->info('Таблицы работников и их профили загружены данными!');

        $this->call(TagSeeder::class);
        $this->command->info('Таблица тегов загружена данными!');


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
