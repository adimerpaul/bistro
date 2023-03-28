<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            ShopSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ActivitySeeder::class,
            DocumentsectorSeeder::class,
            DocumentSeeder::class,
            EventSeeder::class,
            LeyendaSeeder::class,
            MedidaSeeder::class,
            MessageSeeder::class,
            MotivoSeeder::class,
            ServicioSeeder::class,
            TipopagoSeeder::class,
            CuiSeeder::class,
        ]);
    }
}
