# Fuel Management System

### Test Status
[![Fuel Management](https://github.com/digitalengineeringtech/fuel-management/actions/workflows/laravel.yml/badge.svg?event=push)](https://github.com/digitalengineeringtech/fuel-management/actions/workflows/laravel.yml)

### Installation Guide

```bash
git clone https://github.com/digitalengineeringtech/fuel-management.git

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

 // run only one time for cloud server.
 php artisan migrate && php artisan migrate --path=database/migrations/stations

 // Seed to Database 
 php artisan db:seed
```

### Link storage for image or file to access in public

```bash
php artisan storage:link

```

### Give permission to storage folder 

```bash
sudo chmod -R 777 storage bootstrap/cache

```

### Running Testcase

```bash
php artisan test

```

    
