# Nauka Słówek
Autor: Jacek Papis

Aplikacja umożliwia naukę i sprawdzanie znajomości słówek (zdań) z języka obcego. 

Stworzona za pomocą Frameworka PHP - Laravel.

## Przykład deploymentu aplikacji

Po odpowiedniej konfiguracji Heroku (dodanie aplikacji, powiązanie z nią bazy danych) dokonujemy migracji, uruchomienia seedów, pozyskania i przypisania APP_KEY do konfiguracji aplikacji:
``` bash
heroku run php /app/artisan migrate:refresh --seed -app [nazwa aplikacji]
heroku run php /app/artisan --no-ansi key:generate --show -a [nazwa aplikacji]
heroku config:set APP_KEY=[tutaj wpisać APP_KEY wygenerowany z poprzedniego polecenia]
```
## Link do aplikacji
https://nauka-slowek.herokuapp.com/


