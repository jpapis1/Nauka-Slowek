<?php

use Illuminate\Database\Seeder;

class KategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoria')->insert([

            'nazwa' => 'Zwierzęta',
            'opis' => 'Obejmuje zagadnienia techniczne.',
        ]);
        DB::table('kategoria')->insert([

            'nazwa' => 'Literatura',
            'opis' => 'Obejmuje zagadnienia literatury, języka.',
        ]);
        DB::table('kategoria')->insert([

            'nazwa' => 'Informatyka',
            'opis' => 'Obejmuje zagadnienia informatyczne, szczególnie przydatne przy czytaniu dokumentacji.',
        ]);
    }
}
