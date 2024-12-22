<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
        img {
            max-height: 50px; /* Ukuran gambar */
        }
    </style>
</head>
<body>
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
                    <td>{{ $data->kategori->nama ?? 'Tidak Ada' }}</td>
                    <td>{{ $data->ruangan->nama_ruangan ?? 'Tidak Ada' }}</td>
                    <td>{{ $data->kondisi }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal_masuk)->format('d-m-Y') }}</td>
                    <td>
                        @if(file_exists(public_path('barcodes/' . $data->kode_barang . '.png')))
                            
                        @else
                            Tidak Ada
                        @endif
                    </td>
                    <td>
                        @if(file_exists(public_path('images/' . $data->bukti_gambar)))
                          
                        @else
                            Tidak Ada
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
