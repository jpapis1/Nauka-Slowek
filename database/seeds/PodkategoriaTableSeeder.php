<?php

use Illuminate\Database\Seeder;

class PodkategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Zwierzęta 1
        // Literatura 2
        // Informatyka 3
        DB::table('podkategoria')->insert([

            'kategoria_id' => '1',
            'nazwa' => 'Ssaki',
            'opis' => 'Zwierzęta należące do kręgowców, stałocieplne.',
        ]);
        DB::table('podkategoria')->insert([

            'kategoria_id' => '1',
            'nazwa' => 'Gady',
            'opis' => 'Parafiletyczna grupa zmiennocieplnych owodniowców.',
        ]);
        DB::table('podkategoria')->insert([

            'kategoria_id' => '1',
            'nazwa' => 'Płazy',
            'opis' => 'Gromada zmiennocieplnych kręgowców z grupy czworonogów.',
        ]);
        DB::table('podkategoria')->insert([

            'kategoria_id' => '2',
            'nazwa' => 'Neologizmy',
            'opis' => ' Nowe wyrazy utworzone w danym języku, aby nazwać nieznany wcześniej przedmiot czy sytuację lub osiągnąć efekt artystyczny w utworze poetyckim.',
        ]);
        DB::table('podkategoria')->insert([

            'kategoria_id' => '2',
            'nazwa' => 'Archaizmy',
            'opis' => 'Wyrazy, konstrukcje składniowe lub związeki frazeologiczne, który wyszły z użycia.',
        ]);
        DB::table('podkategoria')->insert([

            'kategoria_id' => '3',
            'nazwa' => 'Przydatne słówka',
            'opis' => 'Słówka, które często można znaleść w dokumentacjach.',
        ]);
        DB::table('podkategoria')->insert([

            'kategoria_id' => '3',
            'nazwa' => 'Specjalistyczne',
            'opis' => 'Słówka specjalistyczne związane z IT.',
        ]);
        DB::table('podkategoria')->insert([

            'kategoria_id' => '3',
            'nazwa' => 'Rozmowa o pracę',
            'opis' => 'Przydatne przy rozmowie o pracę.',
        ]);
    }
}
