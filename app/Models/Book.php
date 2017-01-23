<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  use Relations\HasMany\BookUnits;
  
  protected $fillable = [
    'name', 'autor', 'description'
  ];
 
}
