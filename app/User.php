<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Role;
use Illuminate\Support\Facades\Hash;

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

    static function storeMahasiswa($request)
    {
        User::create([
            'username'  => $request->nim,
            'name'      => $request->nama,
            'password'  => Hash::make($request->nim)
        ])
            ->roles()
            ->attach(Role::where('name', 'mahasiswa')->first());
    }

    static function storeDosen($request)
    {
        User::create([
            'username'  => $request->nidn,
            'name'      => $request->nama,
            'password'  => Hash::make($request->nidn)
        ])
            ->roles()
            ->attach(Role::where('name', 'dosen')->first());
    }

    static function getMahasiswa()
    {
        return User::join('role_user', 'users.id', 'role_user.user_id')
                    ->select('users.id as id', 'username as nim', 'name')
                    ->where('role_user.role_id', 3)->get();
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

    static function firstUser($id)
    {
        return User::select('id', 'username', 'name', 'gambar')
                    ->whereId($id)
                    ->first();
    }

    static function deleteUser($id)
    {
        User::whereId($id)->delete();
    }
}
