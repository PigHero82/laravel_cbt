<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListRole extends Model
{
    protected $table = 'list_roles';
    protected $fillable = ['role_id', 'user_id'];
    public $timestamps = false;

    static function getRoles($id)
    {
        return ListRole::select('list_roles.role_id', 'roles.description')
                        ->join('roles', 'list_roles.role_id', 'roles.id')
                        ->where('list_roles.user_id', $id)
                        ->get();
    }

    static function createRoles($roles, $id)
    {
        ListRole::destroyRoles($id);
        foreach ($roles as $key => $value) {
            ListRole::create([
                'role_id' => $value,
                'user_id' => $id
            ]);
        }
    }

    static function destroyRoles($id)
    {
        ListRole::where('user_id', $id)->delete();
    }
    
    static function firstRole($id)
    {
        return ListRole::where('user_id', $id)->first();
    }
}
