# Nauka Słówek
Autor: Jacek Papis

Aplikacja umożliwia naukę i sprawdzanie znajomości słówek (zdań) z języka obcego. 

Stworzona za pomocą Frameworka PHP - Laravel.

## Opis aplikacji
### Uprawnienia kont
* Administrator:
Może tworzyć/edytować/usuwać/ukrywać kategorie i podkategorie. Może tworzyć nowe zestawy słówek i edytować/usuwać/ukrywać zestawy słówek niezależnie od tego, kto jest ich autorem. Może przydzielać uprawnienia redaktora lub super redaktora użytkownikom zarejestrowanym. Może zarządzać kontami użytkowników.

* SuperRedaktor:
To co redaktor + Może edytować wszystkie zestawy słówek z podkategorii (jednej lub kilku), do której otrzymał uprawnienia od administratora serwisu.

* Redaktor:
To co standardowy + Może dodawać zestawy słówek do podkategorii (jednej lub kilku), do której otrzymał uprawnienia od administratora serwisu oraz edytować i usuwać zestawy słówek, które utworzył.

* Standardowy:
Procentowe wyniki sprawdzenie wiedzy ze znajomości danego zestawu powinny być zapisywane w bazie danych. Użytkownik zarejestrowany powinien mieć możliwość graficznej reprezentacji zapisanych wyników (graficzna reprezentacja postępów nauki). Może tworzyć prywatne zestawy słówek i je używać jak każdy inny zestaw.

## Przykład deploymentu aplikacji

Po odpowiedniej konfiguracji Heroku (dodanie aplikacji, powiązanie z nią bazy danych) dokonujemy migracji, uruchomienia seedów, pozyskania i przypisania APP_KEY do konfiguracji aplikacji:
``` bash
heroku run php /app/artisan migrate:refresh --seed -app [nazwa aplikacji]
heroku run php /app/artisan --no-ansi key:generate --show -a [nazwa aplikacji]
heroku config:set APP_KEY=[tutaj wpisać APP_KEY wygenerowany z poprzedniego polecenia]
```
## Link do aplikacji
https://nauka-slowek.herokuapp.com/


