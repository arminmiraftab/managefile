<?php

namespace ArminMiraftab\ManageFile\Providers;

use Illuminate\Support\ServiceProvider;



class FileManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    protected $commands = [
        'Vendor\Package\arminmiraftab\managefile\src\Commands\MakeInterfaceCommand',

    ];
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){
        $this->publishes([
            __DIR__ . '/../Config/managefile.php' =>config_path('managefile.php')
        ]);
    }
}
