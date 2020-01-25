<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'roles';
    protected $fillable = [
        'name',
    ];

    public function Permission()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function Role()
    {
        return $this->hasOne(User::class);
    }
}
