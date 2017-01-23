<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BooksInHand extends Model
{
  
  use Relations\BelongsTo\User;
  use Relations\BelongsTo\BookUnit;
  
  protected $fillable = [
    'book_unit_id', 'user_id', 'take_at', 'return_at'
  ];
  
  public function getReturnAtAttribute($value)
  {
    return ($value === '2000-01-01 00:00:00') ? null : $value;
  }
  
  public function setReturnAtAttribute($value)
  {
    if (is_null($value) || $value === '') {
      $this->attributes['return_at'] = '2000-01-01 00:00:00';
    } else {
      $this->attributes['return_at'] = $value;
    }
  }
    
  /*  
  public static function boot() {
      parent::boot();

      static::creating(function($model){
          foreach ($model->attributes as $key => $value) {
              $model->{$key} = empty($value) ? null : $value;
          }
      });

      static::updating(function($model){
          foreach ($model->attributes as $key => $value) {
              $model->{$key} = empty($value) ? null : $value;
          }
      });

  }
  */
  
}
