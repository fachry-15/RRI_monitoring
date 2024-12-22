<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil data kategori
        $kategori = kategori::paginate(10);

        return view('kategori', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.createkategori');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validasi data
            $request->validate([
                'nama' => 'required|string|max:255',
                'deskripsi' => 'required|string|max:255',
            ]);

            // Buat kategori baru
            $kategori = new kategori();
            $kategori->nama = $request->nama;
            $kategori->deskripsi = $request->deskripsi;
            $kategori->save();

            return redirect('/kategori')->with('success', 'Kategori berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect('/kategori')->with('error', 'Kategori gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = kategori::findOrFail($id);
        return view('forms.editkategori', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Validasi data
            $request->validate([
                'nama' => 'required|string|max:255',
                'deskripsi' => 'required|string|max:255',
            ]);

            // Update kategori
            $kategori = kategori::find($id);
            $kategori->nama = $request->nama;
            $kategori->deskripsi = $request->deskripsi;
            $kategori->save();

            return redirect('/kategori')->with('success', 'Kategori berhasil diubah');
        } catch (\Throwable $th) {
            return redirect('/kategori')->with('error', 'Kategori gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Hapus kategori
            kategori::destroy($id);

            return redirect('/kategori')->with('success', 'Kategori berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('/kategori')->with('error', 'Kategori gagal dihapus');
        }
    }
}
