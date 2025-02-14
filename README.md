# Nettbutikk

Dette er en enkel nettbutikk laget med **PHP, MySQL, HTML og CSS**. Den inneholder grunnleggende funksjonalitet for registrering og innlogging av brukere.

## 📌 Funksjonalitet
- **Hjemmeside (index.php)**: Viser en velkomstmelding og lenker til registrering og innlogging.
- **Registrering (registrer.php)**: Lar nye brukere registrere seg ved å fylle ut et skjema.
- **Innlogging (login.php)**: Gir brukere mulighet til å logge inn og få tilgang til en velkomstside.
- **Velkomstside (welcome.php)**: Viser en personlig velkomstmelding etter vellykket innlogging.
- **Utlogging (logout.php)**: Logger ut brukeren og avslutter økten.
- **Stilark (nettside.css)**: Inneholder grunnleggende CSS-styling.

## 🚀 Teknologier brukt
- **PHP** (backend, håndtering av brukerdata)
- **MySQL** (database for lagring av brukere)
- **HTML** (strukturering av nettsidene)
- **CSS** (grunnleggende stil og layout)

## 📂 Filstruktur
```
/nettbutikk
│── index.php          # Hovedside
│── registrer.php      # Registreringsside
│── login.php          # Innloggingsside
│── welcome.php        # Velkomstside for innloggede brukere
│── logout.php         # Utloggingsfunksjonalitet
│── nettside.css       # CSS-stilark
│── README.md          # Dokumentasjon
```

## 🔧 Oppsett og bruk
1. **Installer en lokal server** som XAMPP eller MAMP.
2. **Opprett en MySQL-database** kalt `nettbutikk`.
3. **Opprett en `kunder`-tabell** ved å kjøre følgende SQL-spørring:
   ```sql
   CREATE TABLE kunder (
       kunde_id INT AUTO_INCREMENT PRIMARY KEY,
       fornavn VARCHAR(50) NOT NULL,
       etternavn VARCHAR(50) NOT NULL,
       epost VARCHAR(100) UNIQUE NOT NULL,
       telefon VARCHAR(20) NOT NULL,
       adresse TEXT NOT NULL,
       passord VARCHAR(255) NOT NULL
   );
   ```
4. **Rediger databaseinnstillingene** i `registrer.php` og `login.php` for å matche dine egne innloggingsdetaljer.
5. **Start serveren og test nettbutikken** ved å navigere til `http://localhost/nettbutikk/`.

## 🔒 Sikkerhetstiltak
- Passord hasjes med `password_hash()`.
- SQL-injeksjoner forhindres ved å bruke **forberedte spørringer**.
- Økter (`$_SESSION`) brukes for å holde brukere innlogget.

## 📌 Forbedringer
- Implementere validering av inputfelt.
- Legge til e-postbekreftelse for registrering.
- Forbedre UI/UX med mer avansert CSS og JavaScript.

**Lykke til med utviklingen av nettbutikken din!** 🎉

