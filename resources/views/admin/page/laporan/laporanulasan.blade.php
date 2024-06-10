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
        <h3 >LAPORAN ULASAN</h3>
        {{-- <h4>Periode: {{ $periode }}</h4> --}}
    </div>
    <div class="tabel">
        <h4>Pembaca Kategori E-book</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Jumlah Penilaian</th>
                    <th>Rata-rata Penilaian</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->judul }}</td>
                    <td>{{ $row->kategori }}</td>
                    <td>{{ $row->jumlahPenilaian }}</td>
                    <td>{{ $row->totalPenilaian }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>   
    <div>
        <h4>Jumlah Total</h4>
        {{-- <p>Total Ebook: {{ $totalEbook }} Ebook</p>
        <p>Total Kategori: {{ $totalKategori }} Kategori</p> --}}
        {{-- <p>Total Ulasan: {{ $totalBaca }} Kali Dibaca</p>     --}}
    </div>
</body>
</html>