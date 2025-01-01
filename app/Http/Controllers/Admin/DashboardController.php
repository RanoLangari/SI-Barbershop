<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pelangganCount = User::where('role', 'pelanggan')->count();


        return view('admin.dashboard.index') ->with('pelangganCount', $pelangganCount);
    }
}
