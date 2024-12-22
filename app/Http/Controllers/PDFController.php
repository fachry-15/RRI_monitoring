<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Barryvdh\DomPDF\Facade\Pdf as Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function cetakBarcode($id)
    {
        $barang = Barang::findOrFail($id);

        // Periksa apakah file barcode ada
        $barcodePath = public_path('barcodes/' . $barang->kode_barang . '.png');
        if (!file_exists($barcodePath)) {
            abort(404, 'Barcode tidak ditemukan.');
        }

        // Render PDF
        $pdf = Pdf::loadView('barcode', compact('barang'))
            ->setPaper([0, 0, 141.73, 141.73], 'portrait'); // 5cm x 5cm

        return $pdf->stream("barcode_{$barang->kode_barang}.pdf");
    }

    public function cetakSemuaBarang()
    {
        $barang =  barang::with('ruangan', 'kategori')->get();

        $pdf = Pdf::loadView('PDF.databarang', compact('barang'))->setPaper('A4', 'landscape');

        return $pdf->stream('hdtuto.pdf');
    }
}
