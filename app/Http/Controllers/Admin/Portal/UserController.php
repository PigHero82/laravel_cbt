<?php

namespace App\Http\Controllers\Admin\Portal;

use App\Http\Controllers\Controller;
use App\DataDiri;
use App\ListRole;
use App\Role;
use App\User;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::getUser();
        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::storeUser($request);
        DataDiri::storeDataDiri($request, $user->id);
        ListRole::storeRole($user->id, 3);

        return back()->with('success', 'User berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ListRole  $listRole
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::firstUser($id);
        $info = DataDiri::firstDataDiri($id);
        $roles = Role::getRoles();

        return view('admin.user.show', compact('data', 'info', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ListRole  $listRole
     * @return \Illuminate\Http\Response
     */
    public function edit(ListRole $listRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ListRole  $listRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dataDiri)
    {
        if (isset($request->password)) {
            User::updatePassword($dataDiri, $request->password);

            return back()->with('success', 'Password berhasil diubah');
        }
        
        if(isset($request->status)) {
            $user = User::firstUsernameAktif($request->username, $dataDiri);
            if (isset($user)) {
                return back()->with('danger', 'NIM/NIDN telah terdaftar');
            }
            User::updateStatus($dataDiri);
            DataDiri::firststoreDataDiri($dataDiri);

            return back()->with('success', 'User diterima, User berhasil ditambah');
        }
        
        DataDiri::updateDataDiri($request, $dataDiri);

        return redirect()->back()->with('success', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ListRole  $listRole
     * @return \Illuminate\Http\Response
     */
    public function destroy($listRole)
    {
        User::deleteUser($listRole);
        Role::deleteRole($listRole);
        ListRole::destroyRoles($listRole);

        return back()->with('danger', 'User ditolak');
    }

    public function role(Request $request, $id)
    {
        ListRole::createRoles($request->role, $id);
        
        $role = ListRole::firstRole($request->user_id, $id);
        DB::table('role_user')
            ->where('user_id', $id)
            ->update(['role_id' => $role->role_id]);

        return back()->with('success', 'Role berhasil diperbarui');
    }

    public function showRole($id)
    {
        return json_encode(User::firstUser($id));
    }
}
