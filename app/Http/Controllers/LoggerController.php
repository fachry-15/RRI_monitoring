<?php

namespace App\Http\Controllers;

use App\Models\logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoggerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logger = logger::paginate(10);
        $petugas = logger::with('petugas')->get();
        return view('logger', compact('logger', 'petugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.createlogger');
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
            'channel' => 'required|string|max:255',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'required|date_format:H:i',
            'tanggal' => 'required|date',
            'petugas_id' => 'required|integer|min:1',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi untuk file (opsional)
        ]);

        try {
            // Simpan file jika ada file yang diunggah
            $filePath = null; // Default null jika tidak ada file
            if ($request->hasFile('attachment')) {
                $filePath = $request->file('attachment')->store('attachments', 'public'); // Simpan file di storage/public/attachments
            }

            // Buat logger baru
            $logger = new logger(); // Pastikan nama model sesuai dengan nama tabel
            $logger->channel_logger = $request->channel;
            $logger->jam_masuk = $request->jam_masuk;
            $logger->jam_keluar = $request->jam_keluar;
            $logger->tanggal = $request->tanggal;
            $logger->petugas_id = $request->petugas_id;
            $logger->bukti_gambar = $filePath; // Simpan path file (bisa null jika tidak ada file)
            $logger->save();

            // Log untuk sukses
            Log::info('Log data berhasil disimpan', ['logger_id' => $logger->id]);

            // Redirect kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->route('logger.index')->with('success', 'Log berhasil disimpan.');
        } catch (\Exception $e) {
            // Log untuk error
            Log::error($e->getMessage());

            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan log. Silakan coba lagi.');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\logger  $logger
     * @return \Illuminate\Http\Response
     */
    public function show(logger $logger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\logger  $logger
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $logger = Logger::findOrFail($id);

        // Pastikan ID data yang diambil sesuai dengan ID pengguna yang sedang login
        if ($logger->petugas_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Mohon maaf anda tidak memiliki hak untuk mengedit data ini.');
        }

        // Jika valid, tampilkan form edit
        return view('forms.editlogger', compact('logger'));
    }

    // Method untuk mengupdate data
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'channel' => 'required|string',
            'jam_masuk' => 'required|date_format:H:i:s',
            'jam_keluar' => 'required|date_format:H:i:s',
            'tanggal' => 'required|date_format:Y-m-d',
            'attachment' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Cek apakah data sudah benar
        Log::info('Validated Data: ', $validated);

        // Cari data berdasarkan ID
        $logger = Logger::findOrFail($id);
        // Update data logger
        $logger->channel_logger = $request->input('channel');
        $logger->jam_masuk = $request->input('jam_masuk');
        $logger->jam_keluar = $request->input('jam_keluar');
        $logger->tanggal = $request->input('tanggal');

        // Periksa apakah file attachment ada
        if ($request->hasFile('attachment')) {
            // Menyimpan file attachment dan menyimpannya dalam database
            $path = $request->file('attachment')->store('attachments', 'public');
            $logger->bukti_gambar = $path;
        }

        // Simpan perubahan
        $logger->save();

        return redirect()->route('logger.index')->with('success', 'Logger updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\logger  $logger
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Logger::findOrFail($id);

        // Pastikan ID pengguna yang sedang login adalah pemilik data
        if ($data->petugas_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Mohon maaf anda tidak memiliki hak untuk menghapus data ini.');
        }

        // Hapus data
        $data->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('logger.index')->with('success', 'Data berhasil dihapus.');
    }
}
