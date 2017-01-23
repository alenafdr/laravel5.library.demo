<?php
namespace App\Models\Relations\HasMany;

trait BookUnits
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function units()
    {
      return $this->hasMany('App\Models\BookUnit');
    }
}
