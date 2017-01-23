<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\BooksInHand as Model;

class BooksInHandController extends \App\Http\Controllers\Controller
{
  
  use Traits\RestTransportTrait;
  use Traits\RestIndexTrait;
  use Traits\RestShowTrait;
  use Traits\RestStoreTrait;
  use Traits\RestUpdateTrait;
  use Traits\RestDestroyTrait;
  
  /**
   * С какой моделью будем работать
   */
  private static $model = 'App\Models\BooksInHand';
  
  /**
   * Правила проверки для "store"
   */
  private static $store_validate = [
    'book_unit_id' => 'required|integer',
    'user_id'      => 'required|integer',
    'take_at'      => 'string|nullable',
    'return_at'    => 'string|nullable'
  ];
  
  /**
   * Правила проверки для "update"
   */
  private static $update_validate = [
    'book_unit_id' => 'integer',
    'user_id'      => 'integer',
    'take_at'      => 'string|nullable',
    'return_at'    => 'string|nullable'
  ];
  
  /**
   * Список нетерпеливой загрузки
   */
  private static $model_with = [
    'user',
    'bookUnit.book',
  ];
  
  // Для $item дозаполняем связи
  // $item->user;
  // $item->bookUnit;
  // $item->bookUnit->book;
  
  
  /**
   * Статистика по самым читающим читателям
   *
   * @return \Illuminate\Http\Response
  */
  public function statistics()
  {
    try {
      $model = self::$model;
      $items = $model::select('user_id', \DB::raw('count(*) as count'))
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
      $model = self::$model;
      $items = $model::where('user_id', '=', $id)->where('return_at', '=', '2000-01-01 00:00:00')->get();
      
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