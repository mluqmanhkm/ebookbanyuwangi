<?php

namespace App\Http\Controllers\Admin\Page\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ebook;
use App\Models\JumlahBaca;
use App\Models\Kategori;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class JumlahPembacaController extends Controller
{
    public function index(){
        return view('admin.page.laporan.jumlahpembaca');
    }

    public function get_listbaca(Request $request)
    {
        $query = JumlahBaca::select('jumlah_bacas.id_ebook', 'jumlah_bacas.created_at', 'ebooks.judul', 'ebooks.id_kategori', 'kategoris.kategori')
            ->leftJoin('ebooks', 'jumlah_bacas.id_ebook', '=', 'ebooks.id')
            ->Join('kategoris', 'ebooks.id_kategori', '=', 'kategoris.id');

            if ($request->has('tanggal') && $request->tanggal != null) {
                $query->whereDate('jumlah_bacas.created_at', $request->tanggal);
            }
        
            if ($request->has('bulan') && $request->bulan != null) {
                $query->whereMonth('jumlah_bacas.created_at', '=', date('m', strtotime($request->bulan)))
                    ->whereYear('jumlah_bacas.created_at', '=', date('Y', strtotime($request->bulan)))
                    ->count();
            }

            if ($request->has('tahun') && $request->tahun != null) {
                $query->whereYear('jumlah_bacas.created_at', $request->tahun)
                    ->count();
            }

            $data = $query->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d');
            })
            ->make(true);
    }

    public function get_laporanbaca(Request $request)
    {
        $data = Ebook::select('ebooks.id', 'ebooks.judul', 'ebooks.id_kategori', 'kategoris.kategori')
            ->leftJoin('kategoris', 'ebooks.id_kategori', '=', 'kategoris.id')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('jumlahBacaPer', function ($row) use ($request) {
                $jumlah = JumlahBaca::where('id_ebook', $row->id)->count();

                if ($request->has('tanggal') && $request->tanggal != null) {
                    $jumlah = JumlahBaca::where('id_ebook', $row->id)
                        ->whereDate('jumlah_bacas.created_at', $request->tanggal)
                        ->count();
                }

                if ($request->has('bulan') && $request->bulan != null) {
                    $jumlah = JumlahBaca::where('id_ebook', $row->id)
                        ->whereMonth('jumlah_bacas.created_at', '=', date('m', strtotime($request->bulan)))
                        ->whereYear('jumlah_bacas.created_at', '=', date('Y', strtotime($request->bulan)))
                        ->count();
                }

                if ($request->has('tahun') && $request->tahun != null) {
                    $jumlah = JumlahBaca::where('id_ebook', $row->id)
                        ->whereYear('jumlah_bacas.created_at', $request->tahun)
                        ->count();
                }

                return '<span id="jumlahBaca_' . $row->id . '">' . $jumlah . '</span>';
            })
            ->rawColumns(['jumlahBacaPer'])
            ->make(true);
    }

    public function get_laporanbacakategori(Request $request)
    {
        $data = Kategori::select('kategoris.id', 'kategoris.kategori')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('jumlahBacaPer', function ($row) use ($request) {

                $query = JumlahBaca::select('jumlah_bacas.id_ebook', 'jumlah_bacas.created_at', 'ebooks.judul', 'ebooks.id_kategori', 'kategoris.kategori')
                ->leftJoin('ebooks', 'jumlah_bacas.id_ebook', '=', 'ebooks.id')
                ->join('kategoris', 'ebooks.id_kategori', '=', 'kategoris.id')
                ->where('ebooks.id_kategori', $row->id);

                if ($request->has('tanggal') && $request->tanggal != null) {
                    $jumlahBacaKategori = $query->whereDate('jumlah_bacas.created_at', $request->tanggal)->count();
                }

                if ($request->has('bulan') && $request->bulan != null) {
                    $jumlahBacaKategori = $query->whereMonth('jumlah_bacas.created_at', '=', date('m', strtotime($request->bulan)))
                        ->whereYear('jumlah_bacas.created_at', '=', date('Y', strtotime($request->bulan)))
                        ->count();
                }

                if ($request->has('tahun') && $request->tahun != null) {
                    $jumlahBacaKategori = $query->whereYear('jumlah_bacas.created_at', $request->tahun)->count();
                }

                $jumlahBacaKategori = $query->count();

                return '<span id="jumlahBacaKategeori_' . $row->id . '">' . $jumlahBacaKategori . '</span>';
            })
            ->rawColumns(['jumlahBacaPer'])
            ->make(true);
    } 

    public function cetak_laporan(Request $request)
    {
        $dataEbook  = Ebook::select('ebooks.id', 'ebooks.judul', 'ebooks.id_kategori', 'ebooks.jumlah_baca', 'kategoris.kategori')
            ->leftJoin('kategoris', 'ebooks.id_kategori', '=', 'kategoris.id')
            ->get();

        foreach ($dataEbook as $row) {
            $jumlah = JumlahBaca::where('id_ebook', $row->id)->count();

            if ($request->has('tanggal') && $request->tanggal != null) {
                $jumlah = JumlahBaca::where('id_ebook', $row->id)
                    ->whereDate('jumlah_bacas.created_at', $request->tanggal)
                    ->count();
            }

            if ($request->has('bulan') && $request->bulan != null) {
                $jumlah = JumlahBaca::where('id_ebook', $row->id)
                    ->whereMonth('jumlah_bacas.created_at', '=', date('m', strtotime($request->bulan)))
                    ->whereYear('jumlah_bacas.created_at', '=', date('Y', strtotime($request->bulan)))
                    ->count();
            }

            if ($request->has('tahun') && $request->tahun != null) {
                $jumlah = JumlahBaca::where('id_ebook', $row->id)
                    ->whereYear('jumlah_bacas.created_at', $request->tahun)
                    ->count();
            }

            $row->jumlahBacaPer = $jumlah;
        }

        $data = Kategori::select('kategoris.id', 'kategoris.kategori', 'kategoris.jumlah_baca')
            ->get();
    
        $dataKategori = $data->map(function ($row) use ($request) {
            $query = JumlahBaca::leftJoin('ebooks', 'jumlah_bacas.id_ebook', '=', 'ebooks.id')
                ->where('ebooks.id_kategori', $row->id);
    
            if ($request->filled('tanggal')) {
                $query->whereDate('jumlah_bacas.created_at', $request->tanggal);
            }
    
            if ($request->filled('bulan')) {
                $query->whereMonth('jumlah_bacas.created_at', '=', date('m', strtotime($request->bulan)))
                    ->whereYear('jumlah_bacas.created_at', '=', date('Y', strtotime($request->bulan)));
            }
    
            if ($request->filled('tahun')) {
                $query->whereYear('jumlah_bacas.created_at', $request->tahun);
            }
    
            $row->jumlahBacaKategoriPer = $query->count();
            return $row;
        });

        $periode = 'Semua Waktu';
        if ($request->filled('tanggal')) {
            $periode = \Carbon\Carbon::parse($request->tanggal)->format('l, d F Y');
        } elseif ($request->filled('bulan')) {
            $periode = \Carbon\Carbon::parse($request->bulan)->format('F Y');
        } elseif ($request->filled('tahun')) {
            $periode = $request->tahun;
        }

        $totalBaca = $dataEbook->sum('jumlahBacaPer');

        $data = [
            'dataEbook' => $dataEbook,
            'dataKategori' => $dataKategori,
            'totalEbook' => Ebook::count(),
            'totalKategori' => Kategori::count(),
            'request' => $request,
            'periode' => $periode,
            'totalBaca' => $totalBaca,
        ];

        $pdf = Pdf::loadView('admin.page.laporan.laporan', $data);
        return $pdf->stream('laporan.pdf');
    
    }

}
