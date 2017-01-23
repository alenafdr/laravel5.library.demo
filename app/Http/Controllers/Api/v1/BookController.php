<?php

namespace App\Http\Controllers\Api\v1;

class BookController extends \App\Http\Controllers\Controller
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
  private static $model = 'App\Models\Book';
  
  /**
   * Правила проверки для "store"
   */
  private static $store_validate = [
    'name'        => 'required|string',
    'autor'       => 'required|string',
    'description' => 'required|string'
  ];
  
  /**
   * Правила проверки для "update"
   */
  private static $update_validate = [
    'name'        => 'string',
    'autor'       => 'string',
    'description' => 'string'
  ];
  
  /**
   * Список нетерпеливой загрузки
   */
  private static $model_with = [];
  
}