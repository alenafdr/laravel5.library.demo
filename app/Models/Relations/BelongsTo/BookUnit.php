<?php
namespace App\Models\Relations\BelongsTo;

trait BookUnit
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookUnit()
    {
      return $this->belongsTo('App\Models\BookUnit');
    }
}
