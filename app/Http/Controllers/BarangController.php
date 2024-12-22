<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\kantor;
use App\Models\kategori;
use App\Models\Ruangan;
use App\Models\User;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil data barang
        $barang = barang::with('kategori', 'kantor', 'petugas', 'ruangan')->paginate(10);

        return view('barang', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategori::all();
        $kantor = kantor::all();
        $ruangan = Ruangan::all();
        $petugas = User::all();
        return view('forms.createbarang', compact('kategori', 'kantor', 'ruangan', 'petugas'));
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
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'merek' => 'required|string|max:255',
                'tipe' => 'nullable|string|max:255',
                'kategori' => 'required|integer',
                'kode_barang' => 'required|string|max:255|unique:barangs,kode_barang',
                'penanggungjawab' => 'required|integer',
                'ruangan' => 'required|integer',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'tanggal' => 'required|date',
                'sumber' => 'required|string|max:255',
                'kantor' => 'required|integer',
                'file' => 'nullable|file|mimes:pdf|max:2048',
                'processor' => 'nullable|string|max:255',
                'ram' => 'nullable|string|max:255',
                'storage' => 'nullable|string|max:255',
                'tahun' => 'nullable|integer',
                'kondisi' => 'required|string|max:255',
            ]);

            // Proses upload gambar
            if ($request->hasFile('gambar')) {
                $image = $request->file('gambar');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $validatedData['gambar'] = $imageName;
            }

            // Proses upload file lampiran
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('files'), $fileName);
                $validatedData['file'] = $fileName;
            }

            // Simpan data ke dalam database
            $barang = Barang::create([
                'nama_barang' => $validatedData['nama'],
                'merek' => $validatedData['merek'],
                'tipe' => $validatedData['tipe'],
                'kategori_id' => $validatedData['kategori'],
                'kode_barang' => $validatedData['kode_barang'],
                'petugas_id' => $validatedData['penanggungjawab'],
                'ruangan_id' => $validatedData['ruangan'],
                'bukti_gambar' => $validatedData['gambar'] ?? null,
                'tanggal_masuk' => $validatedData['tanggal'],
                'sumber_barang' => $validatedData['sumber'],
                'kantor_id' => $validatedData['kantor'],
                'lampiran' => $validatedData['file'] ?? null,
                'processor' => $validatedData['processor'] ?? null,
                'ram' => $validatedData['ram'] ?? null,
                'storage' => $validatedData['storage'] ?? null,
                'tahun_perolehan' => $validatedData['tahun'] ?? null,
                'kondisi' => $validatedData['kondisi'],
            ]);

            // Generate QR code using Endroid QR Code
            $result = Builder::create()
                ->writer(new PngWriter())
                ->data($validatedData['kode_barang'])
                ->size(200)
                ->margin(10)
                ->build();

            $barcodeName = $validatedData['kode_barang'] . '.png';
            $barcodePath = public_path('barcodes/' . $barcodeName);

            // Simpan QR Code ke folder public/barcodes
            $result->saveToFile($barcodePath);

            // Simpan nama file QR code ke database (jika perlu)
            $barang->update([
                'qr_code' => $barcodeName,
            ]);

            return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');

            return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menambahkan barang.');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(barang $barang)
    {
        $barang = barang::select('nama_barang')->get();
        return response()->json($barang);
    }

    public function detail($id)
    {
        $barang = Barang::with(['kategori', 'ruangan', 'kantor', 'petugas'])->findOrFail($id);

        return view('detailbarang', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(barang $barang)
    {
        //
    }
}
