<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 25.03.2022
 * Time: 23:00
 */

namespace Packages\ArminMiraftab\ManageFile\src\Facade;
//
//
//use App\Console\Commands\MakeStub;
//
class MakeStubFacade
{
    protected static $facadeName = 'MakeStub';

    protected static function getFacadeAccessor()
    {
        return 'MakeStub';
    }
    public static function register()
    {
        app()->bind(static::$facadeName, function () {
            return new MakeStub();
        });
    }
}