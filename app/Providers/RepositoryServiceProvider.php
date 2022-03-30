<?php

namespace App\Providers;

use App\Console\Commands\eew;
use Illuminate\Support\ServiceProvider;
use App\Repository\CategoryqqqwwwwqRepository\CategoryqqqwwwwqRepositoryClass;;
use App\Repository\CategoryqqqwwwwqRepository\CategoryqqqwwwwqRepositoryInterface;
use App\Repository\CategoryqqqwwRepository\CategoryqqqwwRepositoryClass;;
use App\Repository\CategoryqqqwwRepository\CategoryqqqwwRepositoryInterface;
use App\Repository\CategoryqqqwRepository\CategoryqqqwRepositoryClass;;
use App\Repository\CategoryqqqwRepository\CategoryqqqwRepositoryInterface;
use App\Repository\Cat3Repository\Cat3RepositoryClass;;
use App\Repository\Cat3Repository\Cat3RepositoryInterface;
use App\Repository\Cat2Repository\Cat2RepositoryClass;;
use App\Repository\Cat2Repository\Cat2RepositoryInterface;
use App\Repository\CategoryRepository\CategoryRepositoryClass;;
use App\Repository\CategoryRepository\CategoryRepositoryInterface;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    protected $commands=[
//        MakeInterfaceCommand::class
//    hi::class
        eew::class
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
        $this->app->singleton(CategoryqqqwwwwqRepositoryInterface::class,CategoryqqqwwwwqRepositoryClass::class);
        $this->app->singleton(CategoryqqqwwRepositoryInterface::class,CategoryqqqwwRepositoryClass::class);
        $this->app->singleton(CategoryqqqwRepositoryInterface::class,CategoryqqqwRepositoryClass::class);
        $this->app->singleton(Cat3RepositoryInterface::class,Cat3RepositoryClass::class);
        $this->app->singleton(Cat2RepositoryInterface::class,Cat2RepositoryClass::class);
        $this->app->singleton(CategoryRepositoryInterface::class,CategoryRepositoryClass::class);
        //
    }
}
