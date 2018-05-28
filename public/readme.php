开发环境 Win nmp+composer https://winnmp.wtriple.com/
composer config -g repo.packagist composer https://packagist.phpcomposer.com
laravel一键安装包http://laravelacademy.org/resources-download 改名passportor
或者composer create-project --prefer-dist laravel/laravel passportor
/passportappointmentsystem/.env  
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
数据库照此建立

/passportappointmentsystem/config/app.php      'debug' => env('APP_DEBUG', true),

php artisan key:generate
php artisan config:cache

访问http://localhost/passportor/public/

php artisan make:model Passport -m
php artisan make:model Passport --migration  //新建model
database/migrations/[timestamp]_create_cars_table.php  补全
php artisan migrate

/routes/web.php/
Route::resource('passports','PassportController');

php artisan make:controller PassportController --resource
/app/Http/Controllers/PassportController.php

app/Http/routes.php
Route::resource('cars', 'CarController');

Request Type	Path	Action	Route Name
GET	/cars	index	cars.index
GET	/cars/create	create	cars.create
POST	/cars	store	cars.store
GET	/cars/{car}	show	cars.show
GET	/cars/{car}/edit	edit	cars.edit
PUT/PATCH	/cars/{car}	update	cars.update
DELETE	/cars/{car}	destroy	cars.destroy

    public function show($id)
    {
      $car = Car::find($id);
      return view('cars.show', array('car' => $car));
    }

resources/views/cars/show.blade.php

{{ $car->make }}==<?php echo $car->make; ?>


http://localhost:8000/passports/create
