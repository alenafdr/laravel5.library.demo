<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\BookUnit;

class Book extends Model
{
  
  protected $fillable = [
    'name', 'autor', 'description'
  ];
  
  public function units()
  {
    return $this->hasMany('App\Models\BookUnit');
  }
 
}
