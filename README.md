# Fuel Management System

## [![Testcase](https://github.com/zmkiihdev/fuel-management/actions/workflows/laravel.yml/badge.svg?branch=main&event=push)](https://github.com/zmkiihdev/fuel-management/actions/workflows/laravel.yml)

### Installation Guide

```bash
git clone https://github.com/zmkiihdev/fuel-management.git

cd /path/to/fuel-management

```

### Copy .env file

```bash
cp .env.example .env

```

### Composer install

```bash
composer install

```

### Generate Application Key

```bash
php artisan key:generate

```

### Running seeder or migrations
```bash
 php artisan migrate

 // run only one time for cloud server.
 php artisan migrate --path=database/migrations/stations

 php artisan db:seed
```

### Give permission to storage folder

```bash
sudo chmod -R 777 storage bootstrap/cache

```

### Running Testcase

```bash
php artisan test

```

    