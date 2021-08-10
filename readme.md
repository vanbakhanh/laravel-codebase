# Codebase Server

Codebase is a web application base on Laravel Framework 8.x with expressive, elegant syntax.

## Hosts within environment

| Service | Hostname | Port number |
| ------- | -------- | ----------- |
| Nginx   | nginx    | 80, 443     |
| Laravel | laravel  | 9000        |
| MySQL   | mysql    | 3306        |
| Redis   | redis    | 6379        |

## Installation

Open your favorite Terminal and run these commands.

For development environment:

```sh
$ docker-compose -f docker-compose-dev.yml build
$ docker-compose -f docker-compose-dev.yml up -d
$ docker-compose exec laravel sh
$ composer install
$ npm install
$ npm run dev
$ php artisan db:seed
```

For production environment:

```sh
$ docker-compose -f docker-compose-prod.yml build
$ docker-compose -f docker-compose-prod.yml up -d
$ docker-compose exec laravel sh
$ php artisan db:seed
```

Verify the deployment by navigating to your server address in your preferred browser.

```sh
http://127.0.0.1/
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
