<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormatTimeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      //app_path sirve para sacar una ruta absoluta en nuestro proyecto
       require_once app_path() . '/Helpers/FormatTime.php';
    }
}
