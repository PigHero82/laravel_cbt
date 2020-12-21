<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    static function getRoles()
    {
        return Role::all();
    }

    static function deleteRole($id)
    {
        Role::whereId($id)->delete();
    }
}
