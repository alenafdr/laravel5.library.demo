<?php
namespace App\Http\Controllers\Api\v1\Traits;

trait RestDestroyTrait {
    
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    try {
      $model = self::$model;
      $model::findOrFail($id)->delete();
      return $this->send_ok($id);
    } catch (\Exception $e) {
      return $this->send_error($e->getMessage());
    }
  }
  
}