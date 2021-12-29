<?php

namespace Milestone\eBis;

use Illuminate\Support\ServiceProvider;

class eBisServiceProvider extends ServiceProvider
{
    use ServiceProviderTrait;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigs();
        $this->init();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      $this->loadRoutes();
      $this->loadViews();
      $this->loadMigrations();
      if($this->app->runningInConsole()){
        $this->publishAssets();
      }
    }

    private function loadRoutes(){
      $file = self::$request;
      $this->loadRoutesFrom(self::path('routes',"$file.php"));
    }

    private function loadViews(){
      $this->loadViewsFrom(self::path('views',self::$request),'eBis');
    }

    private function loadMigrations(){
      if(self::$request === 'setup')
        $this->loadMigrationsFrom(self::path('migrations'));
    }

    private function mergeConfigs(){
      //$this->mergeConfigFrom();
    }

    private function publishAssets(){
      $this->publishes([
        self::path('public') => public_path('/')
      ],'ebis');
    }
}
