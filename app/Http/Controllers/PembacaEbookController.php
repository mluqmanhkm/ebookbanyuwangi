<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Ebook;
use App\Models\JumlahBaca;
use App\Models\Kategori;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;


class PembacaEbookController extends Controller
{
    // public function index(){
    //     return view('index');
    // }
    public function index()
    {
        $today = Carbon::now()->translatedFormat('l,j F Y');
        // @dd($today);
        $banner = Banner::select('foto')->get();

        $ebook = Ebook::select('id', 'cover', 'judul', 'deskripsi', 'tanggal', 'publish', 'rekomendasi', 'jumlah_baca')   
            ->orderBy('tanggal', 'desc')
            ->paginate(8);
        // dd($ebook);

        return view('pembaca.home', compact('today', 'banner', 'ebook'));
    }

    public function jumlahBaca(Request $request, $id)
    {
        $ebook = Ebook::findOrFail($id);

        // Hitung jumlah pembaca dan simpan dalam database
        $ebook->jumlah_baca += 1;
        $ebook->save();

        $kategori = Kategori::findOrFail($ebook->id_kategori);
        $kategori->jumlah_baca += 1;
        $kategori->save();

        JumlahBaca::create([
            'id_ebook' => $ebook->id,
        ]);

        return response()->json(['message' => 'Berhasil menambahkan jumlah pembaca', 'jumlah_baca' => $ebook->jumlah_baca]);
    }
}
