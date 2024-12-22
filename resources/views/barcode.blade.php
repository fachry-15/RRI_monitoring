<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode</title>
    <style>
        @page {
            size: 5cm 5cm; /* Ukuran halaman */
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
        }
        .barcode img {
            width: 70%; /* Ukuran gambar */
            height: auto;
        }
        .kode {
            font-size: 14px;
            font-weight: bold;
            margin-top: 10px; /* Jarak antara barcode dan kode */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Barcode -->
        <div class="barcode">
            <img src="{{ public_path('barcodes/' . $barang->kode_barang . '.png') }}" alt="Barcode {{ $barang->kode_barang }}">
        </div>
        <!-- Kode Barang -->
        <div class="kode">{{ $barang->kode_barang }}</div>
    </div>
</body>
</html>
