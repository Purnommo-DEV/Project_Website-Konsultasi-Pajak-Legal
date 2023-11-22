<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Front_BerandaController extends Controller
{
    public function halaman_beranda()
    {
        return view('Front.beranda.beranda');
    }
}
