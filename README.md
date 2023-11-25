## Base Web
A simple bare bones Web Application with RESTful API features

## Environment requirements
To run this application you must have installed on your environment:

- PHP 8.1 (https://www.php.net/downloads.php)
```
(You should have installed all the standard modules and extensions that comes with this version of PHP)
```
- Composer (https://getcomposer.org/)
- PostgreSQL 16 (https://www.postgresql.org/download/)
- A database client, eg. MySQL Workbench, DBeaver or any other such software

## Installation and Configuration
After cloning this rep and cd into the project's folder, perform the following steps:
- Install libraries
```
composer install
```
- Create local copy of .env file
```
cp .env.local .env
```
- Create local copy of Phinx's configuration file
```
cp phinx.yml.dist phinx.yml
```
- Use your prefered database client and create a database for your application to run on
- Open up the .env file you've created and setup the database credentials, for example:
```
DB_HOST=localhost
DB_NAME=base_web
DB_USER=postgres
DB_PASSWORD=root
```
- Do the same for the phinx.yml file
Setup .env and phinx.yml with database information
```
    development:
        adapter: pgsql
        host: localhost
        name: base_web
        user: postgres
        pass: 'root'
        port: 5432
        charset: utf8
```
- After that run the Phinx's migration command to create all the necessary databases
```
vendor/bin/phinx migrate
```
- If the migrations command ended with "All Done" it means you're good to go. To run the server on your local device using PHP's built-in server run the following:
```
php -S localhost:8080
```
And you're ready to work! Open your browser and access http://localhost:8080

## Unit Testing
There's a number of basic tests to validate some of the main features of the application, such as if validation rules are being enforced and if the registration request is being validated and executed. To perform thoses tests run the following
```
vendor/bin/phpunit tests/
```

## Endpoints
### __Users__
#### User creation
```
curl --location 'http://localhost:8080/register' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "Tony Soprano",
    "email": "t.soprano@mobsters.com",
    "password": "123456"
}'
```
