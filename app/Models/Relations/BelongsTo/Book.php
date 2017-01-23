<?php
namespace App\Models\Relations\BelongsTo;

trait Book
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
      return $this->belongsTo('App\Models\Book');
    }
}
