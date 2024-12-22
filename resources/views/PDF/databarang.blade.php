<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Barang</title>
    <style>
        @page {
            margin: 20px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 80px;
        }
        .title {
            margin-top: 10px;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .subtitle {
            font-size: 14px;
            font-weight: normal;
            color: #666;
        }
        .line {
            margin: 10px auto;
            height: 2px;
            background-color: #000;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        table th {
            background-color: #0374e4;
            color: white;
        }
        .barcode img, .bukti-gambar img {
            width: 70px;
            height: auto;
            margin: auto;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <img src="{{ public_path('images/logorri.png') }}" alt="Logo">
        <div class="title">Laporan Data Barang</div>
        <div class="subtitle">Radio Republik Indonesia - Surabaya</div>
        <div class="line"></div>
    </div>

    <!-- Table Section -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Merek</th>
                <th>Tipe</th>
                <th>Kategori</th>
                <th>Ruangan</th>
                <th>Kondisi</th>
                <th>Tanggal Masuk</th>
                <th>Barcode</th>
                <th>Bukti Gambar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->kode_barang }}</td>
                    <td>{{ $data->nama_barang }}</td>
                    <td>{{ $data->merek }}</td>
                    <td>{{ $data->tipe }}</td>
                    <td>{{ $data->kategori->nama }}</td>
                    <td>{{ $data->ruangan->nama_ruangan }}</td>
                    <td>{{ $data->kondisi }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal_masuk)->translatedFormat('d-m-Y') }}</td>
                    <td class="barcode">
                        <img src="{{ public_path('barcodes/' . $data->kode_barang . '.png') }}" alt="Barcode {{ $data->kode_barang }}">
                    </td>
                    <td class="bukti-gambar">
                        @if($data->bukti_gambar)
                            <img src="{{ public_path('images/' . $data->bukti_gambar) }}" alt="Gambar {{ $data->nama_barang }}">
                        @else
                            <span>Tidak Ada</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer Section -->
    <div class="footer">
        Laporan ini dibuat pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>
</body>
</html>
