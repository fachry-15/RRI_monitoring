<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\peminjaman;
use Illuminate\Http\Request;

class KembalikanController extends Controller
{
    public function index()
    {
        // Ambil data peminjaman
        $peminjaman = peminjaman::with('barang', 'user')
            ->paginate(10);
        $barangs = peminjaman::with('barang', 'user')
            ->where('status', 'sedang digunakan')
            ->get();

        return view('kembalikan', compact('peminjaman', 'barangs'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'barang' => 'required|string|max:255',
        ]);

        // // Debugging input data
        // dd($validatedData);

        // Cek apakah barang sedang digunakan
        $cek = peminjaman::where([
            ['id', '=', $validatedData['barang']],
            ['status', '=', 'Telah Dikembalikan'],
        ])->get();

        // Jika barang sedang digunakan
        if ($cek->count() > 0) {
            return redirect()->route('kembalikan.index')->with('error', 'Mohon maaf barang telah dikembalikan!');
        }

        // Jika barang tidak sedang digunakan
        peminjaman::where('id', $validatedData['barang'])
            ->update([
                'status' => 'Telah Dikembalikan',
                'updated_at' => now(),
                'tanggal_kembali' => now(),
            ]);

        return redirect()->route('kembalikan.index')->with('success', 'Terima kasih telah mengembalikan barang!');
    }

    public function storeauto(Request $request)
    {
        $kodeBarang = $request->input('barang');
        $barang = Barang::where('kode_barang', $kodeBarang)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        $item = Peminjaman::where('barang_id', $barang->id)
            ->where('status', 'Sedang digunakan')
            ->first();

        if ($item) {
            // Update status peminjaman
            $item->status = 'Telah Dikembalikan';
            $item->save();


            return redirect()->back()->with('success', 'Terima kasih sudah mengembalikan barang angkasawan/angkasawati.');
        } else {
            return redirect()->back()->with('error', 'Mohon maaf, barang yang anda inginkan sudah dikembalikan.');
        }
    }
}
