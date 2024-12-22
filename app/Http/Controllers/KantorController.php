<?php

namespace App\Http\Controllers;

use App\Models\kantor;
use Illuminate\Http\Request;

class KantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil data kantor
        $kantor = kantor::paginate(10);

        return view('kantor', compact('kantor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.createkantor');
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
                'alamat' => 'required|string|max:255',
            ]);

            // Buat kantor baru
            $kantor = new kantor();
            $kantor->nama = $request->nama;
            $kantor->alamat = $request->alamat;
            $kantor->save();

            return redirect('/kantor')->with('success', 'Kantor berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect('/kantor')->with('error', 'Kantor gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kantor  $kantor
     * @return \Illuminate\Http\Response
     */
    public function show(kantor $kantor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kantor  $kantor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kantor = kantor::findOrfail($id);
        return view('forms.editkantor', compact('kantor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kantor  $kantor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Validasi data
            $request->validate([
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
            ]);

            // Update kantor
            $kantor = kantor::find($id);
            $kantor->nama = $request->nama;
            $kantor->alamat = $request->alamat;
            $kantor->save();

            return redirect('/kantor')->with('success', 'Kantor berhasil diubah');
        } catch (\Throwable $th) {
            return redirect('/kantor')->with('error', 'Kantor gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kantor  $kantor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Hapus kantor
            $kantor = kantor::find($id);
            $kantor->delete();

            return redirect('/kantor')->with('success', 'Kantor berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('/kantor')->with('error', 'Kantor gagal dihapus');
        }
    }
}
