<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    //
    protected $guarded = [];

    public function estate(){
        return $this->belongsTo('App\Estate');
    }
}
