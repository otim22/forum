<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];
    protected $with = ['creator', 'channel'];


    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder){
            $builder->withCount('replies');
        });

        static::deleting(function ($thread){
            $thread->replies()->delete();
        });
    }

    /**
     * @return url
     */
    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    /**
     * @return hasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function getReplyCountAttribute(){
        return $this->replies()->count();
    }

    /**
     * @return belongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return belongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * @return many to many relationship
     */
    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters){
        return $filters->apply($query);
    }
}
