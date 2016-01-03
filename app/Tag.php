<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    protected $fillable = [
        'name'
    ];
    
    /**
     * Get the article associated with the given tag.
     * 
     * @return type
     */
    public function adverts() {
        return $this->belongsToMany('App\Adverts');
    }
}
