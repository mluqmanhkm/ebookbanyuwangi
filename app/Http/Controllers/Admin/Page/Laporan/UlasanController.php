<?php

namespace App\Http\Controllers\Admin\Page\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class UlasanController extends Controller
{
    public function index(){
        return view('admin.page.laporan.ulasan');
    }

    public function get_laporanulas(Request $request)
    {
        $data = Ebook::select('ebooks.id', 'ebooks.judul', 'ebooks.id_kategori', 'ebooks.jumlah_baca', 'kategoris.kategori')
            ->leftJoin('kategoris', 'ebooks.id_kategori', '=', 'kategoris.id')
            ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('jumlahPenilaian', function ($row) {
                    $jumlah = Ulasan::where('id_ebook', $row->id)->count();
                    return '<span id="jumlahPenilaian_' . $row->id . '">' . $jumlah . '</span>';
                })
                ->addColumn('totalPenilaian', function ($row) {
                    $ulasan = Ulasan::select('ulasans.id_user', 'ulasans.id_ebook', 'ulasans.komentar', 'ulasans.penilaian', 'users.nama')
                    ->join('users', 'users.id', '=', 'ulasans.id_user')
                    ->where('ulasans.id_ebook', $row->id)
                    ->get();

                    $averageRating = $ulasan->avg('penilaian');

                    return '<span id="totalPenilaian_' . $row->id . '">' . number_format($averageRating, 1) . '</span>';
                })
                ->rawColumns(['jumlahPenilaian', 'totalPenilaian'])
                ->make(true);
    }
    
    public function get_ulasan(Request $request)
    {
        $ulasan = Ulasan::select('ulasans.id', 'ulasans.id_user', 'ulasans.id_ebook', 'ulasans.komentar', 'ulasans.penilaian', 'ulasans.created_at', 'users.nama', 'ebooks.judul')
        ->join('users', 'users.id', '=', 'ulasans.id_user')
        ->join('ebooks', 'ebooks.id', '=', 'ulasans.id_ebook')
        ->get();

            return Datatables::of($ulasan)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="btn-group">
                        <a href="javascript:void(0)" type="button" id="btn-del" class="btn-hapus btn btn-danger rounded p-1" onClick="delete_data(' . "'" . $row->id . "'" . ')"><i class="ti ti-trash fs-5"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function destroy(Request $request)
    {
        $id = $request->input('q');
        $ulasan = Ulasan::find($id);
        $ulasan->delete();
        echo json_encode(['status' => TRUE]);
    }

    public function cetak_laporanulas(Request $request)
    {
        $data = Ebook::select('ebooks.id', 'ebooks.judul', 'ebooks.id_kategori', 'ebooks.jumlah_baca', 'kategoris.kategori')
        ->leftJoin('kategoris', 'ebooks.id_kategori', '=', 'kategoris.id')
        ->get();

        $data->map(function ($row) {
            $row->jumlahPenilaian = Ulasan::where('id_ebook', $row->id)->count();

            $ulasan = Ulasan::select('ulasans.id_user', 'ulasans.id_ebook', 'ulasans.komentar', 'ulasans.penilaian', 'users.nama')
                ->join('users', 'users.id', '=', 'ulasans.id_user')
                ->where('ulasans.id_ebook', $row->id)
                ->get();

            $row->totalPenilaian = number_format($ulasan->avg('penilaian'), 1);
            
            return $row;
        });

        $pdf = Pdf::loadView('admin.page.laporan.laporanulasan', ['data' => $data]);

        return $pdf->stream('laporan_ulasan.pdf');
    }
}
