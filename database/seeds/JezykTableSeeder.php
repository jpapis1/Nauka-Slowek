<?php

use Illuminate\Database\Seeder;

class JezykTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jezyk')->insert([

            'nazwa' => 'polski',
        ]);
        DB::table('jezyk')->insert([

            'nazwa' => 'angielski',
        ]);
        DB::table('jezyk')->insert([

            'nazwa' => 'niemiecki',
        ]);
        DB::table('jezyk')->insert([

            'nazwa' => 'hiszpański',
        ]);
        DB::table('jezyk')->insert([

            'nazwa' => 'francuski',
        ]);
    }
}
