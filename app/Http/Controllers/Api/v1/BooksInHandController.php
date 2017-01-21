<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

use App\Models\BooksInHand as Model;

class BooksInHandController extends \App\Http\Controllers\Controller
{
  
  /**
   * Правила проверки для "store"
   */
  protected $store_validate = [
    'book_unit_id' => 'required|integer',
    'user_id'      => 'required|integer',
    'take_at'      => 'string|nullable',
    'return_at'    => 'string|nullable'
  ];
  
  /**
   * Правила проверки для "update"
   */
  protected $update_validate = [
    'book_unit_id' => 'integer',
    'user_id'      => 'integer',
    'take_at'      => 'string|nullable',
    'return_at'    => 'string|nullable'
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
      'success' => false,
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
      $items = Model::all();
      foreach($items as $item) {
        // Для $item дозаполняем связи
        $item->user;
        $item->bookUnit;
        $item->bookUnit->book;
      }
      return $this->send_ok($items);
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
      $item = Model::findOrFail($id);
      // Для $item дозаполняем связи
      $item->user;
      $item->bookUnit;
      $item->bookUnit->book;
      return $this->send_ok($item);
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
      $item = Model::create($request->all());
      // Для $item дозаполняем связи
      $item->user;
      $item->bookUnit;
      $item->bookUnit->book;
      return $this->send_ok($item);
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
      // Для $item дозаполняем связи
      $item->user;
      $item->bookUnit;
      $item->bookUnit->book;
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
  
  /**
   * Статистика по самым читающим читателям
   *
   * @return \Illuminate\Http\Response
  */
  public function statistics()
  {
    try {
      $items = Model::select('user_id', \DB::raw('count(*) as count'))
                 ->groupBy('user_id')
                 ->orderBy('count','desc')
                 ->get();
      
      // Для дозаполняем связи
      foreach($items as $item) {
        $item->user;
      }
      
      return $this->send_ok($items);
    } catch (\Exception $e) {
      return $this->send_error($e->getMessage());
    }
  }
  
  /**
   * Книги на руках
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
  */
  public function inHand($id)
  {
    try {
      
      $items = Model::where('user_id', '=', $id)->where('return_at', '=', '2000-01-01 00:00:00')->get();
      
      foreach($items as $item) {
        // Для $item дозаполняем связи
        $item->user;
        $item->bookUnit;
        $item->bookUnit->book;
      }
      
      return $this->send_ok($items);
    } catch (\Exception $e) {
      return $this->send_error($e->getMessage());
    }
  }
  
}