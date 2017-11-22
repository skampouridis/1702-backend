<?php

namespace App\Api\v1\Core\App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class RouteServiceProvider
 *
 * This class is responsible to include api routes for each package.
 *
 * @package App\Api\v1\Core\App\Providers
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Api\v1';
    protected $apiRoutePath = 'app/Api/v1';
    protected $serverRootPath = '/var/www';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        //get the API version projects
        $projects = config('apimodules.modules.v1');

        foreach($projects as $project=>$modules) {

            if(strtolower($project) == 'core') {

                 Route::prefix('api')
                     //->middleware('api')
                     ->namespace($this->namespace)
                     ->group(app_path('Api/v1/Core/App/routes/api.php'));

            }

            if(is_array($modules) && sizeof($modules) > 0) {

                foreach($modules as $module) {

                    if(file_exists($this->serverRootPath.'/'.$this->apiRoutePath.'/'.$project.'/'.$module.'/App/routes/api.php')) {
                         Route::prefix('api')
                             /*->middleware('api')*/
                             ->namespace($this->namespace.'\\'.$project.'\\'.$module.'\App\Controllers')
                             ->group(app_path('Api/v1/'.$project.'/'.$module.'/App/routes/api.php'));
                    }

                }
            }
        }
    }
}
