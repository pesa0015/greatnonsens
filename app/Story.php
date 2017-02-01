<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = ['title', 'slug', 'rounds', 'max_writers', 'num_of_writers', 'status', 'user_id'];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
