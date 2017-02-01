<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoryWriter extends Model
{
    protected $fillable = ['story_id', 'user_id', 'on_turn', 'round'];

    public function story()
    {
    	return $this->belongsTo('App\Story', 'story_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
