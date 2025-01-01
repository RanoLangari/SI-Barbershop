<?php

namespace App\Http\Controllers\Barberman;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pelangganCount = User::where('role', 'pelanggan')->count();

        return view('barberman.dashboard.index') ->with('pelangganCount', $pelangganCount);
    }
}
