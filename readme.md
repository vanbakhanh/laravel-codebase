# Codebase Server

Codebase is a web application base on Laravel Framework 6.0 with expressive, elegant syntax.

## Hosts within environment

Service|Hostname|Port number
------|---------|-----------
nginx|webserver|80, 443
php-fpm|php-fpm|9000
MySQL|mysql|3306
Redis|redis|6379

## Installation

Open your favorite Terminal and run these commands.

Build and run docker for environment.

```sh
$ cp docker-compose.yml.example docker-compose.yml
$ cp docker/nginx/nginx.conf.example docker/nginx/nginx.conf
$ docker-compose build
$ docker-compose up -d
$ docker-compose exec php-fpm sh
```

After build and run docker, run these commands to install dependencies.

```sh
$ npm install
$ npm run dev
$ composer install
```

Run these commands to generate application configurations.

```sh
$ chown -R www-data:www-data /application/
$ cp .env.example .env
$ php artisan key:generate
$ php artisan storage:link
$ php artisan migrate --seed
$ php artisan passport:install
```

Verify the deployment by navigating to your server address in your preferred browser.

```sh
https://127.0.0.1/
```

## Design pattern

 `UI -> Controller -> Service -> Repository -> Model/Database`

## Docker compose cheatsheet

* Start containers in the background: `docker-compose up -d`
* Start containers on the foreground: `docker-compose up`. You will see a stream of logs for every container running.
* Stop containers: `docker-compose stop`
* Kill containers: `docker-compose kill`
* View container logs: `docker-compose logs`
* Execute command inside of container: `docker-compose exec SERVICE_NAME COMMAND` where `COMMAND` is whatever you want to run. Examples:
      * Shell into the PHP container, `docker-compose exec php-fpm sh`
      * Run symfony console, `docker-compose exec php-fpm bin/console`
      * Open a mysql shell, `docker-compose exec mysql mysql -uroot -p CHOSEN_ROOT_PASSWORD`
