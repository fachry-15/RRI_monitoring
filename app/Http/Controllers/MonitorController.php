<?php

namespace App\Http\Controllers;

use App\Models\jaringan;
use App\Models\monitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil data monitor dengan relasi ke tabel jaringan
        $monitor = Monitor::with('jaringan')->paginate(10);

        // Tentukan status stabil/tidak stabil berdasarkan perbandingan dengan data tabel jaringan
        foreach ($monitor as $data) {
            // Selisih antara upload di monitor dan jaringan
            $difference = $data->jaringan->upload - $data->upload;

            // Tentukan status kecepatan
            $data->status_kecepatan = $difference > 20 ? 'Tidak Stabil' : 'Stabil';
        }

        return view('monitor', compact('monitor'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jaringan = jaringan::with('ruangan')->get();
        return view('forms.createmonitor', compact('jaringan'));
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
                'router' => 'required|integer|min:1',
                'status' => 'required|string|max:255',
                'upload' => 'required|numeric|min:0',
                'download' => 'required|numeric|min:0',
                'petugas_id' => 'required|integer|min:1',
            ]);

            // Buat monitor baru
            $monitor = new monitor();
            $monitor->jaringan_id = $request->router;
            $monitor->kondisi = $request->status;
            $monitor->upload = $request->upload;
            $monitor->download = $request->download;
            $monitor->petugas_id = $request->petugas_id;
            $monitor->save();

            return redirect()->route('monitor.index')->with('success', 'Data monitor berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function show(monitor $monitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $monitor = monitor::findOrFail($id);
        $jaringan = jaringan::with('ruangan')->get();
        return view('forms.editmonitor', compact('monitor', 'jaringan'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'router' => 'required|integer|min:1',
            'status' => 'required|string|max:255',
            'upload' => 'required|numeric|min:0',
            'download' => 'required|numeric|min:0',
            'petugas_id' => 'required|integer|min:1',
        ]);

        try {
            // Update monitor
            $monitor = monitor::findOrFail($id);
            $monitor->jaringan_id = $request->router;
            $monitor->kondisi = $request->status;
            $monitor->upload = $request->upload;
            $monitor->download = $request->download;
            $monitor->petugas_id = $request->petugas_id;
            $monitor->save();

            return redirect()->route('monitor.index')->with('success', 'Data monitor berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    //buatkan fungsi untuk upaate status value nya disetujui



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = monitor::findOrFail($id);

        // Pastikan ID pengguna yang sedang login adalah pemilik data
        if ($data->petugas_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Mohon maaf anda tidak memiliki hak untuk menghapus data ini.');
        }

        // Hapus data
        $data->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('monitor.index')->with('success', 'Data berhasil dihapus.');
    }
}
