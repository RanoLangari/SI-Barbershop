<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BarbermanController extends Controller
{
    public function index()
    {
        $barberman = User::where('role', 'barberman')->get();
        return view('admin.barberman.index', compact('barberman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $data = $request->all();
        $data['role'] = 'barberman';
        $data['password'] = bcrypt('password123');

        User::create($data);
        return redirect()->route('admin.barberman');
    }

    public function update(Request $request, User $barberman)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $barberman->update($request->all());
        return redirect()->route('admin.barberman');
    }

    public function destroy(User $barberman)
    {
        $barberman->delete();
        return redirect()->route('admin.barberman');
    }
}
