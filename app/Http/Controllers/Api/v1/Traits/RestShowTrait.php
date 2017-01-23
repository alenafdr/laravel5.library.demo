<?php
namespace App\Http\Controllers\Api\v1\Traits;

trait RestShowTrait {
    
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) 
	{
    try {
      $model = self::$model;
      return $this->send_ok($model::with(self::$model_with)->findOrFail($id));
    } catch (\Exception $e) {
      return $this->send_error($e->getMessage());
    }
	}
  
}