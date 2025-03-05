# Fuel Monitoring System

A Fuel Monitoring System is a technology-based solution designed to track daily sale and managing fuel in, device control,monitor tank data,watch dispensing fuel in real-time and much more.

## Key Features:
- Real-time fuel level tracking using sensors and IoT technology
- Fuel consumption analysis to monitor efficiency and detect anomalies
- Export Reports in excel.
- Monitor tank data with ATG.
- Cloud-based or Local-based data storage for easy access and management

## Test Status
[![Fuel Management](https://github.com/digitalengineeringtech/fuel-management/actions/workflows/laravel.yml/badge.svg?event=push)](https://github.com/digitalengineeringtech/fuel-management/actions/workflows/laravel.yml)

## Project Setup

### First you will need to clone the github repo.

```bash
  git clone https://github.com/digitalengineeringtech/fuel-management.git

  cd fuel-management

```
#### Install Composer

```bash
composer install 
```
## Environment Variables

### Copy to .env.example to .env

```bash
cp .env.example .env
```

To run this project, you will need redis and update the following environment variables to your .env file

`QUEUE_CONNECTION=redis`

`CACHE_STORE=redis`

`MQTT_HOST=127.0.0.1`

`MQTT_PORT=1883`

`MQTT_USERNAME=mqttusername`

`MQTT_PASSWORD=mqttpassword`

`MQTT_CLIENT_ID=mqttclientid`

`MQTT_KEEP_ALIVE=60`

## Database migrations and seeding

```bash
php artisan migrate
```

### For Cloud migrations ( Run only once )
```bash
php artisan migrate --path=database/migrations/cloud
```

### Seeding to database
```bash
php artisan db:seed
```

###  You will need to run console command to subscribe mqtt topic and listen for incoming connection.

#### This is for local development,for production use supervisor to run in backgroud.
```bash
php artisan subscribe:message
```
### Run laravel queue work command

```bash
php artisan queue:work
```

## Running Tests

To run tests, run the following command

```bash
php artisan test
```



    
