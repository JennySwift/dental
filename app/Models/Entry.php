<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = ['first_name', 'last_name', 'tooth_number', 'original_restoration_date', 'last_photo_date', 'restoration_age', 'note'];
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function restorationType()
    {
        return $this->belongsTo('App\Models\RestorationType');
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function folders()
    {
        return $this->belongsToMany('App\Models\Folder');
    }
}
