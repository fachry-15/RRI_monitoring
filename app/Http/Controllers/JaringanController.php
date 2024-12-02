<?php

namespace App\Http\Controllers;

use App\Models\jaringan;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class JaringanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jaringans = jaringan::paginate(10);
        $ruangans = jaringan::with('ruangan')->get();
        return view('jaringan', compact('jaringans', 'ruangans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.createjaringan', [
            'ruangans' => Ruangan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'ruangan' => 'required|integer|min:1',
            'ip' => 'required|ipv4',
            'upload' => 'required|integer|min:1',
            'download' => 'required|integer|min:1',
        ]);

        try {
            // Buat jaringan baru
            $jaringan = new jaringan();
            $jaringan->nama_router = $request->nama;
            $jaringan->ruangan_id = $request->ruangan;
            $jaringan->ip_router = $request->ip;
            $jaringan->upload = $request->upload;
            $jaringan->download = $request->download;
            $jaringan->save();

            // Redirect kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->route('jaringan.index')->with('success', 'Jaringan berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Redirect kembali ke halaman sebelumnya dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jaringan  $jaringan
     * @return \Illuminate\Http\Response
     */
    public function show(jaringan $jaringan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jaringan  $jaringan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('forms.editjaringan', [
            'jaringan' => jaringan::find($id),
            'ruangans' => Ruangan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jaringan  $jaringan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'ruangan' => 'required|integer|min:1',
            'ip' => 'required|ipv4',
            'upload' => 'required|integer|min:1',
            'download' => 'required|integer|min:1',
        ]);

        try {
            // Cari jaringan berdasarkan ID
            $jaringan = jaringan::find($id);
            $jaringan->nama_router = $request->nama;
            $jaringan->ruangan_id = $request->ruangan;
            $jaringan->ip_router = $request->ip;
            $jaringan->upload = $request->upload;
            $jaringan->download = $request->download;
            $jaringan->save();

            // Redirect kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->route('jaringan.index')->with('success', 'Jaringan berhasil diubah.');
        } catch (\Exception $e) {
            // Redirect kembali ke halaman sebelumnya dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jaringan  $jaringan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Cari jaringan berdasarkan ID
            $jaringan = jaringan::find($id);
            $jaringan->delete();

            // Redirect kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->route('jaringan.index')->with('success', 'Jaringan berhasil dihapus.');
        } catch (\Exception $e) {
            // Redirect kembali ke halaman sebelumnya dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
