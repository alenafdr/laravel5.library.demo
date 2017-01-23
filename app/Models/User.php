<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function books()
    {
      return $this->hasMany('App\Models\BooksInHand');
    }
    
    public function bookHistory()
    {
      return $this->hasMany('App\Models\BooksInHand')->where('return_at', '<>', '2000-01-01 00:00:00');
    }
    
    public function bookInHand()
    {
      return $this->hasMany('App\Models\BooksInHand')->where('return_at', '=', '2000-01-01 00:00:00');
    }
}
