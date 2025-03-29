## Projekt zaliczeniowy z laboratorium "Programowanie aplikacji internetowych"

## Tematyka projektu: Aplikacja internetowa do obsługi salonu barberskiego

## Autor: Hubert Jędruchniewicz

## Funkcjonalności:

Użytkownik niezalogowany:
- rejestracja konta klienta
- logowanie (Klient, Barber, Administrator)

Użytkownik zalogowany:
- edytowanie danych osobowych
- usunięcie konta

Klient:
- umawianie wizyt (automatyczne aktualizowanie dostępnych godzin dla danego barbera)
- edytowanie szczegółów wizyt*
- anulowanie wizyt*
- przeglądanie wizyt nadchodzących i zakończonych
- automatyczne aktualizacje statusów wizyt ("Oczekuje na potwierdzenie", "Potwierdzona", "W trakcie", "Zakończona", "Anulowana", "Odrzucona przez barbera")

* Dostępne jeżeli do wizyty pozostało więcej niż 30 minut

Barber:
- przeglądanie wizyt do akceptacji, nadchodzących i zakończonych
- filtrowanie nadchodzących wizyt ("Wszystkie", "Dziś", "Tydzień")
- akceptowanie, odrzucanie wizyt
- anulowanie wizyt**
- automatyczne aktualizacje statusów wizyt ("Oczekuje na potwierdzenie", "Potwierdzona", "W trakcie", "Zakończona", "Anulowana", "Odrzucona przez barbera")

** Dostępne aż do momentu zakończenia wizyty (np. w przypadku gdyby klient nie przyszedł)

Administrator:

- zarządzanie użytkownikami aplikacji (dodawanie, edytowanie, usuwanie)***
- zarządzanie wizytami użytkowników (edytowanie szczegółów, usuwanie)
- filtrowanie użytkowników i wizyt
- sortowanie użytkowników i wizyt

*** Administrator może również dodawać nowych barberów i administratorów (możliwość umawiania wizyt u nowo dodanego barbera zostanie automatycznie dodana)

## Narzędzia i technologie
- strona serwera: PHP, JavaScript
- baza danych: MySQL
- strona klienta: Bootstrap, AOS

## Wymagania

Wersje programów wykorzystane do tworzenia aplikacji (aplikacja nie została przetestowana z kompatybilnością wcześniejszych wersji):
- XAMPP v3.3.0 (MySQL Database, APACHE Web Server)
- PHP 8.2.12
- Bootstrap 5.0

## Uruchomienie
1. Folder projektowy `peppers` należy umieścić w `XAMPP\htdocs`
2. W panelu XAMPP włączyć MySQL Database oraz Apache Web Server
3. W przeglądarce pod adresem `localhost/phpmyadmin/` zaimportować bazę danych `peppers_database.sql`
4. Uruchomić aplikację w przeglądarce pod adresem: `localhost/peppers/index.php`

## Konta testowe

Klient:
	-login: klient1
	-hasło: klient123

Barber:
	-login: barber1
	-hasło: barber1

Administrator:
	-login: admin1
	-hasło: admin123 zrób ten plik readme bardziej profesjonalny
