<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListRole extends Model
{
    protected $table = 'list_roles';
    protected $fillable = ['role_id', 'user_id'];
    public $timestamps = false;

    static function firstRole($id, $roleId)
    {
        return ListRole::select('list_roles.id', 'roles.description')
                        ->leftJoin('roles', 'list_roles.id', 'roles.id')
                        ->where('list_roles.user_id', $id)
                        ->where('list_roles.role_id', $roleId)
                        ->get();
    }

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

    static function getRole($id)
    {
        return ListRole::select('list_roles.role_id as id', 'roles.description')
                        ->leftJoin('roles', 'list_roles.role_id', 'roles.id')
                        ->where('list_roles.user_id', $id)
                        ->get();
    }

    static function storeRole($id, $role)
    {
        ListRole::create([
            'role_id' => $role,
            'user_id' => $id
        ]);
    }

    static function cekRole($id, $role)
    {
        return ListRole::where('user_id', $id)
                        ->where('role_id', $role)
                        ->first();
    }

    static function countbyRole()
    {
        return ListRole::select('role_id')
                        ->selectRaw('COUNT(role_id) as jumlah')
                        ->groupBy('role_id')
                        ->get();
    }
}
