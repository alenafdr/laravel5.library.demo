<?php
namespace App\Http\Controllers\Api\v1\Traits;

trait RestIndexTrait {
    
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
	{
    try {
      $model = self::$model;
      return $this->send_ok($model::with(self::$model_with)->get());
    } catch (\Exception $e){
      return $this->send_error($e->getMessage());
    }
	}
  
}