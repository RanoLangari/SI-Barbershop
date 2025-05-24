<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Kategori_Layanan;
use App\Models\Layanan;
use App\Models\User;

class OrderController extends Controller
{
    
    public function index()
    {
        // Logic to fetch and display orders with explicit eager loading
        $orders = Order::with(['kategori', 'layanan', 'barberman', 'user'])->paginate(10);
        
        // Get data for dropdowns in forms
        $kategoris = Kategori_Layanan::all();
        $layanans = Layanan::all();
        $barbermen = User::where('role', 'barberman')->get();
        
        return view('admin.order.index', compact('orders', 'kategoris', 'layanans', 'barbermen'));
    }

    public function store(Request $request)
    {
        // Validasi
        $validatedData = $request->validate([
            'kategori_id' => 'required|exists:kategori_layanan,id',
            'id_layanan' => 'required|exists:layanan,id',
            'id_barberman' => 'required|exists:users,id',
            'metode_pembayaran' => 'required|in:tunai,non_tunai',
            'nama_pemesan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
        ]);

        Order::create($validatedData);

        return redirect()->route('admin.order')->with('success', 'Order created successfully.');
    }

    public function update(Request $request, Order $order)
    {
        // Logic to update an order
        $validatedData = $request->validate([
            'kategori_id' => 'required|exists:kategori_layanan,id',
            'id_layanan' => 'required|exists:layanan,id',
            'id_barberman' => 'required|exists:users,id',
            'metode_pembayaran' => 'required|in:tunai,non_tunai',
            'nama_pemesan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
        ]);

        $order->update($validatedData);

        return redirect()->route('admin.order')->with('update_success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.order')->with('delete_success', 'Order deleted successfully.');
    }
}
