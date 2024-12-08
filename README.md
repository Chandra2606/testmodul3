# TES MODULE 3 IN CV.MEDIATAMA

## Teknologi yang Digunakan

- Laravel 11
- Alpine.js
- Tailwind CSS
- MySQL
- AOS (Animate On Scroll)


## Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB

## Instalasi

1. Clone repository

https://github.com/Chandra2606/testmodul3.git

cd testmodul3

2. Install dependencies

composer install

npm install

3. Copy .env.example menjadi .env

cp .env.example .env

4. Generate key

php artisan key:generate

5. Konfigurasi database di .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tesmodul3
DB_USERNAME=root
DB_PASSWORD=

6. Migrate database

php artisan migrate --seed

6. Run server

composer run dev

## Author

[Rafi Chandra]
