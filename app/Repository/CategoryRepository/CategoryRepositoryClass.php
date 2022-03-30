<?php

namespace App\Repository\CategoryRepository;

 use App\Models\Category;
 use App\Repository\Services\Filter\Filters\DateFrom;
 use App\Repository\Services\Filter\Filters\DateTo;
 use Illuminate\Pipeline\Pipeline;
 use App\Repository\Services\Helpers;

class CategoryRepositoryClass implements CategoryRepositoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= Category::query();
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
       return Helpers::resultExist(Category::create($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::where('id',$id)->first();
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
        $deleted=$this->show($id);
        return ($deleted)?$deleted->delete():false;

//      return  Helpers::resultExist($deleted);


    }
}
