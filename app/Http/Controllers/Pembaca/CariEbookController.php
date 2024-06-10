<?php

namespace App\Http\Controllers\Pembaca;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ebook;
use App\Models\Kategori;

class CariEbookController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        $ebook = Ebook::select('id', 'cover', 'judul', 'deskripsi')->where('publish', 1)->latest()->paginate(8);
        return view('pembaca.caribuku', compact('kategoris', 'ebook'));
    }
}
