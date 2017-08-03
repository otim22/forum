<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];
    /**
     * @return url
     */
    public function path()
    {
        return '/threads/' .$this->id;
    }

    /**
     * @return hasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * @return belongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return many to many relationship
     */
    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }
}
