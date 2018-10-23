<?php

use Illuminate\Database\Seeder;

class ZestawTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zestaw')->insert([

            'konto_id' => '2',
            'jezyk1_id' => '1',
            'jezyk2_id' => '2',
            'podkategoria_id' => '6',
            'nazwa' => 'Konstrukcje w językach programowania',
'zestaw' => 'przełącznik;switch
jeżeli;if
dopóki;while
enumeracja;enumeration
wybierz;select
struktura;struct
klasa;class
metoda;method
funkcja;function
interfejs;interface'
            ,
            'ilosc_slowek' => 10,
            'data_edycji' => '2018-04-19',
            'private' => 'false'
        ]);
        DB::table('zestaw')->insert([

            'konto_id' => '1',
            'jezyk1_id' => '1',
            'jezyk2_id' => '2',
            'podkategoria_id' => '6',
            'nazwa' => 'Typy danych',
            'zestaw' => 'liczba całkowita;integer
liczba zmiennoprzecinkowa;decimal
data;date'
            ,
            'ilosc_slowek' => 3,
            'data_edycji' => '2018-04-19',
            'private' => 'false'
        ]);
    }
}
