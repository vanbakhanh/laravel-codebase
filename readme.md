# Codebase Server

Codebase is a web application base on Laravel Framework 6.0 with expressive, elegant syntax.

## Hosts within environment

| Service | Hostname | Port number |
| ------- | -------- | ----------- |
| Nginx   | nginx    | 80, 443     |
| Laravel | laravel  | 9000        |
| MySQL   | mysql    | 3306        |
| Redis   | redis    | 6379        |

## Installation

Open your favorite Terminal and run these commands.

Build and run docker for environment.

```sh
$ cp docker-compose.yml.example docker-compose.yml
$ cp docker/nginx/nginx.conf.example docker/nginx/nginx.conf
$ docker-compose build
$ docker-compose up -d
$ docker-compose exec laravel sh
```

After build and run docker, run these commands to install dependencies.

```sh
$ npm install
$ npm run dev
$ composer install
```

Run these commands to generate application configurations.

```sh
$ chown -R www-data:www-data /application/storage /application/bootstrap/cache
$ cp .env.example .env
$ php artisan key:generate
$ php artisan storage:link
$ php artisan migrate --seed
```

Verify the deployment by navigating to your server address in your preferred browser.

```sh
https://127.0.0.1/
```

Admin account: admin@email.com/12345678

## OAuth client

**Personal access client**

```sh
Client ID: 1
Client secret: H7Y4j1Thmd5Zlwc0qgIyULcaQ3arc9J3rRHnr3HI
```

**Password grant client**

```sh
Client ID: 2
Client secret: YOWj2ITAD2lH5u6GwXyGpsfyffOWxVKWlZl7ixxR
```

## Design pattern

```sh
UI -> Controller -> Service -> Repository -> Model/Database
```
