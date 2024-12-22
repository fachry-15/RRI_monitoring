<?php

namespace App\Exports;

use App\Models\Barang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BarangExport implements FromView, WithDrawings, WithColumnWidths, WithStyles
{
    private $barang;

    public function __construct()
    {
        $this->barang = Barang::with(['kategori', 'ruangan', 'petugas', 'kantor'])->get();
    }

    public function view(): View
    {
        return view('Excel.barang', ['barang' => $this->barang]);
    }

    public function drawings()
    {
        $drawings = [];
        foreach ($this->barang as $index => $data) {
            $row = $index + 2; // Baris mulai dari baris kedua (1 adalah header)

            // Tambahkan gambar barcode
            if (file_exists(public_path('barcodes/' . $data->kode_barang . '.png'))) {
                $barcodeDrawing = new Drawing();
                $barcodeDrawing->setName('Barcode ' . $data->kode_barang);
                $barcodeDrawing->setDescription('Barcode for ' . $data->kode_barang);
                $barcodeDrawing->setPath(public_path('barcodes/' . $data->kode_barang . '.png'));
                $barcodeDrawing->setHeight(80); // Atur tinggi gambar (dalam piksel)
                $barcodeDrawing->setCoordinates('J' . $row); // Kolom J
                $drawings[] = $barcodeDrawing;
            }

            // Tambahkan bukti gambar
            if ($data->bukti_gambar && file_exists(public_path('images/' . $data->bukti_gambar))) {
                $imageDrawing = new Drawing();
                $imageDrawing->setName('Bukti ' . $data->nama_barang);
                $imageDrawing->setDescription('Bukti Gambar for ' . $data->nama_barang);
                $imageDrawing->setPath(public_path('images/' . $data->bukti_gambar));
                $imageDrawing->setHeight(80); // Atur tinggi gambar (dalam piksel)
                $imageDrawing->setCoordinates('K' . $row); // Kolom K
                $drawings[] = $imageDrawing;
            }
        }

        return $drawings;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 15,  // Kode Barang
            'C' => 25,  // Nama Barang
            'D' => 15,  // Merek
            'E' => 15,  // Tipe
            'F' => 20,  // Kategori
            'G' => 20,  // Ruangan
            'H' => 10,  // Kondisi
            'I' => 15,  // Tanggal Masuk
            'J' => 20,  // Barcode
            'K' => 35,  // Bukti Gambar
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Atur tinggi baris
        foreach (range(2, count($this->barang) + 1) as $row) {
            $sheet->getRowDimension($row)->setRowHeight(70);
        }

        return [
            // Style Header
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
