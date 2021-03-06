<?php

namespace App\Repository\Services;
use Illuminate\Pipeline\Pipeline;

class Helpers{

    public static function pipeline(array $filter,$paginateCount,$model){
        return app(Pipeline::class)
            ->send($model)
            ->through($filter)->thenReturn()->paginate($paginateCount);
    }
    public static function resultExist($value) {
        return $value ?  $value :false;
    }
    public static function isArrayReturn($model, $return, $message, $getCodeRequest=200)
    {
        return ($model->isNotEmpty()) ?
            $return : self::errorRequest($message,$getCodeRequest);
    }
    public static function isReturn($model, $return, $message, $getCodeRequest=200)
    {
        return ($model) ?
            $return : self::errorRequest($message,$getCodeRequest);
    }
    public static function  returnRequest($request,$getCodeRequest=200){
        return response()->json([
            'success'=>true,
            'data'=> $request,
        ],$getCodeRequest);

    }
    public static function  returnDestroy($request,$getCodeRequest=200){

        return response()->json([
            'success'=>($request)?true:false,
        ],$getCodeRequest);

    }
    public static function errorRequest($message,$getCodeRequest=200){
        return response()->json([
            'success'=>false,
            'message' => $message
        ],$getCodeRequest);
    }
    public static function notFindRequest($getCodeRequest=200){
        return response()->json([
            'success'=>true,
            'message' => []
        ],$getCodeRequest);
    }
}