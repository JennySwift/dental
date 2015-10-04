<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestorationType extends Model
{
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entries()
    {
        return $this->hasMany('App\Models\Entry');
    }
}
