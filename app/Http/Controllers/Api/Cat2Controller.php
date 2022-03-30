<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cat2Request\StoreCat2Request;
use App\Http\Requests\Cat2Request\UpdateCat2Request;
use App\Http\Resources\Cat2Resources\IndexCat2Resource;
use App\Http\Resources\Cat2Resources\StoreCat2Resource;
use App\Http\Resources\Cat2Resources\UpdateCat2Resource;
use \App\Repository\Cat2Repository\Cat2RepositoryInterface;
use \App\Repository\Services\Helpers;
use App\Repository\Services\PaginationResource;
use App\Repository\Services\UploadImage;

class Cat2Controller extends Controller
{

    use UploadImage;

     /**
     * @varCat2RepositoryInterface
     */
    protected $Cat2;

    public function __construct( Cat2RepositoryInterface $Cat2){

        $this->Cat2 = $Cat2;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $Cat2= $this->Cat2->index();
         return Helper::isArrayReturn(
         $Cat2,Helper::returnRequest(
          new PaginationResource($Cat2
          ,IndexCat2Resource::collection($Cat2))),'نتیجه ای یافت نشد');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCat2Request $request)
    {
        $requestValid=$request->validated();
        $requestValid['image']= $this->storeImage($request->file('image'));
        $Cat2= $this->Cat2->create($requestValid);
        return Helper::isReturn($Cat2,
         Helper::returnRequest(new StoreCat2Resource($Cat2)),'نتیجه ای یافت نشد');

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
    public function update(UpdateCat2Request $request, $id)
    {
            $Cat2=$this->Cat2->find($id);
           return ($Cat2)? Helper::isReturn($this->Cat2->update($request->validated(),$id),
               Helper::returnRequest(new UpdateCat2Resource($Cat2)),' ویرایش نشد'):
               Helper::notFindRequest('نتیجه ای یافت نشد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
               return Helper::isReturn($this->Cat2->destroy($id),
                 Helper::returnRequest( $this->Cat2->destroy($id)),' خذف نشد');
    }
}
