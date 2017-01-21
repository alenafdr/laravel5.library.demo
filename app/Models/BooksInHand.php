<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BooksInHand extends Model
{
  
  protected $fillable = [
    'book_unit_id', 'user_id', 'take_at', 'return_at'
  ];
  
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

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }
  
  public function bookUnit()
  {
    return $this->belongsTo('App\Models\BookUnit');
  }
  
}
