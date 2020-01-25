<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $table = 'Department';
    protected $fillable = [
        'name',
    ];

    public function Users()
    {
        return $this->hasMany(User::class);
    }
}
