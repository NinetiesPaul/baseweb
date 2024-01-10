## Base App
A simple bare bones Web Application with RESTful API features, designed mainly as an training exercise, project prototyping and PHP tests

## Environment requirements
To run this application you must have installed on your environment:

- PHP 7.4 or greater with standard modules and extensions enabled (https://www.php.net/downloads.php)
- MySQL 5.7 (https://dev.mysql.com/downloads/mysql/5.7.html)
- Composer (https://getcomposer.org/)
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
- Using your prefered database client, establish a connection with your MySQL server and create a database for your application to run on. For example, "base_app"
- Open up the .env file you've created and setup the database credentials, for example:
```
DB_HOST=localhost
DB_NAME=base_app
DB_USER=postgres
DB_PASSWORD=root
```
- Do the same for the phinx.yml file
```
    development:
        adapter: pgsql
        host: localhost
        name: base_app
        user: postgres
        pass: 'root'
        port: 5432
        charset: utf8
```
- After that run the Phinx's migration command to create all the necessary tables
```
vendor/bin/phinx migrate
```
- If the migrations command ended with "All Done" it means you're good to go.
To run the server on your local device using PHP's built-in server run the following on the projects's root folder:
```
php -S localhost:8080
```
And you're ready to work! Open your browser and access http://localhost:8080

## Unit Testing
There's a number of basic tests to validate some of the main features of the application, such as if validation rules are being enforced. To perform those tests run the following
```
vendor/bin/phpunit tests/
```

## Project features
There are some little features i've developed as an exercise and some proof of concepts. I've created an validation class and some crud modelling handling, both based off similar features found on Laravel. `App\Utils\Validator` is a basic validator class for input data. On the `UserController` class under the `createUser` method there's a usage of it, showcasing some basic forms of data validation. 

The model functionality can be further explored on `App\DB\Model`. Similar to Laravel, model classes that correlates to a SQL table must extend this class, as it handles all of the CRUD operations. As it is right now it only handle very basic operations, nothing like JOINS, UNIONS, etc. Also, when creating a model, there's some basic architecture to be followed, as show under `App\DB\Models\Users`

## Improvements to do
* Add more funcionalities to the table Modelling feature
* Add more validation rules to the Validator class
* Dockerize the project
* Improve error handling
