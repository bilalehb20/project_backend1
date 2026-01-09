# PhoneShop — Laravel Web Application

Een Laravel 11 platform voor telefoons, accessoires, nieuws en community interactie.

## Features

### Authenticatie & Gebruikers
- ✅ **Login & Registratie**: Laravel Breeze authenticatie met gebruikersrollen
- ✅ **User & Admin Rollen**: Gescheiden toegang en functionaliteit
- ✅ **Password Reset**: Wachtwoordherstel functionaliteit
- ✅ **Profielen**: Publieke gebruikersprofielen met aanpasbare informatie (foto, naam, geboortedatum)

### Producten & Catalogus
- ✅ **Productcatalogus**: Overzicht van telefoons, hoesjes en accessoires met filtering (zoeken, categorie, merk)
- ✅ **Product Detail Pagina's**: Uitgebreide productinformatie
- ✅ **Favorieten Systeem**: Like/favorieten functionaliteit met AJAX (geen page refresh)
- ✅ **Dynamische Afbeeldingen**: Productafbeeldingen op basis van productnaam

### Content & Interactie
- ✅ **Homepage**: Hero sectie, categorieën/merken, populaire producten, laatste nieuws
- ✅ **Nieuws + Comments**: Nieuwsartikelen met commentaarsysteem (voor ingelogde gebruikers)
- ✅ **FAQ**: Categorieën met vragen en antwoorden
- ✅ **Contactformulier + Admin Reply**: Contactformulier met e-mail antwoord functionaliteit

### Admin Panel
- ✅ **Dashboard**: Overzicht met statistieken
- ✅ **Gebruikersbeheer**: Volledig CRUD systeem + admin toggle
- ✅ **Nieuwsbeheer**: Volledig CRUD systeem
- ✅ **FAQ Beheer**: Categorieën en vragen CRUD
- ✅ **Contactberichten**: Lezen en beantwoorden van contactberichten

### Design & UX
- ✅ **Dark/Light Mode**: Toggle tussen donker en licht thema
- ✅ **Responsive Design**: Volledig responsive voor mobile, tablet en desktop
- ✅ **Moderne UI**: Tailwind CSS met premium design

## Installatie

### Vereisten

- PHP 8.2 of hoger
- Composer
- Node.js en NPM
- MySQL database

### Stappen

1. **Clone het project**
   ```bash
   git clone https://github.com/bilalehb20/project_backend1.git
   cd project_backend1
   ```

2. **Installeer dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configureer environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configureer database in `.env`**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=phoneshop
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migraties en seeders**
   ```bash
   php artisan migrate:fresh --seed
   php artisan storage:link
   ```

6. **Start development server**
   ```bash
   php artisan serve
   npm run dev
   ```

## Default Admin

Na het runnen van `migrate:fresh --seed`:

- **Email**: `admin@ehb.be`
- **Password**: `Password!321`

## Mail Configuratie

Dit project gebruikt **Mailtrap** voor e-mail verzending tijdens development. Mailtrap vangt alle e-mails op voor testing zonder dat ze naar echte inboxen worden verzonden.

Configureer in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=info@phoneshop.be
MAIL_FROM_NAME="PhoneShop"
```

## Technologie

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL
- **Authentication**: Laravel Breeze

## Licentie

Dit project is ontwikkeld voor educatieve doeleinden.
