<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'text',
        'name',
        'note_id',
        'sub_id',
    ];
    protected $guarder = [
        'id',
    ];
}
