<?php
namespace App\Http\Controllers\Api\v1\Traits;

use Illuminate\Http\Request;
//use Illuminate\Validation\Validator;

trait RestUpdateTrait {
    
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    try {
      $model = self::$model;
      $validate = self::$update_validate;
      
      $this->validate($request, $validate);
      $item = $model::findOrFail($id);
      $item->update($request->all());
      return $this->send_ok($model::with(self::$model_with)->findOrFail($item->id));
    } catch (\Exception $e) {
      return $this->send_error($e->getMessage());
    }
  }
  
}