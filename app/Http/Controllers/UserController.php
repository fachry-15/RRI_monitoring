<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = User::paginate(10);
        return view('pegawai', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('forms.createakun', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|max:20',
            'role' => 'required'
        ]);

        try {
            $user = new User();
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            $user->syncRoles($request->role);

            return redirect()->route('pegawai.index')->with('success', 'Akun berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->route('pegawai.index')->with('error', 'Terjadi kesalahan saat membuat akun: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Ambil user berdasarkan ID
        $roles = Role::pluck('name', 'id'); // Ambil semua role (id dan name)
        $userRole = $user->roles->pluck('id')->first(); // Ambil ID role user (asumsi satu role per user)
    
        return view('forms.editakun', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:6', // Password opsional
        'role' => 'required|exists:roles,id',
    ]);

    $user = User::findOrFail($id);

    $user->update([
        'name' => $request->nama,
        'email' => $request->email,
        'password' => $request->password ? bcrypt($request->password) : $user->password, // Hanya update password jika diisi
    ]);

    // Sync role
    $user->syncRoles([$request->role]);

    return redirect()->route('pegawai.index')->with('success', 'Akun pegawai berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Cari user berdasarkan ID
    
        // Hapus role terkait
        $user->syncRoles([]); // Kosongkan role user (opsional, tergantung kebutuhan)
    
        // Hapus user
        $user->delete();
    
        return redirect()->route('pegawai.index')->with('success', 'Akun pegawai berhasil dihapus.');
    }
}
