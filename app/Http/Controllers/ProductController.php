<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
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
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|in:lemari,meja,kursi',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
            'estimated_days' => 'required|integer|min:1',
        ]);

        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('products', $filename, 'public');
        $data = $request->all();

        $product  = new \App\Models\Product;
        $product->name = $request->name;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category = $request->category;
        $product->image = $filename;
        $product->estimated_days = (int) $request->estimated_days; // Menyimpan estimasi waktu
        $product->save();

        return redirect()->route('product.index')->with('success', 'Produk Berhasi Di Buat');
    }

    public function edit($id)
    {

        $product = \App\Models\Product::findOrFail($id);
        return view('pages.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|min:3|unique:products',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|in:lemari,meja,kursi',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
            'estimated_days' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $product) {
            $data = $request->only(['name', 'price', 'stock', 'category', 'estimated_days']);

            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::disk('public')->delete('products/' . $product->image);
                }
                $filename = time() . '.' . $request->image->extension();
                $request->image->storeAs('products', $filename, 'public');
                $data['image'] = $filename;
            }

            $product->update($data);
        });

        return redirect()->route('product.index')->with('success', 'Produk Berhasil Diperbarui');
    }
    public function destroy($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Produk Berhasil Di Hapus !!');
    }
}

    // class ProductController extends Controller
    // {
    //     public function index(Request $request)
    //     {
    //         $products = Product::when($request->input('name'), function ($query, $name) {
    //             return $query->where('name', 'like', '%' . $name . '%');
    //         })
    //             ->orderBy('created_at', 'desc')
    //             ->paginate(10);

    //         return view('pages.products.index', compact('products'));
    //     }

    //     public function create()
    //     {
    //         return view('pages.products.create');
    //     }

    //     public function store(Request $request)
    //     {
    //         $request->validate([
    //             'name' => 'required|min:3|unique:products,name',
    //             'price' => 'required|integer|min:0',
    //             'stock' => 'required|integer|min:0',
    //             'category' => 'required|in:lemari,meja,kursi',
    //             'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
    //             'estimated_days' => 'required|integer|min:1'
    //         ]);

    //         DB::transaction(function () use ($request) {
    //             $filename = time() . '.' . $request->image->extension();
    //             $request->image->storeAs('products', $filename, 'public');

    //             Product::create([
    //                 'name' => $request->name,
    //                 'price' => (int) $request->price,
    //                 'stock' => (int) $request->stock,
    //                 'category' => $request->category,
    //                 'image' => $filename,
    //                 'estimated_days' => (int) $request->estimated_days,
    //             ]);
    //         });

    //         return redirect()->route('product.index')->with('success', 'Product Created Successfully');
    //     }

    //     public function edit($id)
    //     {
    //         $product = Product::findOrFail($id);
    //         return view('pages.products.edit', compact('product'));
    //     }

    //     public function update(Request $request, $id)
    //     {
    //         $product = Product::findOrFail($id);

    //         $request->validate([
    //             'name' => 'required|min:3|unique:products,name,' . $id,
    //             'price' => 'required|integer|min:0',
    //             'stock' => 'required|integer|min:0',
    //             'category' => 'required|in:lemari,meja,kursi',
    //             'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
    //             'estimated_days' => 'required|integer|min:1'
    //         ]);

    //         DB::transaction(function () use ($request, $product) {
    //             $data = $request->only(['name', 'price', 'stock', 'category', 'estimated_days']);

    //             if ($request->hasFile('image')) {
    //                 if ($product->image) {
    //                     Storage::disk('public')->delete('products/' . $product->image);
    //                 }
    //                 $filename = time() . '.' . $request->image->extension();
    //                 $request->image->storeAs('products', $filename, 'public');
    //                 $data['image'] = $filename;
    //             }

    //             $product->update($data);
    //         });

    //         return redirect()->route('product.index')->with('success', 'Product Updated Successfully');
    //     }

    //     public function destroy($id)
    //     {
    //         $product = Product::findOrFail($id);

    //         DB::transaction(function () use ($product) {
    //             if ($product->image) {
    //                 Storage::disk('public')->delete('products/' . $product->image);
    //             }
    //             $product->delete();
    //         });

    //         return redirect()->route('product.index')->with('success', 'Product Deleted Successfully');
    //     }
    // }
