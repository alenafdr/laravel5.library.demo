<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

use App\Models\User as Model;

class UserController extends \App\Http\Controllers\Controller
{
  
  /**
   * Правила проверки для "store"
   */
  protected $store_validate = [
    'name'  => 'required|string',
    'email' => 'required|string'
  ];
  
  /**
   * Правила проверки для "update"
   */
  protected $update_validate = [
    'name'  => 'string',
    'email' => 'string'
  ];
  
  /**
   * Отправка "хорошего" JSON ответа
   */
  protected function send_ok($data) {
    return response()->json([
      'success' => true,
      'data'    => $data
    ], 200);
  }
  
  /**
   * Отправка "плохого" JSON ответа
   */
  protected function send_error($message) {
    return response()->json([
      'success' => true,
      'error'   => $message
    ], 400);
  }
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
	{
    try {
      return $this->send_ok(Model::all());
    } catch (\Exception $e){
      return $this->send_error($e->getMessage());
    }
	}
  
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) 
	{
    try {
      return $this->send_ok(Model::findOrFail($id));
    } catch (\Exception $e) {
      return $this->send_error($e->getMessage());
    }
	}
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
     
  public function store(Request $request)
  {
    try {
      $this->validate($request, $this->store_validate);
      return $this->send_ok(Model::create($request->all()));
    } catch (\Exception $e) {
      return $this->send_error($e->getMessage());
    }
  }
  
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
      $this->validate($request, $this->update_validate);
      $item = Model::findOrFail($id);
      $item->update($request->all());
      return $this->send_ok($item);
    } catch (\Exception $e) {
      return $this->send_error($e->getMessage());
    }
  }
    
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    try {
      Model::findOrFail($id)->delete();
      return $this->send_ok($id);
    } catch (\Exception $e) {
      return $this->send_error($e->getMessage());
    }
  }
}