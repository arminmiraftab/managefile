<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 25.03.2022
 * Time: 22:36
 */

namespace Packages\ArminMiraftab\ManageFile\src\Facade;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;

class MakeStub
{
    protected static $model;
    protected static $stubPath;
    protected static $pathSource;
    protected static $field;

//    protected $files=;

    public function __construct($model,Filesystem $files)
    {
        $this->files = $files;
        $this->model = $model;
    }
    function hi(){
        return 123;
    }
        public function handle($model,$pathStub,$field,$pathSource)
        {
            static::$model=ucwords(Pluralizer::singular($model));
            static::$stubPath=$pathStub;
            static::$pathSource=$pathSource;

            static::$field= $field;
            $contents =  MakeStub::getSourceFile();


            if (!Filesystem::exists($pathSource)) {
                Filesystem::put($pathSource, $contents);
            }

        }
    /**
     * Return the stub file path
     * @return string
     *
     */
//    public function getStubPath()
//    {
//        return __DIR__ . '/../../../stubs/interface.stub';
//    }
    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public  function getSourceFile()
    {
        return MakeStub::getStubContents(static::$stubPath,static::$field);
    }

    /**
     **
     * Map the stub variables present in stub to its value
     *
     * @return array
     *
     */
//    public function getStubVariables()
//    {
//        return [
//            'NAMESPACE'         => 'App\\Repository\\'.$this->getSingularClassName($this->model) .'Repository',
//            'CLASS_NAME'        => $this->getSingularClassName($this->model),
//        ];
//    }
    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub , $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace('{{'.$search.'}}' , $replace, $contents);
        }

        return $contents;

    }
    /**
     * Get the full path of generate class
     *
     * @return string
     */
//    public function getSourceFilePath()
//    {
//        return public_path('App\Repository\\'.static::$model.'Repository')
//            .'\\' .static::$model .'Repository'.'h.php';
//            return
//            .'Repository'.'\\' .static::$model .'h.php';
//        return base_path('App\\Repository\\'.'s') .'s' . '    Interface.php';
//    }
    /**
     * Return the Singular Capitalize Name
     * @param $name
     * @return string
     */
//    public function getSingularClassName($name)
//    {
//        return ucwords(Pluralizer::singular($name));
//    }
    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }
        return $path;
    }
}