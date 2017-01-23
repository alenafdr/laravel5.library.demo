<?php
namespace App\Models\Relations\BelongsTo;

trait User
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }
}
