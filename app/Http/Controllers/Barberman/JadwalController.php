<?php

namespace App\Http\Controllers\Barberman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        return view('barberman.jadwal');
    }
}
