<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Get data products
        $products = DB::table('products')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.products.index', compact('products'));
    }

    public function create()
    {
        return view('pages.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:products',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|in:lemari,meja,kursi',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'estimated_days' => 'required|integer|min:1', // Validasi estimasi waktu
        ]);

        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('products', $filename, 'public');

        $product = new Product();
        $product->name = $request->name;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category = $request->category;
        $product->image = $filename;
        $product->estimated_days = (int) $request->estimated_days; // Simpan estimasi waktu
        $product->save();

        return redirect()->route('product.index')->with('success', 'Produk Berhasil Dibuat');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|in:lemari,meja,kursi',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'estimated_days' => 'required|integer|min:1', // Validasi estimasi waktu
        ]);

        $filename = $product->image;

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('products', $filename, 'public');
        }

        $product->update([
            'name' => $request->name,
            'price' => (int) $request->price,
            'stock' => (int) $request->stock,
            'category' => $request->category,
            'image' => $filename,
            'estimated_days' => (int) $request->estimated_days, // Update estimasi waktu
        ]);

        return redirect()->route('product.index')->with('success', 'Produk Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Produk Berhasil Dihapus');
    }
}
