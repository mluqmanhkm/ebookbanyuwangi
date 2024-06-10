<?php

namespace App\Http\Controllers\Pembaca;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatBacaController extends Controller
{
    public function __invoke()
    {
        return view('pembaca.riwayatbaca');
    }
}
