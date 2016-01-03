<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Adverts extends Model
{
    protected $fillable = [
        'title',
        'user_id',
        'content',
        'contact',
        'expired_at'
    ];
    
    protected $dates = ['expired_at'];
    
    public function scopeNotExpired($query) {
        $query->where('expired_at', '>=', Carbon::now());
    }
    
    public function scopeExpired($query) {
        $query->where('expired_at', '<=', Carbon::now());
    }
    
    public function setExpiredAtAttribute($date) {
        $this->attributes['expired_at'] = Carbon::parse($date);
    }
    
    /**
     * Relacja
     * @return type
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function tags() {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
    
    public function getTagsListAttribute() {
        return $this->tags->lists('id')->all();
    }
}
