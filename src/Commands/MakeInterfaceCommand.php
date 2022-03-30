<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 25.03.2022
 * Time: 12:30
 */
namespace  Vendor\packages\arminmiraftab\managefile\Commands;

use packages\arminmiraftab\managefile\src\Facade\MakeStub;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem;


class MakeInterfaceCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make an Interface Class';
    protected $pathStubs = __DIR__ . '\..\Stubs';

    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected $files;

//    protected $model=ucwords(Pluralizer::singular($this->argument('name')));
    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files )
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        dd('163');
            Artisan::call("make:model"." ".$this->getSingularClassName($this->argument('name'))." -m");
            $this->makeEloquentInterface();
            $this->makeEloquentClass();
            $this->makeRequests();
            $this->makeResources();
            $this->makePipeline();
            $this->makeController();
            $this->copyServices();
            $this->makeProvider();




//       return $this->files->put(getcwd().'\app\Providers\RepositoryServiceProvider.php',2);
//        $pathClass=
//        Artisan::call("make:controller"." ".$this->getSingularClassName($this->argument('name')).'Controller'." --model=".$this->getSingularClassName($this->argument('name')));
//


    }





    /**
     * Get the full path of generate class
     *
     * @return string
     */
    public function getSourceFilePathInterface()
    {
        return base_path('App\\Repository\\'.$this->getSingularClassName($this->argument('name'))) .'Repository'.'\\' .$this->getSingularClassName($this->argument('name')) . 'Interface.php';
    }
    public function getSourceFilePathClass()
    {
        return base_path('App\\Repository\\'.$this->getSingularClassName($this->argument('name'))) .'Repository'.'\\' .$this->getSingularClassName($this->argument('name')) . 'class.php';
    }

    /**
     * Return the Singular Capitalize Name
     * @param $name
     * @return string
     */
    public function getSingularClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }

        protected function makeDirectory($path){
            if ( !$this->files->isDirectory($path)) {
                $this->files->makeDirectory($path, 0777, true, true);
            }
        }

    protected function makeEloquentInterface()
    {
        $model=$this->getSingularClassName($this->argument('name'));
        $this->makeDirectory(getcwd().'\App\Repository\\'. $model.'Repository');
        MakeStub::handle(
                $this->argument('name'), $this->pathStubs.'/interface.stub',[
                'NAMESPACE'         => 'App\\Repository\\'.$model .'Repository',
                'CLASS_NAME'        => $model,
            ],
       getcwd().'\App\Repository\\'.$model.'Repository'. '\\' .$model .'Repository'.'Interface.php');
    }
    protected function makeEloquentClass()
    {
        $model=$this->getSingularClassName($this->argument('name'));
        $this->makeDirectory(getcwd().'\App\Repository\\'. $model.'Repository');
        MakeStub::handle(
            $this->argument('name'), $this->pathStubs.'/EloquentRepository.stub',[
            'NAMESPACE'         => 'App\\Repository\\'.$model .'Repository',
            'CLASS_NAME'        => $model,
        ],
            getcwd().'\App\Repository\\'.$model.'Repository'. '\\' .$model .'Repository'.'Class.php');
    }
    protected function makeRequests()
    {
        $model=$this->getSingularClassName($this->argument('name'));
        $this->makeDirectory(getcwd().'\App\Http\Requests\\'. $model.'Request');

        MakeStub::handle(
            $this->argument('name'), $this->pathStubs.'/request.repository.stub',[
            'NAMESPACE'         => 'App\Http\Requests\\'.$model .'Request',
            'CLASS_NAME'        => 'Update'.$model,
        ],
            getcwd().'\App\Http\Requests\\'.$model.'Request'. '\\' .'Update' .$model .'Request.php');
        MakeStub::handle(
            $this->argument('name'), $this->pathStubs.'/request.repository.stub',[
            'NAMESPACE'         => 'App\Http\Requests\\'.$model .'Request',
            'CLASS_NAME'        => 'Store'.$model,
        ],
            getcwd().'\App\Http\Requests\\'.$model.'Request'. '\\'.'Store'  .$model .'Request.php');

    }
    protected function makeResources()
    {
        $model=$this->getSingularClassName($this->argument('name'));
        $this->makeDirectory(getcwd().'\App\Http\Resources\\'. $model.'Resources');

        MakeStub::handle(
            $this->argument('name'), $this->pathStubs.'/resource.repository.stub',[
            'NAMESPACE'         => 'App\Http\Resources\\'.$model .'Resources',
            'CLASS_NAME'        => 'Index' .$model .'Resource',
        ],
            getcwd().'\App\Http\Resources\\'.$model.'Resources'. '\\' .'Index' .$model .'Resource.php');
        MakeStub::handle(
            $this->argument('name'), $this->pathStubs.'/resource.repository.stub',[
            'NAMESPACE'         => 'App\Http\Resources\\'.$model .'Resources',
            'CLASS_NAME'        => 'Store' .$model .'Resource',
        ],
            getcwd().'\App\Http\Resources\\'.$model.'Resources'. '\\' .'Store' .$model .'Resource.php');
        MakeStub::handle(
            $this->argument('name'), $this->pathStubs.'/resource.repository.stub',[
            'NAMESPACE'         => 'App\Http\Resources\\'.$model .'Resources',
            'CLASS_NAME'        => 'Update' .$model .'Resource',
        ],
            getcwd().'\App\Http\Resources\\'.$model.'Resources'. '\\' .'Update' .$model .'Resource.php');
        MakeStub::handle(
            $this->argument('name'), $this->pathStubs.'/resource.repository.stub',[
            'NAMESPACE'         => 'App\Http\Resources\\'.$model .'Resources',
            'CLASS_NAME'        => 'Show' .$model .'Resource',
        ],
            getcwd().'\App\Http\Resources\\'.$model.'Resources'. '\\' .'Show' .$model .'Resource.php');
    }

    protected function makePipeline()
    {
        $this->makeDirectory(getcwd().'\app\Repository\Services\Filter\Filters');
        MakeStub::handle(
            $this->argument('name'), $this->pathStubs.'/pipeline.repository.main.stub',[
            'NAMESPACE'         => 'App\Repository\Services\Filter',
        ],
            getcwd().'\app\Repository\Services\Filter\Filter.php');
        MakeStub::handle(
            $this->argument('name'), $this->pathStubs.'/pipeline.repository.date.to.stub',[
            'NAMESPACE'         => 'App\Repository\Services\Filter\Filters',
        ],
            getcwd().'\App\Repository\Services\Filter\Filters\DateTo.php');
        MakeStub::handle(
                $this->argument('name'), $this->pathStubs.'/pipeline.repository.date.from.stub',[
                'NAMESPACE'         => 'App\Repository\Services\Filter\Filters',
            ],
                getcwd().'\App\Repository\Services\Filter\Filters\DateFrom.php');


    }

    protected function makeController()
    {
//        dd($this->argument('name'))
//            ;
        $model=$this->getSingularClassName($this->argument('name'));
        $this->makeDirectory(getcwd().'\App\Http\Controllers\Api');

        MakeStub::handle(
            $this->argument('name'), $this->pathStubs.'/controller.repository.api.stub',[
            'NAMESPACE'         => 'App\Http\Controllers\Api',
            'CLASS_NAME'        => $model,
            'REQUEST_STORE'        => 'Store'.$model.'Request',
            'UPDATE_REQUEST'        => 'Update'.$model.'Request',
            'INTERFACE'        =>  $model .'Repository'.'Interface',
            'VAR_INTERFACE'        =>  $this->argument('name'),
        ], getcwd().'\App\Http\Controllers\Api\\'.$model.'Controller.php');
    }

    protected function copyServices()
    {
        $this->makeDirectory(getcwd().'\App\Repository\Services');

//        dd( MakeStub::hi());
        MakeStub::handle(
            '', $this->pathStubs.'/Helpers.stub', []
            , getcwd().'\App\Repository\Services\Helpers.php');

        MakeStub::handle(
            $this->argument('name'), $this->pathStubs.'/PaginationResource.stub', []
            , getcwd().'\App\Repository\Services\PaginationResource.php');

        MakeStub::handle(
            '', $this->pathStubs.'/Image.stub', []
            , getcwd().'\App\Repository\Services\UploadImage.php');
        }
    public function makeProvider(){
        $model=$this->getSingularClassName($this->argument('name'));
        $path=$this->makeDirectoryProvider();
        $search='public function boot(){';
        $searchNameSpace='use Illuminate\Support\ServiceProvider;';
        $replaceNameSpace='use Illuminate\Support\ServiceProvider;
use App\Repository\\'.$model.'Repository\\'.$model.'RepositoryClass;;
use App\Repository\\'.$model.'Repository\\'.$model.'RepositoryInterface;';
        $replace='public function boot(){
        $this->app->singleton('.$model .'RepositoryInterface::class,'.$model .'RepositoryClass::class);';
        $this->files->replace( $path,str_replace($search, $replace, file_get_contents($path)));
        $this->files->replace( $path,str_replace($searchNameSpace, $replaceNameSpace, file_get_contents($path)));

    }
    public function makeDirectoryProvider()
    {

        $pathRepository=getcwd().'\app\Providers';
        if ( !$this->files->isDirectory($pathRepository)){
            $this->files->makeDirectory($pathRepository);
        }
//      dd(!$this->file->exists('app\Providers\RepositoryServiceProviders.php'));
        if (!$this->files->exists('app\Providers\RepositoryServiceProvider.php'))
            MakeStub::handle(
                $this->argument('name'), $this->pathStubs.'/provider.stub',[
                'NAMESPACE'         => 'app\Providers',
                'CLASS_NAME'        => 'RepositoryServiceProvider',

            ],
                getcwd().'\app\Providers\RepositoryServiceProvider.php');

//            $this->files->put('app\Providers\RepositoryServiceProvider.php',file_get_contents(__DIR__ . '/../../../stubs/package/provider.stub'));
        return getcwd().'\app\Providers\RepositoryServiceProvider.php';
    }


}