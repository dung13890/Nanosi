# About Nanosi

[![Build Status](https://api.travis-ci.org/dung13890/Nanosi.svg)](https://travis-ci.org/dung13890/Nanosi)

## Required

 - Git
 - Composer
 - PHP v.7.x
 - MySql v.5.7.x
 - Node
 - Npm
 - bower
 - webpack

## Setup for project with Web application

```sh
$ git clone git@github.com:dung13890/Nanosi.git
$ cd project
$ composer install --no-scripts
$ npm install
$ bower install
$ cp .env.example .env
$ php artisan key:generate
```

## Create Database 

```sh
$ mysql -u username -psecret

mysql> create database laravel_db;
mysql> exit;
```
## Config environment
$ vim .env

Change DB_DATABASE, DB_USERNAME and DB_PASSWORD

## Migrate && seed data factories

```sh
$ php artisan migrate:refresh --seed
```

## Start web application production

```sh
$ npm run production
```

## Start web application Dev

```sh
$ npm run dev or $ npm run watch
```

## Test

```sh
$ ./vendor/bin/phpunit
```
