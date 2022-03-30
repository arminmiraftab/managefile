<?php

namespace App\Repository\Cat3Repository;

 use App\Models\Cat3;
 use App\Repository\Services\Filter\Filters\DateFrom;
 use App\Repository\Services\Filter\Filters\DateTo;
 use Illuminate\Pipeline\Pipeline;
 use App\Repository\Services\Helper;

class Cat3RepositoryClass implements Cat3RepositoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= Cat3::query();
         return app(Pipeline::class)->send($model)
         ->through([DateFrom::class,DateTo::class])
         ->thenReturn()->paginate(20);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
       return Helper::resultExist(Cat3::create($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Cat3::where('id',$id)->first();
    }
    /**
     * @param $id
     */
     public function find($id)
     {
        return die('not wor...');
     }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $id)
    {

      if($this->show($id)){$this->show($id)->update($data);return $this->show($id);}else{ return null;}

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return  Helper::resultExist($this->show($id)->delete());


    }
}
