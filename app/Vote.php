<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'ip',
        'vote',
    ];
    protected $guarded = [
        'id'
    ];
}
