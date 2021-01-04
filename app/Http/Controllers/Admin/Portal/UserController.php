<?php

namespace App\Http\Controllers\Admin\Portal;

use App\Http\Controllers\Controller;
use App\DataDiri;
use App\ListRole;
use App\Role;
use App\User;
use DB;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use App\ImportUser;
use App\Imports\UsersImport;

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
        $roles = Role::getRoles();
        return view('admin.user.index', compact('data', 'roles'));
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
        $data = User::firstUsername($request->nim, 0);
        if (isset($data)) {
            return back()->with('danger', 'NIM/NIDN telah terdaftar');
        }

        $user = User::storeUser($request);
        DataDiri::storeDataDiri($request, $user->id);
        ListRole::storeRole($user->id, $request->role);

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
        if (isset($request->name)) {
            $user = User::firstUsername($request->username, $dataDiri);

            if (isset($user)) {
                return back()->with('danger', 'NIM/NIDN telah terdaftar'); 
            } else {
                User::updateUser($dataDiri, $request->username, $request->name);

                return back()->with('success', 'Data User berhasil diubah'); 
            }
        }

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
        ListRole::destroyRoles($listRole);

        return back()->with('danger', 'User dihapus');
    }

    public function role(Request $request, $id)
    {
        ListRole::createRoles($request->role, $id);

        $role = ListRole::firstRoleId($id);
        DB::table('role_user')
            ->where('user_id', $id)
            ->update(['role_id' => $role->role_id]);

        return back()->with('success', 'Role berhasil diperbarui');
    }

    public function showRole($id)
    {
        return json_encode(User::firstUser($id));
    }

    public function import(Request $request)
    {
        ImportUser::truncate();

        // menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('assets/import/user/',$nama_file);
 
		// import data
		Excel::import(new UsersImport, public_path('/assets/import/user/'.$nama_file));
        
        $data = ImportUser::getImportUser();
        foreach ($data as $key => $value) {
            if ($value->no_induk != null) {
                if (User::firstUsername($value->no_induk, 0) == null) {
                    if ($value->nama == null) {
                        $value->nama = "Nama User";
                    }

                    $value->nim = $value->no_induk;
                    $user = User::storeUser($value);
                    ListRole::create([
                        'role_id' => 3,
                        'user_id' => $user->id
                    ]);

                    if ($value->jenis_kelamin == null || $value->jenis_kelamin == "Laki-laki") {
                        $value->jeniskelamin = 1;
                    } else {
                        $value->jeniskelamin = 2;
                    }

                    DataDiri::storeDataDiri($value, $user->id);
                }
            }
        }

        return back()->with('success', 'User berhasil diupload');
    }
}
