### Vessels Track API

Implemented with Laravel 5.5.19 with libraries **neoxia/laravel-csv-response** and **jailtonsc/laravel-response-xml** to enable xml and csv Responses.

Further development:
1. Using different framework, Laravel is not the best for an API handling the amount of requests or the size of a project like this
2. Further optimization on database data types, and response data is needed

There is working copy of the implementation in https://www.manoloudis.gr/marine

#### Development tools
> * osx php7
> * osx mysql server
> * osx terminal
> * laravel cli
> * phpStorm
> * sequel pro

#### Terminal commands
##### Project initiation
> 1. `composer global require "laravel/installer"`
> 2. `laravel new marine`
> 3. `composer require neoxia/laravel-csv-response`
> 4. `composer require jailtonsc/laravel-response-xml`
> 5. `php artisan vendor:publish (Select laravel-response-xml) `

##### Models
> 1. `php artisan make:model Vessel --migration`
> 2. `php artisan make:model VesselTrack --migration`
> 3. `php artisan make:model Client --migration`
> 4. `php artisan make:model Search --migration`

#### Migration pivot tables
> 1. `php artisan make:migration create_search_vessel_table --table=search\_vessel`
> 2. `php artisan make:migration create_search_vessel_track_table --table=search\_vessel\_track`

##### Seeders
> 1. `php artisan make:seeder VesselsTableSeeder`
> 2. `php artisan make:seeder VesselTracksTableSeeder`

##### Resources
> 1. `php artisan make:resource Client`
> 2. `php artisan make:resource ClientCollection`
> 3. `php artisan make:resource Vessel`
> 4. `php artisan make:resource VesselCollection`
> 5. `php artisan make:resource VesselTrack`
> 6. `php artisan make:resource VesselTrackCollection`
> 7. `php artisan make:resource Search`
> 8. `php artisan make:resource SearchCollection`

##### Controllers
> 1. `php artinan make:controller ClientCotnroller --resource`
> 2. `php artinan make:controller VesselCotnroller --resource`
> 3. `php artisan make:controller SearchController --resource`
> 4. `php artisan make:controller VesseTrackCotntroller --resource`