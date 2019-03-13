# Nauka Słówek
Autor: Jacek Papis

Aplikacja umożliwia naukę i sprawdzanie znajomości słówek (zdań) z języka obcego. Można tworzyć zarówno zestawy prywatne (widoczne tylko dla użytkownika tworzącego zestaw i administratora) oraz zestawy publiczne (administrator musi nadać użytkownikowi rolę super redaktora oraz uprawnienie do tworzenia zestawów publicznych w danej podkategorii).

Stworzona za pomocą Frameworka PHP - Laravel.

## Opis aplikacji
### Uprawnienia kont
* Administrator:
Może nadawać uprawnienia super redaktorom do tworzenia publicznych zestawów słówek w danej podkategorii.
Może tworzyć/edytować/usuwać/ukrywać kategorie i podkategorie. Może tworzyć nowe zestawy słówek i edytować/usuwać/ukrywać zestawy słówek niezależnie od tego, kto jest ich autorem. Może przydzielać uprawnienia redaktora lub super redaktora użytkownikom zarejestrowanym. Może zarządzać kontami użytkowników.

* SuperRedaktor:
To co redaktor + Może edytować wszystkie zestawy słówek z podkategorii (jednej lub kilku), do której otrzymał uprawnienia od administratora serwisu.

* Redaktor:
To co standardowy + Może dodawać zestawy słówek do podkategorii (jednej lub kilku), do której otrzymał uprawnienia od administratora serwisu oraz edytować i usuwać zestawy słówek, które utworzył.

* Standardowy:
Procentowe wyniki sprawdzenie wiedzy ze znajomości danego zestawu powinny być zapisywane w bazie danych. Użytkownik zarejestrowany powinien mieć możliwość graficznej reprezentacji zapisanych wyników (graficzna reprezentacja postępów nauki). Może tworzyć prywatne zestawy słówek i je używać jak każdy inny zestaw.

### Tryby
* Tryb nauki: 
Nie zapisuje wyników do bazy danych.
Zawiera 3 algorytmy:
  - Mieszanie pytań/słówek, pytaj się dokładnie 1 raz
  - Mieszanie pytań/słówek, pytaj się do poprawnej odpowiedzi
  - Sortuj alfabetycznie, pytaj się dokładnie 1 raz
* Tryb sprawdzania wiedzy:
Zapisuje wyniki do bazy danych (dostępne statystyki, wykresy)
Zawiera 1 algorytm:
  - Mieszanie pytań/słówek, pytaj się dokładnie 1 raz

## Przykład deploymentu aplikacji

Po odpowiedniej konfiguracji Heroku (dodanie aplikacji, powiązanie z nią bazy danych) dokonujemy migracji, uruchomienia seedów, pozyskania i przypisania APP_KEY do konfiguracji aplikacji:
``` bash
heroku run php /app/artisan migrate:refresh --seed -app [nazwa aplikacji]
heroku run php /app/artisan --no-ansi key:generate --show -a [nazwa aplikacji]
heroku config:set APP_KEY=[tutaj wpisać APP_KEY wygenerowany z poprzedniego polecenia]
```
## Link do aplikacji
https://nauka-slowek.herokuapp.com/


