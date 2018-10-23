<?php

use Illuminate\Database\Seeder;

class RolaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rola')->insert([

            'id' => '1',
            'nazwa' => 'Administrator',
            'opis' =>'Może tworzyć/edytować/usuwać/ukrywać kategorie i podkategorie. Może tworzyć nowe zestawy słówek i edytować/usuwać/ukrywać zestawy słówek niezależnie od tego, kto jest ich autorem. Może przydzielać uprawnienia redaktora lub super redaktora użytkownikom zarejestrowanym. Może zarządzać kontami użytkowników.'
        ]);
        DB::table('rola')->insert([

            'id' => '2',
            'nazwa' => 'Super Redaktor',
            'opis' => 'To co redaktor + Może edytować wszystkie zestawy słówek z podkategorii (jednej lub kilku), do której otrzymał uprawnienia od administratora serwisu.',
        ]);
        DB::table('rola')->insert([

            'id' => '3',
            'nazwa' => 'Redaktor',
            'opis' => 'To co standardowy + Może dodawać zestawy słówek do podkategorii (jednej lub kilku), do której otrzymał uprawnienia od administratora serwisu oraz edytować i usuwać zestawy słówek, które utworzył.',
        ]);
        DB::table('rola')->insert([

            'id' => '4',
            'nazwa' => 'Standardowy',
            'opis' => 'Procentowe wyniki sprawdzenie wiedzy ze znajomości danego zestawu powinny być zapisywane w bazie danych. Użytkownik zarejestrowany powinien mieć możliwość graficznej reprezentacji zapisanych wyników (graficzna reprezentacja postępów nauki). Może tworzyć prywatne zestawy słówek i je używać jak każdy inny zestaw.',
        ]);
    }
}
