docker-symfony-postgre-min
--------------------------
Laravel workspace with `PHP 8.1`, `NGINX 1.20+`, `PostgreSQL 13.6+`, `MailHog` and `Laravel 9`.

Initialization
====================================================

1. Clone the project:

        https://github.com/arturmazanik/notification-api-laravel.git

1. Go to the project's folder

        cd src

1. add your existing .env or you may the use default .env from laravel. 
   (src/.env.example - working .env file. remove .example, setup rabbitmq (I used CloudAMQP) and use)


1. install some vendors

        composer install

1. Return to root and build app with command

        docker-compose --env-file ./src/.env up -d --build site


Setup application after initialization
======================================

1. Run all migrations (in src folder)


      php artisan migrate

1. Put data to DB

      
      php artisan db:seed

1. For test api setup headers


      X-Requested-With: XMLHttpRequest

Using
==============

Using app
--------------------

Exposed ports based from ./src/.env ( i will be using .env_example as a sample)

* app_name - `Laravel` (APP_NAME)
* nginx - `:801` (NGINX_PORT)
* pgsql - `:5432` (DB_PORT)
* php - `:9000`
* redis - `:63791` (REDIS_PORT)
* mailhog - `:1025` (MAIL_PORT)
* mailhog interface - `:8025` (MAIL_PORT)


Routes (Swagger /api/documentation)
=======

Auth
----

POST `/api/register`

POST `/api/login`

POST `/api/logout`

Clients (Public API)
-------

GET `/api/clients`

GET `/api/client/{id}`

POST `/api/addClient`

PUT `/api/editClient/{id}`

DELETE `/api/client/{id}`

Agent (Private API)
===================

Notifications
--------------

POST `/api/addNotifications`

POST `/api/getNotification`

POST `/api/getNotifications`
