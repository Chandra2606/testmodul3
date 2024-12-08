<div align="center">
  <h1>🚀 TES MODULE 3 IN CV.MEDIATAMA</h1>
</div>

## 🛠️ Teknologi yang Digunakan

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
  <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=black" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" />
  <img src="https://img.shields.io/badge/AOS-563D7C?style=for-the-badge" />
</p>

## 💻 Persyaratan Sistem

| Requirement | Version |
|-------------|---------|
| PHP | >= 8.2 |
| Composer | Latest |
| Node.js & NPM | Latest |
| MySQL/MariaDB | Latest |

## 🚀 Panduan Instalasi

### 1. Clone Repository
git clone https://github.com/Chandra2606/testmodul3.git
cd testmodul3

### 2. Install Dependencies
```
composer install
npm install
```

### 3. Konfigurasi Environment
```
cp .env.example .env
```

```
php artisan key:generate
```

### 4. Konfigurasi Database
Sesuaikan pengaturan berikut di file `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tesmodul3
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrate Database
```
php artisan migrate --seed
```

### 6. Jalankan Server
```
composer run dev
```


<div align="center">
  
## 👨‍💻 Author

**Rafi Chandra**

[![GitHub](https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white)](https://github.com/Chandra2606)

</div>

