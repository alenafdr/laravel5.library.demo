<?php
namespace App\Http\Controllers\Api\v1\Traits;

use Illuminate\Http\Request;
//use Illuminate\Validation\Validator;

trait RestStoreTrait {
    
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
     
  public function store(Request $request)
  {
    try {
      $model = self::$model;
      $validate = self::$store_validate;
      
      $this->validate($request, $validate);
      $id = $model::create($request->all())->id;
      return $this->send_ok($model::with(self::$model_with)->findOrFail($id));
    } catch (\Exception $e) {
      return $this->send_error($e->getMessage());
    }
  }
  
}