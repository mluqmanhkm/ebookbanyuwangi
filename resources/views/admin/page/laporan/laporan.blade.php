<!-- resources/views/laporanbaca.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Baca</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }

        .judul {
            text-align: center;
        }

        .tabel {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="judul">
        <h3 >LAPORAN JUMLAH PEMBACA</h3>
        <h4>Periode: {{ $periode }}</h4>
    </div>
    <div class="tabel">
        <h4>Pembaca E-book</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Jumlah Baca</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataEbook as $index  => $ebook)
                    <tr>
                        <td>{{ $index  + 1 }}</td>
                        <td>{{ $ebook->judul }}</td>
                        <td>{{ $ebook->kategori }}</td>
                        <td>{{ $ebook->jumlahBacaPer }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Pembaca Kategori E-book</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Jumlah Baca</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataKategori as $index  => $kategori)
                    <tr>
                        <td>{{ $index  + 1 }}</td>
                        <td>{{ $kategori->kategori }}</td>
                        <td>{{ $kategori->jumlahBacaKategoriPer }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div>
        <h4>Jumlah Total</h4>
        <p>Total Ebook: {{ $totalEbook }} Ebook</p>
        <p>Total Kategori: {{ $totalKategori }} Kategori</p>
        <p>Total Jumlah Baca Ebook: {{ $totalBaca }} Kali Dibaca</p>    
    </div>
</body>
</html>
