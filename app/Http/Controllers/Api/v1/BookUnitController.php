<?php

namespace App\Http\Controllers\Api\v1;

class BookUnitController extends \App\Http\Controllers\Controller
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
  private static $model = 'App\Models\BookUnit';
  
  /**
   * Правила проверки для "store"
   */
  private static $store_validate = [
    'barcode' => 'required|string',
    'book_id' => 'required|integer'
  ];
  
  /**
   * Правила проверки для "update"
   */
  private static $update_validate = [
    'barcode' => 'string',
    'book_id' => 'integer'
  ];
  
  /**
   * Список нетерпеливой загрузки
   */
  private static $model_with = [
    'book'
  ];
  
}