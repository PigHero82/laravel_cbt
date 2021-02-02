<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $fillable = ['role_id', 'user_id'];
    public $timestamps = false;

    static function storeRole($id, $roleId)
    {
        RoleUser::where('user_id', $id)->create(['role_id' => $roleId]);
    }

    static function updateRole($id, $roleId)
    {
        RoleUser::where('user_id', $id)->update(['role_id' => $roleId]);
    }

    public static function updateRoleUser($id_dosen)
    {
        $getrole = ListRole::firstWhere('user_id', $id_dosen);
        $update_roleuser = RoleUser::firstWhere('user_id', $id_dosen);
        $update_roleuser->role_id = $getrole->role_id;
        $update_roleuser->save();
    }
}
