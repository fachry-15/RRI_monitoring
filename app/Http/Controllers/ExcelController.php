<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        $nama_file = $file->getClientOriginalName();
        $file->move('file_excel', $nama_file);
        return redirect()->back();
    }

    public function exportExcel()
    {
        return Excel::download(new BarangExport, 'Laporan_Data_Barang.xlsx');
    }
}
