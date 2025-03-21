<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua order.
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return view('pages.order.index', compact('orders'));
    }

    /**
     * Menampilkan form untuk membuat order baru.
     */
    public function create()
    {
        return view('pages.order.create');
    }

    /**
     * Menyimpan order baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'no_order' => 'required|unique:orders',
            'nama_costumer' => 'required|string|max:255',
            'tanggal_order' => 'required|date',
            'total_harga' => 'required|numeric',
            'status' => 'required|in:pending,processing,completed,canceled',
        ]);

        // Simpan data ke database
        Order::create($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('order.index')->with('success', 'Order berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail dari satu order tertentu.
     */
    public function show(Order $order)
    {
        return view('pages.order.show', compact('order'));
    }

    /**
     * Menampilkan form edit untuk order.
     */
    public function edit(Order $order)
    {
        return view('pages.order.edit', compact('order'));
    }

    /**
     * Memperbarui data order di database.
     */
    public function update(Request $request, Order $order)
    {
        // Validasi input
        $request->validate([
            'no_order' => 'sometimes|required|unique:orders,no_order,' . $order->id,
            'nama_costumer' => 'sometimes|required|string|max:255',
            'tanggal_order' => 'sometimes|required|date',
            'total_harga' => 'sometimes|required|numeric',
            'status' => 'sometimes|required|in:tertunda,tertunda',
            'sedang di proses',
            'selesai',
            'di batalkan',
        ]);

        // Update data order
        $order->update($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('order.index')->with('success', 'Order berhasil diperbarui!');
    }

    /**
     * Menghapus order dari database.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('order.index')->with('success', 'Order berhasil dihapus !!');
    }
}
