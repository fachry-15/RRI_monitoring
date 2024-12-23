<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil data peminjaman
        $peminjaman = peminjaman::with('barang', 'user')
            ->where('status', 'sedang digunakan')
            ->paginate(10);
        $barangs = barang::all();

        return view('peminjaman', compact('peminjaman', 'barangs'));
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
        // Validasi data
        $validatedData = $request->validate([
            'barang' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'jam_mulai' => 'required|string|max:255',
            'jam_selesai' => 'required|string|max:255',
            'petugas' => 'required|integer',
        ]);

        // // Debugging input data
        // dd($validatedData);

        // Cek apakah barang sedang digunakan
        $cek = Peminjaman::where([
            'barang_id' => $validatedData['barang'],
            'status' => 'sedang digunakan',
        ])->first();

        if ($cek) {
            Log::info('Barang sedang digunakan', ['kode_barang' => $validatedData['barang']]);
            return redirect()->back()->with('error', 'Mohon maaf barang sedang digunakan saat ini.');
        }

        // Simpan data ke database
        $peminjaman = new Peminjaman();
        $peminjaman->barang_id = $validatedData['barang'];
        $peminjaman->status = 'sedang digunakan';
        $peminjaman->kegiatan = $validatedData['kegiatan'];
        $peminjaman->tanggal_pinjam = $validatedData['tanggal_kegiatan'];
        $peminjaman->jam_mulai = $validatedData['jam_mulai'];
        $peminjaman->jam_selesai = $validatedData['jam_selesai'];
        $peminjaman->user_id = $validatedData['petugas'];
        $peminjaman->tanggal_kembali = now();
        $peminjaman->save();

        return redirect()->back()->with('success', 'Barang berhasil dipinjam.');
    }

    public function storeauto(Request $request)
    {
        // Validasi data awal
        $validatedData = $request->validate([
            'barang' => 'required|string|max:255', // Masukkan kode barang
            'kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'jam_mulai' => 'required|string|max:255',
            'jam_selesai' => 'required|string|max:255',
            'petugas' => 'required|integer',
        ]);

        // Cari barang berdasarkan kode barang
        $barang = Barang::where('kode_barang', $validatedData['barang'])->first();

        if (!$barang) {
            // Jika barang tidak ditemukan, kembali dengan pesan error
            return redirect()->back()->with('error', 'Kode barang tidak valid.');
        }

        // Debugging untuk melihat data barang yang ditemukan
        // dd($barang);

        // Cek apakah barang sedang digunakan
        $cek = Peminjaman::where([
            'barang_id' => $barang->id,
            'status' => 'sedang digunakan',
        ])->first();

        if ($cek) {
            Log::info('Barang sedang digunakan', ['kode_barang' => $validatedData['barang']]);
            return redirect()->back()->with('error', 'Mohon maaf, barang sedang digunakan saat ini.');
        }

        // Simpan data ke database
        $peminjaman = new Peminjaman();
        $peminjaman->barang_id = $barang->id; // Gunakan ID barang
        $peminjaman->status = 'sedang digunakan';
        $peminjaman->kegiatan = $validatedData['kegiatan'];
        $peminjaman->tanggal_pinjam = $validatedData['tanggal_kegiatan'];
        $peminjaman->jam_mulai = $validatedData['jam_mulai'];
        $peminjaman->jam_selesai = $validatedData['jam_selesai'];
        $peminjaman->user_id = $validatedData['petugas'];
        $peminjaman->tanggal_kembali = now();
        $peminjaman->save();

        return redirect()->back()->with('success', 'Barang berhasil dipinjam.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(peminjaman $peminjaman)
    {
        //
    }
}
