<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karcis Maintenance</title>
    <style>
        /* CSS Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            
        }

        .ticket-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 9cm;
            height: 10cm;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            border-left: 8px solid #007bff;
            padding: 15px;
            position: relative;
            text-align: center;
        }

        .ticket-header {
            margin-bottom: 15px;
        }

        .ticket-header img {
            max-width: 60px;
            margin-bottom: 10px;
        }

        .ticket-header h2 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }

        .ticket-code {
            font-size: 14px;
            color: #555;
            background-color: #e9ecef;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 5px;
        }

        .ticket-body {
            text-align: center;
            padding: 10px;
            font-size: 13px;
            line-height: 1.6;
        }

        .ticket-body p {
            margin: 8px 0;
        }

        .ticket-body p span {
            font-weight: bold;
            color: #007bff;
        }

        .ticket-footer {
            text-align: center;
            border-top: 2px dashed #ddd;
            margin-top: 10px;
            padding-top: 5px;
            font-size: 12px;
        }

        /* Gaya untuk cetak */
        @media print {
            body {
                background-color: #fff;
                margin: 0;
            }

            .ticket-container {
                box-shadow: none;
                border-radius: 0;
            }
        }
    </style>
</head>

<body>
    <div class="ticket-container">
        <div>
            <div class="ticket-header">
                <img src="{{ public_path('images/logorri.png') }}" alt="Logo">
                <h2>{{$ticket->jenis}}</h2>
                <div class="ticket-code">#{{$ticket->kode_ticket}}</div>
            </div>
            <div class="ticket-body">
                <p><span>Nama Barang:</span> {{ $ticket->barang->nama_barang }}</p>
                <p><span>Diagnosa:</span> {{ $ticket->diagnosa }}</p>
                <p><span>Deskripsi Perawatan:</span> {{ $ticket->deskripsi }}</p>
                <p><span>Tanggal Perbaikan:</span> {{ $ticket->created_at->translatedFormat('l, d F Y') }}</p>
            </div>
            <div class="ticket-footer">
                <p>Tanggal Pencetakan: {{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
        </div>
    </div>
</body>

</html>
