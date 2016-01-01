<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Adverts extends Model
{
    protected $fillable = [
        'title',
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
        $this->attributes['expired_at'] = Carbon::createFromFormat('Y-m-d', $date);
    }
}
