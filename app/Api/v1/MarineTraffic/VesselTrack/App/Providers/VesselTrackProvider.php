<?php

namespace App\Api\v1\MarineTraffic\VesselTrack\App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class VesselTrackProvider
 *
 * @package App\Api\v1\MarineTraffic\VesselTrack\App\Providers
 */
class VesselTrackProvider extends ServiceProvider
{

    protected $repositories;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->initializeBindings();
        $this->registerRepositories();
    }

    /**
     * Repository bindings
     */
    protected function initializeBindings()
    {
        $this->repositories = [
            [
                "bind"=>'App\Api\v1\MarineTraffic\VesselTrack\Domain\Repositories\VesselTrackRepository',
                "repo"=>'App\Api\v1\MarineTraffic\VesselTrack\Infrastructure\Repositories\VesselTrackEloquentRepository',
                "construct"=>'App\Api\v1\MarineTraffic\VesselTrack\Domain\Models\VesselTrack'
            ]
        ];
    }

    /**
     * Register all repositories bindings
     */
    protected function registerRepositories()
    {
        if(!$this->repositories) {
            return;
        }

        foreach($this->repositories as $repository) {

            $this->app->bind($repository['bind'], function($app) use ($repository)
            {
                if(array_key_exists('construct',$repository)) {
                 return new $repository['repo']( new $repository['construct']() );
                } else {
                    return new $repository['repo']();
                }
            });
        }
    }
}
