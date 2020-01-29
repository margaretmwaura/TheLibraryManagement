<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $table = 'status';
    protected $fillable = [
        'name',
    ];

    public function Book()
    {
        return $this->hasMany(Book::class);
    }
}
