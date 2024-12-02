<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ruangan', [
            // Menggunakan paginate untuk mendukung pagination
            'ruangans' => Ruangan::paginate(10),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.createruangan');
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
            'lokasi' => 'required|integer|min:1',
        ]);

        try {
            // Buat ruangan baru
            $ruangan = new Ruangan();
            $ruangan->nama_ruangan = $request->nama;
            $ruangan->lokasi_ruangan = $request->lokasi;
            $ruangan->save();

            // Redirect kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dibuat.');
        } catch (\Exception $e) {
            // Redirect kembali ke halaman sebelumnya dengan pesan error
            return redirect()->route('ruangan.index')->with('error', 'Terjadi kesalahan saat membuat ruangan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function show(Ruangan $ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ruangan = Ruangan::find($id);
        return view('forms.editruangan', compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|integer|min:1',
        ]);

        try {
            // Update ruangan
            $ruangan = Ruangan::findOrFail($id);
            $ruangan->nama_ruangan = $request->nama;
            $ruangan->lokasi_ruangan = $request->lokasi;
            $ruangan->save();

            // Redirect kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil diubah.');
        } catch (\Exception $e) {
            // Redirect kembali ke halaman sebelumnya dengan pesan error
            return redirect()->route('ruangan.index')->with('error', 'Terjadi kesalahan saat mengubah ruangan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();
        return redirect('/ruangan')->with('success', 'Ruangan berhasil dihapus.');
    }
}
