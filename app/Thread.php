<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /**
     * @return url
     */
    public function path()
    {
        return '/threads/' .$this->id;
    }

    /**
     * @return many to many relationship
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
