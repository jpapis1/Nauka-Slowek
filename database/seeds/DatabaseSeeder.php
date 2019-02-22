<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolaTableSeeder::class);
        $this->call(JezykTableSeeder::class);
        $this->call(KategoriaTableSeeder::class);
        $this->call(KontoTableSeeder::class);
        $this->call(PodkategoriaTableSeeder::class);
        $this->call(ZestawTableSeeder::class);
    }
}
