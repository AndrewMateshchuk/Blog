<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notation extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'text'
    ];
    protected $guarder = [
        'id',
    ];
}
