<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\Category;

class Item extends Model
{
    protected $table = 'items';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
