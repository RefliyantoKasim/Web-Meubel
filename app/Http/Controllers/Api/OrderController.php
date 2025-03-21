<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua order.
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Daftar semua order',
            'data' => $orders
        ], Response::HTTP_OK);
    }

    /**
     * Menyimpan order baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'no_order' => 'required|unique:orders',
            'nama_costumer' => 'required|string|max:255',
            'tanggal_order' => 'required|date',
            'total_harga' => 'required|numeric',
            'status' => 'required|in:pending,processing,completed,canceled',
        ]);

        // Simpan data ke database
        $order = Order::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil ditambahkan!',
            'data' => $order
        ], Response::HTTP_CREATED);
    }

    /**
     * Menampilkan detail dari satu order tertentu.
     */
    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail order',
            'data' => $order
        ], Response::HTTP_OK);
    }

    /**
     * Memperbarui data order di database.
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        // Validasi input
        $validatedData = $request->validate([
            'no_order' => 'sometimes|required|unique:orders,no_order,' . $order->id,
            'nama_costumer' => 'sometimes|required|string|max:255',
            'tanggal_order' => 'sometimes|required|date',
            'total_harga' => 'sometimes|required|numeric',
            'status' => 'sometimes|required|in:pending,processing,completed,canceled',
        ]);

        // Update data order
        $order->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil diperbarui!',
            'data' => $order
        ], Response::HTTP_OK);
    }

    /**
     * Menghapus order dari database.
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil dihapus!'
        ], Response::HTTP_OK);
    }
}
