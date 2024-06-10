<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ebook;
use App\Models\JumlahBaca;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.page.dashboard')->with([
            'ebook' => Ebook::count(),
            'kategori' => Kategori::count(),
            'totalbaca' => JumlahBaca::count(),
        ]);
    }
}
