<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Models\BooksInHand;

class BookUnit extends Model
{
  
  protected $fillable = [
    'barcode', 'book_id'
  ];
  
  public function history()
  {
    return $this->hasMany('App\Models\BooksInHand')->where('return_at', '<>', NULL);
  }
  
  public function hands() {
    return $this->hasMany('App\Models\BooksInHand')->where('return_at', '=', NULL);
  }
  
  public function book()
  {
    return $this->belongsTo('App\Models\Book');
  }
}
