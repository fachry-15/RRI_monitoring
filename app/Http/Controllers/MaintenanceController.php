<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil data maintenance
        $maintenance = maintenance::with('barang')->paginate(10);

        return view('maintenance', compact('maintenance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil data barang
        $barangs = barang::all();

        return view('forms.createmaintenance', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_ticket' => 'required|string',
            'barang' => 'required|string|max:255',
            'jenis_perawatan' => 'required|string',
            'diagnosa' => 'required|string',
            'deskripsi' => 'required|string',
            'NotaDinas' => 'required|mimes:pdf|max:2048', // Validasi file PDF
        ]);

        try {
            // Simpan file Nota Dinas
            if ($request->hasFile('NotaDinas')) {
                $file = $request->file('NotaDinas');
                $filename = $request->input('kode_ticket') . '.' . $file->getClientOriginalExtension();
                $path = 'berkas/NotaDinasMaintenance/' . $filename;

                // Simpan file ke direktori public
                $file->move(public_path('berkas/NotaDinasMaintenance'), $filename);
            }

            // Simpan data ke database
            $ticket = new maintenance();
            $ticket->kode_ticket = $request->input('kode_ticket');
            $ticket->barang_id = $request->input('barang');
            $ticket->jenis = $request->input('jenis_perawatan');
            $ticket->diagnosa = $request->input('diagnosa');
            $ticket->deskripsi = $request->input('deskripsi');
            $ticket->lampiran = $path ?? null; // Simpan path file jika ada
            $ticket->save();

            // Redirect dengan pesan sukses
            return redirect()->route('maintenance.index')->with('success', 'Berhasil membuat ticket maintenance');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal membuat ticket maintenance: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function show(maintenance $maintenance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Ambil data maintenance berdasarkan ID
        $ticket = maintenance::find($id);
        $barangs = barang::all();

        return view('forms.editmaintenance', compact('ticket', 'barangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'kode_ticket' => 'required|string',
            'barang' => 'required|string|max:255',
            'jenis_perawatan' => 'required|string',
            'diagnosa' => 'required|string',
            'deskripsi' => 'required|string',
            'NotaDinas' => 'mimes:pdf|max:2048', // Validasi file PDF
        ]);

        try {
            // Simpan file Nota Dinas
            if ($request->hasFile('NotaDinas')) {
                $file = $request->file('NotaDinas');
                $filename = $request->input('kode_ticket') . '.' . $file->getClientOriginalExtension();
                $path = 'berkas/NotaDinasMaintenance/' . $filename;

                // Simpan file ke direktori public
                $file->move(public_path('berkas/NotaDinasMaintenance'), $filename);
            }

            // Update data maintenance
            $ticket = maintenance::find($id);
            $ticket->kode_ticket = $request->input('kode_ticket');
            $ticket->barang_id = $request->input('barang');
            $ticket->jenis = $request->input('jenis_perawatan');
            $ticket->diagnosa = $request->input('diagnosa');
            $ticket->deskripsi = $request->input('deskripsi');
            $ticket->lampiran = $path ?? $ticket->lampiran; // Simpan path file jika ada
            $ticket->save();

            // Redirect dengan pesan sukses
            return redirect()->route('maintenance.index')->with('success', 'Berhasil mengubah ticket maintenance');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal mengubah ticket maintenance: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Hapus data maintenance berdasarkan ID
            $maintenance = maintenance::find($id);
            $maintenance->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('maintenance.index')->with('success', 'Berhasil menghapus ticket maintenance');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal menghapus ticket maintenance: ' . $e->getMessage());
        }
    }
}
