<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table ='Book';

    protected $guarded = ['id'];

    public function Status()
    {
        return $this->belongsTo(Status::class);
    }
    public function User()
    {
        return $this->belongsToMany(User::class);
    }
}
