# PhoneShop — Laravel Web Application

Een Laravel 11 platform voor telefoons, accessoires, nieuws en community interactie.

## Features

- ✅ **Login & Registratie**: Laravel Breeze authenticatie met gebruikersrollen
- ✅ **User & Admin Rollen**: Gescheiden toegang en functionaliteit
- ✅ **Profielen**: Publieke gebruikersprofielen met aanpasbare informatie
- ✅ **Producten + Favorieten**: Productcatalogus met like/favorieten functionaliteit
- ✅ **Nieuws + Comments**: Nieuwsartikelen met commentaarsysteem
- ✅ **FAQ**: Categorieën met vragen en antwoorden
- ✅ **Contactformulier + Admin Reply**: Contactformulier met e-mail antwoord functionaliteit
- ✅ **Admin Panel**: Volledig CRUD systeem voor gebruikers, nieuws, FAQ en contactberichten

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

Voor development wordt Mailtrap aanbevolen. Configureer in `.env`:

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
