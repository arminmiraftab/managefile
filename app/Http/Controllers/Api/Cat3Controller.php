<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cat3Request\StoreCat3Request;
use App\Http\Requests\Cat3Request\UpdateCat3Request;
use App\Http\Resources\Cat3Resources\IndexCat3Resource;
use App\Http\Resources\Cat3Resources\StoreCat3Resource;
use App\Http\Resources\Cat3Resources\UpdateCat3Resource;
use \App\Repository\Cat3Repository\Cat3RepositoryInterface;
use \App\Repository\Services\Helpers;
use App\Repository\Services\PaginationResource;
use App\Repository\Services\UploadImage;

class Cat3Controller extends Controller
{

    use UploadImage;

     /**
     * @varCat3RepositoryInterface
     */
    protected $Cat3;

    public function __construct( Cat3RepositoryInterface $Cat3){

        $this->Cat3 = $Cat3;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $Cat3= $this->Cat3->index();
         return Helpers::isArrayReturn(
         $Cat3,Helpers::returnRequest(
          new PaginationResource($Cat3
          ,IndexCat3Resource::collection($Cat3))),'نتیجه ای یافت نشد');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCat3Request $request)
    {
        $requestValid=$request->validated();
        $requestValid['image']= $this->storeImage($request->file('image'));
        $Cat3= $this->Cat3->create($requestValid);
        return Helpers::isReturn($Cat3,
         Helpers::returnRequest(new StoreCat3Resource($Cat3)),'نتیجه ای یافت نشد');

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
    public function update(UpdateCat3Request $request, $id)
    {
            $Cat3=$this->Cat3->find($id);
           return ($Cat3)? Helpers::isReturn($this->Cat3->update($request->validated(),$id),
               Helpers::returnRequest(new UpdateCat3Resource($Cat3)),' ویرایش نشد'):
               Helpers::notFindRequest('نتیجه ای یافت نشد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
               return Helpers::isReturn($this->Cat3->destroy($id),
                 Helpers::returnRequest( $this->Cat3->destroy($id)),' خذف نشد');
    }
}
