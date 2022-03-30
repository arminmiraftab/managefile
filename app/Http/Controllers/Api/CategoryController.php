<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest\StoreCategoryRequest;
use App\Http\Requests\CategoryRequest\UpdateCategoryRequest;
use App\Http\Resources\CategoryResources\IndexCategoryResource;
use App\Http\Resources\CategoryResources\StoreCategoryResource;
use App\Http\Resources\CategoryResources\UpdateCategoryResource;
use \App\Repository\CategoryRepository\CategoryRepositoryInterface;
use \App\Repository\Services\Helpers;
use App\Repository\Services\PaginationResource;
use App\Repository\Services\UploadImage;

class CategoryController extends Controller
{

    use UploadImage;

     /**
     * @varCategoryRepositoryInterface
     */
    protected $Category;

    public function __construct( CategoryRepositoryInterface $Category){

        $this->Category = $Category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return 1;
       $Category= $this->Category->index();
         return Helpers::isArrayReturn(
         $Category,Helpers::returnRequest(
          new PaginationResource($Category
          ,IndexCategoryResource::collection($Category))),'نتیجه ای یافت نشد');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
//        return 1;
        $requestValid=$request->validated();
        $requestValid['image']= $this->storeImage($request->file('image'));
        $Category= $this->Category->store($requestValid);
        return Helpers::isReturn($Category,
         Helpers::returnRequest(new StoreCategoryResource($Category)),'نتیجه ای یافت نشد');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $Category=$this->Category->show($id);
        if ($Category){ $updated=$this->Category->update($request->validated(),$id);
          return  Helpers::isReturn($updated, Helpers::returnRequest(new UpdateCategoryResource($updated)),' ویرایش نشد');
        }else{
          return  Helpers::notFindRequest('نتیجه ای یافت نشد');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted=$this->Category->destroy($id);
           return  Helpers::isReturn($deleted, Helpers::returnDestroy($deleted),'یافت نشد');
    }
}
