<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'message',
        'name',
        'email'
    ];
    protected $guarder = [
        'id',
    ];
}
