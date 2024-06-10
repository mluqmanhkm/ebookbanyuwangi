<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        return view('admin.page.log');
    }

    public function index2()
    {
        return view('admin.page.profil');
    }
}
