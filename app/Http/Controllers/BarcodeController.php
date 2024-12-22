<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode as QrCodeQrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function Barcode($kode)
    {
        $qrCode = QrCodeQrCode::create($kode);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Return QR Code sebagai Base64 Image
        return '<img src="data:image/png;base64,' . base64_encode($result->getString()) . '" alt="Barcode" />';
    }
}
