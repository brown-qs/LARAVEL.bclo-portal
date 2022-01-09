<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    //
    // protected $fillable = ['user_id','land_id','is_paid','has_mailbox','phone', 'email', 'first_last_name', 'first_name', 'address'];

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function accrequests(){
        return $this->hasMany('App\Accrequest');
    }
    public function letters(){
        return $this->hasMany('App\Letter');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function payments(){
        return $this->hasMany('App\Payment');
    }
    public function credits(){
        return $this->hasMany('App\Credit');
    }
}
