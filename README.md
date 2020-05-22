# Three days Challenge

Best RESTful API to manage a parking place.


## Prerequisites 🔧

* PHP
* Visual Studio Code
* MongoDB / SQL Lite (for unit test)
* Postman
* Nginx

## Usage ⚙️

You can run the API local usin: **php artisan serve** or deploy on Nginx Server.

List of operations availables:
Method | URI | Name | Action | Middleware
---|---|---|---|---
GET/HEAD|/||Closure|web
POST|api/login||App\Http\Controllers\UserController@authenticate|api
GET/HEAD|api/parkings|parkings.index|App\Http\Controllers\Api\ParkingController@index|api,jwt.verify
POST|api/parkings|parkings.store|App\Http\Controllers\Api\ParkingController@store|api,jwt.verify
DELETE|api/parkings/{parking}|parkings.destroy|App\Http\Controllers\Api\ParkingController@destroy|api,jwt.verify
PUT/PATCH|api/parkings/{parking}|parkings.update|App\Http\Controllers\Api\ParkingController@update|api,jwt.verify
GET/HEAD|api/parkings/{parking}|parkings.show|App\Http\Controllers\Api\ParkingController@show|api,jwt.verify
GET/HEAD|api/profiles|profiles.index|App\Http\Controllers\Api\ProfileController@index|api,jwt.verify
POST|api/profiles|profiles.store|App\Http\Controllers\Api\ProfileController@store|api,jwt.verify
GET/HEAD|api/profiles/{profile}|profiles.show|App\Http\Controllers\Api\ProfileController@show|api,jwt.verify
PUT/PATCH|api/profiles/{profile}|profiles.update|App\Http\Controllers\Api\ProfileController@update|api,jwt.verify
DELETE|api/profiles/{profile}|profiles.destroy|App\Http\Controllers\Api\ProfileController@destroy|api,jwt.verify
POST|api/register||App\Http\Controllers\UserController@register|api
POST|api/vehicles|vehicles.store|App\Http\Controllers\Api\VehicleController@store|api,jwt.verify
GET/HEAD|api/vehicles|vehicles.index|App\Http\Controllers\Api\VehicleController@index|api,jwt.verify
DELETE|api/vehicles/{vehicle}|vehicles.destroy|App\Http\Controllers\Api\VehicleController@destroy|api,jwt.verify
PUT/PATCH|api/vehicles/{vehicle}|vehicles.update|App\Http\Controllers\Api\VehicleController@update|api,jwt.verify
GET/HEAD|api/vehicles/{vehicle}|vehicles.show|App\Http\Controllers\Api\VehicleController@show|api,jwt.verify

Also you can run the unit test.  
 **To use mongodb you have to swap the model base class**
 
## Built With

* [PHP 7.4.6] - The Api and Web framework used
* [MongoDB] - Cloud storage
* [Laravel 6.18.15] - Framework and ORM


## Author ✒️

* **Victor Maravilla** - [Likedin](https://www.linkedin.com/in/vamaravilla/)

## License
[MIT](https://choosealicense.com/licenses/mit/)