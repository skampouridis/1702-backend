<?php

namespace App\Api\v1\Core\App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class ModulesServiceProvider
 *
 * A responsible class for the auto registration process of all providers
 *
 * @package App\Api\v1\Core\App\Providers
 */
class ModulesServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
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
    }

    public function register()
    {
        $this->serviceProviders();
    }

    /**
     * Register the API's modules service providers.
     */
    protected function serviceProviders()
    {
        $projects = config('apimodules.modules.v1');

        foreach($projects as $project=>$modules) {

            if(strtolower($project) == 'core') {
                continue;
            }

            if(is_array($modules) && sizeof($modules) > 0) {

                foreach($modules as $module) {

                    if(file_exists(
                        $this->serverRootPath.'/'.
                        $this->apiRoutePath.'/'.
                        $project.'/'.
                        $module.'/App/Providers/'.
                        ucfirst($module).'Provider.php')) {

                        $provider = $this->namespace . '\\' .
                            $project . '\\' .
                            $module . '\\App\Providers\\' .
                            ucfirst($module) . 'Provider';

                        $this->app->register($provider);
                    }

                }
            }
        }
    }
}
