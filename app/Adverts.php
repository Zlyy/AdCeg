<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adverts extends Model
{
    protected $fillable = [
        'title',
        'content',
        'contact',
        'expired_at'
    ];
}
