<h1 align="center"> Deploy Web Application </h1>

## Install Dependencies:

- For PHP dependencies `composer install`
- For Node.js dependencies `npm install`

<br>

## Generate the Application Key:
`php artisan key:generate`

<br>

## Configure the Environment:
- Open the .env file and configure your database
- configure your Email Details

<br>

## Run Database Migrations:
> [!WARNING]
> First you need to migrate the bank table. Then migrate the rest. <br>
> Run the following two codes one after the other. <br>
- `php artisan migrate --path=/database/migrations/2024_07_26_043735_create_institute_table.php` <br>
- `php artisan migrate `

<br>

## Run Database Seeders to add main super admin
- `php artisan db:seed`
  
<br>

## Super Admin Details

user name : super admin <br>
user email : super.admin@gmail.com <br>
user password : 12345678

<br>

## Start Laravel Development Server:
- `php artisan serve`



