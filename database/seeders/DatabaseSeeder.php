<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TenantSeeder;
use Database\Seeders\CentralSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Base central
        $this->call(CentralSeeder::class);

        // Tenant Seed
        $this->call(TenantSeeder::class);

    }
}
