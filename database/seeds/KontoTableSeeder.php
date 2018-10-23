<?php

use Illuminate\Database\Seeder;

class KontoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('konto')->insert([

            'rola_id' => '1',
            'imie' => 'Jacek',
            'nazwisko' => 'Papis',
            'email' => 'admin@edarkt.pl',
            'login' => 'admin',
            'haslo' => password_hash('tajneAdmin',PASSWORD_BCRYPT)
        ]);
        DB::table('konto')->insert([

            'rola_id' => '2',
            'imie' => 'Stanisław',
            'nazwisko' => 'Wielowiejski',
            'email' => 'stanislaw.wielowiejski@edarkt.pl',
            'login' => 'superRedaktor',
            'haslo' => password_hash('tajneSuperRedaktor',PASSWORD_BCRYPT)
        ]);
        DB::table('konto')->insert([

            'rola_id' => '3',
            'imie' => 'Jerzy',
            'nazwisko' => 'Nowak',
            'email' => 'jerzy@edarkt.pl',
            'login' => 'redaktor',
            'haslo' => password_hash('tajneRedaktor',PASSWORD_BCRYPT)
        ]);
        DB::table('konto')->insert([

            'rola_id' => '4',
            'imie' => 'Adam',
            'nazwisko' => 'Pędziwiatr',
            'email' => 'janusz.ped@edarkt.pl',
            'login' => 'standardowy',
            'haslo' => password_hash('tajneStandardowe',PASSWORD_BCRYPT)
        ]);
    }
}
