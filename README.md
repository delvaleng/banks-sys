# Sistema de transacciones bancarias en línea

----------

# Getting started

## Installation

Clone the repository

    git clone git@github.com:delvaleng/banks-sys.git

Switch to the repo folder

    cd banks-sys

Generate the database with the name (bank-sys)

    CREATE DATABASE `bank-sys`
    
Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
    
Run the database seeder 

    php artisan db:seed

Start the local development server

    php artisan serve


   # build CSS and JS assets
        npm run dev o npm run watch
    # or, if you prefer minified files
        npm run prod
     You can now access the server at http://localhost:8000 o http://localhost:3000
     
     
# Testing API

Run the laravel development server

    php artisan serve

User: 

       N°Documento -> 0021255894
       Contraseña  -> 1234
       
       N°Documento -> 0123456789
       Contraseña  -> 1234
       
       N°Documento -> 9876543210
       Contraseña  -> 1234

# Developer

    Gloribel Delgado,
    Ingeniero de Sistemas



