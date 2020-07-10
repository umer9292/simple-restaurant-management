<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\Item;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany('App\item');
    }
}
