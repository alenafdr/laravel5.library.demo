<?php
namespace App\Http\Controllers\Api\v1\Traits;

trait RestTransportTrait {
    
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
  
}