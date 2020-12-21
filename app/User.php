<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Role;
use Illuminate\Support\Facades\Hash;

use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password', 'gambar', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @param string|array $roles
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || 
                    abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) || 
                abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    static function storeUser($request)
    {
        $user = User::create([
            'username'  => $request->nim,
            'name'      => $request->nama,
            'password'  => Hash::make($request->nim)
        ]);
        $role = $user->roles()
                     ->attach(Role::where('name', 'peserta')->first());
        
        return $user;
    }

    static function getUser()
    {
        $users = User::select('id')->get();
        
        if ($users->isNotEmpty()) {
            foreach ($users as $key => $value) {
                $data[$key] = User::firstUser($value->id);
                $data[$key]['roles'] = ListRole::getRoles($value->id);
            }
            
            return $data;
        }

        return $users;
    }

    static function getUserRole($id)
    {
        return User::join('list_roles', 'users.id', 'list_roles.user_id')
                    ->select('users.id as id', 'username', 'name')
                    ->where('list_roles.role_id', $id)
                    ->get();
    }

    static function getlistPeserta($id)
    {
        return User::join('list_roles', 'users.id', 'list_roles.user_id')
                    ->select('users.id as id', 'username', 'name')
                    ->where('list_roles.role_id', 3)
                    ->where('users.id', '!=', $id)
                    ->get();
    }

    static function getDosen()
    {
        return User::join('role_user', 'users.id', 'role_user.user_id')
                    ->select('users.id as id', 'username as nidn', 'name')
                    ->where('role_user.role_id', 2)->get();
    }

    static function firstUsername($username, $id)
    {
        return User::where('username', $username)
                        ->where('id', '!=', $id)
                        ->first();
    }

    static function firstUsernameAktif($username, $id)
    {
        return User::where('username', $username)
                        ->where('id', '!=', $id)
                        ->where('status', 1)
                        ->first();
    }

    static function firstUser($id)
    {
        $user = User::select('id', 'username', 'name', 'gambar', 'status')
                    ->whereId($id)
                    ->first();
        $user['roles'] = ListRole::getRoles($id);

        return $user;
    }

    static function deleteUser($id)
    {
        User::whereId($id)->delete();
    }

    static function getPengampu()
    {
        return User::join('list_roles', 'users.id', 'list_roles.user_id')
                    ->select('users.id', 'users.username', 'users.name')
                    ->where('list_roles.role_id', 2)
                    ->get();
    }

    static function updatePassword($id, $password)
    {
        User::whereId($id)->update([
            'password'  => Hash::make($password)
        ]);
    }

    static function updateStatus($id)
    {
        User::whereId($id)->update([
            'status' => 1
        ]);
    }
}
