<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title', 'content', 'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function getAuthorAttribute(){
        return $this->user->name;
    }
}
