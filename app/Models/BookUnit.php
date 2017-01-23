<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookUnit extends Model
{
  use Relations\BelongsTo\Book;
  
  protected $fillable = [
    'barcode', 'book_id'
  ];
  
  public function history()
  {
    return $this->hasMany('App\Models\BooksInHand')->where('return_at', '<>', '2000-01-01 00:00:00');
  }
  
  public function hands() {
    return $this->hasMany('App\Models\BooksInHand')->where('return_at', '=', '2000-01-01 00:00:00');
  }
  
}
