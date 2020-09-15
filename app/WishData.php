<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishData extends Model
{
    protected $table = 'wish_data';
    protected $fillable = [
        'img', 'name', 'description', 'price', 'link',
    ];
}
