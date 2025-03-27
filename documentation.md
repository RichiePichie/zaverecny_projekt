# Fitness Tracker - Dokumentace

## Obsah
1. [Úvod](#úvod)
2. [Funkce aplikace](#funkce-aplikace)
3. [Databázová struktura](#databázová-struktura)
4. [Uživatelské rozhraní](#uživatelské-rozhraní)
5. [Implementace](#implementace)
6. [Instalace](#instalace)
7. [API Reference](#api-reference)

## Úvod
Fitness Tracker je webová aplikace pro sledování cvičebních aktivit a fitness cílů uživatelů. Aplikace poskytuje intuitivní rozhraní pro zaznamenávání různých typů cvičení, nastavování osobních cílů a sledování pokroku.

### Technologie
- PHP 7.4+
- MySQL/MariaDB
- HTML5, CSS3
- JavaScript
- Font Awesome pro ikony

## Funkce aplikace

### Správa uživatelů
- Registrace nových uživatelů
- Přihlášení a odhlášení
- Správa uživatelského profilu
- Nahrávání profilových obrázků

### Sledování cvičení
- Přidávání záznamů o cvičení
- Různé typy cvičení (kardio, posilování, flexibilita, balance)
- Sledování doby trvání a spálených kalorií
- Historie cvičení s možností úprav a mazání

### Fitness cíle
- Vytváření vlastních fitness cílů
- Typy cílů: hmotnost, frekvence cvičení, trvání, vzdálenost
- Sledování pokroku směrem k cílům
- Automatická aktualizace stavu cíle po dosažení

### Statistiky
- Dashboard s přehledem aktivit
- Statistiky cvičení a spálených kalorií
- Týdenní přehled aktivity
- Zobrazení aktivních cílů

### Přizpůsobení vzhledu
- Přepínání mezi světlým a tmavým režimem
- Uložení preference tmavého režimu pomocí cookies
- Automatické obnovení preference při opětovném načtení stránky

## Databázová struktura

### Entity-Relationship Diagram

```
+------------------+       +-------------------+       +------------------+
|      Users       |       |     Exercises     |       |      Goals       |
+------------------+       +-------------------+       +------------------+
| id (PK)          |       | id (PK)           |       | id (PK)          |
| username         |       | user_id (FK)      |       | user_id (FK)     |
| email            |       | title             |       | title            |
| password         |       | description       |       | description      |
| first_name       |       | exercise_type     |       | goal_type        |
| last_name        |       | duration          |       | target_value     |
| height           |       | calories_burned   |       | current_value    |
| weight           |       | date              |       | start_date       |
| date_of_birth    |       | created_at        |       | end_date         |
| profile_image    |       | updated_at        |       | status           |
| created_at       |       +-------------------+       | created_at       |
| updated_at       |                                   | updated_at       |
+------------------+                                   +------------------+
```

### Popis tabulek

#### Tabulka: users
Ukládá informace o registrovaných uživatelích.

| Sloupec      | Typ          | Popis                             |
|--------------|--------------|-----------------------------------|
| id           | INT          | Primární klíč                     |
| username     | VARCHAR(50)  | Uživatelské jméno, unikátní       |
| email        | VARCHAR(100) | Email, unikátní                   |
| password     | VARCHAR(255) | Hashované heslo                   |
| first_name   | VARCHAR(50)  | Křestní jméno                     |
| last_name    | VARCHAR(50)  | Příjmení                          |
| height       | DECIMAL(5,2) | Výška v cm                        |
| weight       | DECIMAL(5,2) | Hmotnost v kg                     |
| date_of_birth| DATE         | Datum narození                    |
| profile_image| VARCHAR(255) | Cesta k profilovému obrázku       |
| created_at   | TIMESTAMP    | Čas vytvoření                     |
| updated_at   | TIMESTAMP    | Čas poslední aktualizace          |

#### Tabulka: exercises
Ukládá záznamy o cvičení uživatelů.

| Sloupec        | Typ           | Popis                          |
|----------------|---------------|--------------------------------|
| id             | INT           | Primární klíč                  |
| user_id        | INT           | Cizí klíč (users.id)           |
| title          | VARCHAR(100)  | Název cvičení                  |
| description    | TEXT          | Popis cvičení                  |
| exercise_type  | ENUM          | Typ cvičení (kardio, síla,...) |
| duration       | INT           | Doba trvání v minutách         |
| calories_burned| INT           | Spálené kalorie                |
| date           | DATE          | Datum cvičení                  |
| created_at     | TIMESTAMP     | Čas vytvoření                  |
| updated_at     | TIMESTAMP     | Čas poslední aktualizace       |

#### Tabulka: goals
Ukládá fitness cíle uživatelů.

| Sloupec       | Typ           | Popis                          |
|---------------|---------------|--------------------------------|
| id            | INT           | Primární klíč                  |
| user_id       | INT           | Cizí klíč (users.id)           |
| title         | VARCHAR(100)  | Název cíle                     |
| description   | TEXT          | Popis cíle                     |
| goal_type     | ENUM          | Typ cíle (hmotnost, trvání,...)|
| target_value  | DECIMAL(10,2) | Cílová hodnota                 |
| current_value | DECIMAL(10,2) | Aktuální hodnota               |
| start_date    | DATE          | Datum začátku                  |
| end_date      | DATE          | Datum konce                    |
| status        | ENUM          | Stav cíle (aktivní, splněno,...)|
| created_at    | TIMESTAMP     | Čas vytvoření                  |
| updated_at    | TIMESTAMP     | Čas poslední aktualizace       |

### Relace
- **users-exercises**: Jeden uživatel může mít mnoho cvičení (1:N)
- **users-goals**: Jeden uživatel může mít mnoho cílů (1:N)

## Uživatelské rozhraní

### Design
Aplikace používá moderní responzivní design inspirovaný trendy ve fitness aplikacích. Hlavními prvky designu jsou:

- Barevné schéma: primární fialová (#5e60ce), sekundární tyrkysová (#64dfdf), akcentová růžová (#ff5c8d)
- Moderní karty s mírným stínem a zaoblenými rohy
- Interaktivní prvky s hover efekty pro lepší použitelnost
- Ikonografie pro vizuální rozlišení typů dat
- Přehledné grafy a vizualizace pro statistiky
- Přizpůsobitelný dashboard s relevantními informacemi
- Podpora tmavého režimu pro pohodlné používání v noci nebo při nízké úrovni osvětlení

### Režimy zobrazení
Aplikace nabízí dva režimy zobrazení:

1. **Světlý režim**: Výchozí režim s bílým pozadím a tmavým textem
2. **Tmavý režim**: Alternativní režim s tmavým pozadím a světlým textem, který je šetrnější k očím v noci

Uživatel může přepínat mezi režimy pomocí přepínače v navigační liště. Preference režimu je uložena v cookies pro zachování nastavení při příštích návštěvách.

### Hlavní obrazovky
1. **Domovská stránka**: Uvítací stránka s popisem funkcí aplikace
2. **Přihlášení/Registrace**: Formuláře pro přihlášení a registraci
3. **Dashboard**: Přehled statistik a nedávných aktivit
4. **Cvičení**: Seznam všech cvičení a formulář pro přidání nového
5. **Cíle**: Seznam aktivních a dokončených cílů
6. **Profil**: Nastavení uživatelského profilu

## Implementace

### Architektura
Aplikace je založena na jednoduchém MVC (Model-View-Controller) vzoru:
- **Models**: Třídy pro práci s databází a obchodní logikou
- **Views**: PHP šablony pro zobrazení uživatelského rozhraní
- **Controllers**: Třídy pro zpracování požadavků a řízení aplikace

### Struktura souborů
```
fitness-tracker/
├── config.php                 # Konfigurace databáze
├── database.sql               # SQL skript pro vytvoření databáze
├── index.php                  # Vstupní bod aplikace
├── public/
│   ├── css/
│   │   └── styles.css         # CSS styly
│   ├── images/                # Obrázky
│   └── js/
│       └── scripts.js         # JavaScript
└── src/
    ├── controllers/
    │   ├── ExerciseController.php
    │   ├── GoalController.php
    │   └── UserController.php
    ├── models/
    │   ├── Exercise.php
    │   ├── Goal.php
    │   └── User.php
    └── views/
        ├── add_exercise.php
        ├── add_goal.php
        ├── dashboard.php
        ├── exercises.php
        ├── footer.php
        ├── goals.php
        ├── header.php
        ├── home.php
        ├── login.php
        ├── profile.php
        └── register.php
```

### Bezpečnost
- Hesla jsou hashována pomocí PHP funkce `password_hash()`
- Ochrana proti SQL injekci pomocí prepared statements
- Validace vstupních dat
- CSRF ochrana
- XSS prevence pomocí escapování výstupních dat

## Instalace

### Požadavky
- PHP 7.4 nebo vyšší
- MySQL/MariaDB
- Webový server (Apache, Nginx)

### Kroky instalace
1. Naklonujte repozitář:
   ```
   git clone https://github.com/vas-uzivatelske-jmeno/fitness-tracker.git
   ```

2. Importujte databázi:
   ```
   mysql -u username -p < database.sql
   ```

3. Nakonfigurujte připojení k databázi v souboru `config.php`.

4. Nakonfigurujte webový server tak, aby kořenový adresář směřoval do složky projektu.

5. Otevřete aplikaci ve webovém prohlížeči.

## API Reference

### Uživatelé
- `POST /index.php?action=register` - Registrace nového uživatele
- `POST /index.php?action=login` - Přihlášení uživatele
- `GET /index.php?action=logout` - Odhlášení uživatele
- `POST /index.php?action=update_profile` - Aktualizace profilu

### Cvičení
- `GET /index.php?page=exercises` - Seznam všech cvičení
- `POST /index.php?action=add_exercise` - Přidání nového cvičení
- `POST /index.php?action=update_exercise` - Aktualizace cvičení
- `POST /index.php?action=delete_exercise` - Smazání cvičení

### Cíle
- `GET /index.php?page=goals` - Seznam všech cílů
- `POST /index.php?action=add_goal` - Přidání nového cíle
- `POST /index.php?action=update_goal` - Aktualizace cíle
- `POST /index.php?action=update_goal_value` - Aktualizace hodnoty cíle
- `POST /index.php?action=delete_goal` - Smazání cíle 