<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],  // Maksimal 12 digit dengan 2 angka desimal
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'merk' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'storage' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->all();

        // Cek apakah ada file gambar yang diupload
        if ($request->hasFile('image')) {
            // Simpan file gambar di folder public/images
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath; // Simpan path gambar ke database
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('backend.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],  // Maksimal 12 digit dengan 2 angka desimal
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable'
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
