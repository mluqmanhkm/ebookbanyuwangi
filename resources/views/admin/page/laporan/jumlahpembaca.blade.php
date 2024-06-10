@extends('admin.layout.main')
@section('title', 'Laporan')

@section('isi')
<div class="main-content" id="dataadmin">
    <div class="title">
        <h5>halaman Jumlah Pembaca</h5>
    </div>
    <div class="col-md-12" >
        <div class="card">
            <div class="card-body" style="display: none">
                <div class="table-responsive">
                    <table id="listBacaTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Waktu</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive mb-5">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="tahunFilter" class="form-label">Tahun:</label>
                            <input type="number" id="tahunFilter" class="form-control" placeholder="Tahun">
                        </div>
                        <div class="col">
                            <label for="bulanFilter" class="form-label">Bulan:</label>
                            <input type="month" id="bulanFilter" class="form-control" placeholder="Bulan">
                        </div>
                        <div class="col">
                            <label for="tanggalFilter" class="form-label">Tanggal:</label>
                            <input type="date" id="tanggalFilter" class="form-control" placeholder="Tanggal">
                        </div>
                        <div class="col d-flex align-items-end mb-1">
                            <button id="clearFilters" class="btn btn-primary">Reset</button>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Form untuk mengirim filter ke backend saat mencetak PDF -->
                        <form id="cetakForm" action="{{ route('cetak_laporan') }}" method="GET" target="_blank">
                            <!-- Input tersembunyi untuk tanggal -->
                            <input type="hidden" name="tanggal" id="hiddenTanggal">
                            <!-- Input tersembunyi untuk bulan -->
                            <input type="hidden" name="bulan" id="hiddenBulan">
                            <!-- Input tersembunyi untuk tahun -->
                            <input type="hidden" name="tahun" id="hiddenTahun">
                            <!-- Tombol submit untuk mencetak PDF -->
                            <button type="submit" class="btn btn-primary mb-3">Cetak</button>
                        </form>
                    </div>
                    <div class="mb-3">
                        <span id="totalData">Total Baca Ebook: 0</span>
                    </div>
                    <table id="jumlahBacaTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Jumlah Baca</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Jumlah Baca</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="table-responsive">
                    <table id="jumlahBacaKategoriTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Jumlah Baca</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Jumlah Baca</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            
        </div>
    </div>
</div>
</div>

@endsection

@section('js')
    <script type="text/javascript">

    // Event listener untuk mengisi input tersembunyi dengan nilai filter tahun
    document.getElementById('tahunFilter').addEventListener('change', function () {
        document.getElementById('hiddenTahun').value = this.value;
    });

    // Event listener untuk mengisi input tersembunyi dengan nilai filter bulan
    document.getElementById('bulanFilter').addEventListener('change', function () {
        document.getElementById('hiddenBulan').value = this.value;
    });

    // Event listener untuk mengisi input tersembunyi dengan nilai filter tanggal
    document.getElementById('tanggalFilter').addEventListener('change', function () {
        document.getElementById('hiddenTanggal').value = this.value;
    });

    // Event listener untuk menghapus nilai filter dan input tersembunyi saat tombol reset diklik
    document.getElementById('clearFilters').addEventListener('click', function () {
        document.getElementById('tahunFilter').value = '';
        document.getElementById('bulanFilter').value = '';
        document.getElementById('tanggalFilter').value = '';
        document.getElementById('hiddenTahun').value = '';
        document.getElementById('hiddenBulan').value = '';
        document.getElementById('hiddenTanggal').value = '';
    });


        // Fungsi index 
        $(document).ready(function() {
            var table = $('#listBacaTable').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                orderClasses: false,
                info: false,
                ajax: {
                    url: "{{ route('listbaca.list') }}",
                    data: function (d) {
                        d.tanggal = $('#tanggalFilter').val();
                        d.bulan = $('#bulanFilter').val();
                        d.tahun = $('#tahunFilter').val();
                    },
                    dataSrc: function(json) {
                        $('#totalData').text('Total Baca Ebook: ' + json.recordsFiltered);
                        return json.data;
                    }
                },
                    columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'judul', name: 'judul' },
                    { data: 'kategori', name: 'kategori' },
                    { data: 'created_at', name: 'created_at' },
                ]
            });

            $('#tanggalFilter, #bulanFilter, #tahunFilter').change(function() {
                table.draw();
            });

            $('#clearFilters').click(function() {
                $('#tanggalFilter').val('');
                $('#bulanFilter').val('');
                $('#tahunFilter').val('');
                table.draw();
            });
        });

        // Fungsi index baca ebeook
        $(document).ready(function() {
            var table = $('#jumlahBacaTable').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                orderClasses: false,
                info: false,
                ajax: {
                    url: "{{ route('laporanbaca.list') }}",
                    data: function(d) {
                        d.tanggal = $('#tanggalFilter').val();
                        d.bulan = $('#bulanFilter').val();
                        d.tahun = $('#tahunFilter').val();
                    },
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'judul', name: 'judul' },
                    { data: 'kategori', name: 'kategori'},
                    { data: 'jumlahBacaPer', name: 'jumlahBacaPer', orderable: true, searchable: true },
                ]
            });
            
            $('#tanggalFilter, #bulanFilter, #tahunFilter').change(function() {
                table.draw();
            });

            $('#clearFilters').click(function() {
                table.draw();
            });
        });

        // Fungsi index baca kategori ebook
        $(document).ready(function() {
            var table = $('#jumlahBacaKategoriTable').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                orderClasses: false,
                info: false,
                ajax: {
                    url: "{{ route('laporanbacakategori.list') }}",
                    data: function(d) {
                        d.tanggal = $('#tanggalFilter').val();
                        d.bulan = $('#bulanFilter').val();
                        d.tahun = $('#tahunFilter').val();
                    },
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'kategori', name: 'kategori' },
                    { data: 'jumlahBacaPer', name: 'jumlahBacaPer', orderable: true, searchable: true },
                ]
            });
            
            $('#tanggalFilter, #bulanFilter, #tahunFilter').change(function() {
                table.draw();
            });
            $('#clearFilters').click(function() {
                table.draw();
            });
        });

    </script>
@endsection
