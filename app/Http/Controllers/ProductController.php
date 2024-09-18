<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('backend.products.index', compact('products'));
    }

    public function detailProductsCustomer($id)
    {
        $product = Product::findOrFail($id); // Mengambil produk berdasarkan ID
        return view('frontend.detail-products.index', compact('product'));
    }

    public function showProductsForCustomer(Request $request)
    {
        // Ambil semua kategori untuk sidebar
        $categories = Category::with('products')->get();
        $brands = Product::select('merk')->distinct()->get(); // Ambil merk unik

        // Ambil filter dari request
        $selectedCategory = $request->input('category_id'); // Ambil kategori yang dipilih
        $selectedBrands = $request->input('brands'); // Filter merk (jika ada)
        $sortPrice = $request->input('sort_price'); // Filter harga (jika ada)

        // Query produk
        $productsQuery = Product::query()->with('category');

        // Filter berdasarkan kategori
        if ($selectedCategory) {
            $productsQuery->where('category_id', $selectedCategory);
        }

        // Filter berdasarkan merk
        if ($selectedBrands) {
            $productsQuery->whereIn('merk', $selectedBrands);
        }

        // Urutkan produk berdasarkan harga
        if ($sortPrice) {
            $productsQuery->orderBy('price', $sortPrice);
        }

        // Eksekusi query
        $products = $productsQuery->get();

        // Pastikan variabel yang sesuai diteruskan ke view
        return view('frontend.products-cust.index', compact('products', 'categories', 'brands'));
    }

    public function filterProducts(Request $request)
    {
        $productsQuery = Product::query();

        // Filter berdasarkan kategori
        if ($request->has('categories') && !empty($request->categories)) {
            $productsQuery->whereIn('category_id', $request->categories);
        }

        // Filter berdasarkan merk
        if ($request->has('brands') && !empty($request->brands)) {
            $productsQuery->whereIn('merk', $request->brands);
        }

        // Urutkan berdasarkan harga
        if ($request->has('sort_price') && !empty($request->sort_price)) {
            if ($request->sort_price == 'low_to_high') {
                $productsQuery->orderBy('price', 'asc');
            } elseif ($request->sort_price == 'high_to_low') {
                $productsQuery->orderBy('price', 'desc');
            }
        }

        $products = $productsQuery->get();

        // Return HTML yang diperbarui
        $view = view('frontend.products-cust.filtered-products', compact('products'))->render();

        return response()->json($view);
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
            'price' => ['required', 'numeric', 'min:0', 'max:9999999999'],  // Maksimal 12 digit dengan 2 angka desimal
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'merk' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'storage' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->all();

        if (!isset($data['category_id'])) {
            $data['category_id'] = 53; // Set default category_id ke 53
        }

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
            'price' => ['required', 'numeric', 'min:0', 'max:9999999999'],  // Maksimal 12 digit dengan 2 angka desimal
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tambahkan validasi untuk gambar, tapi opsional
        ]);

        $data = $request->all();

        // Jika ada gambar yang diunggah, simpan gambarnya
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath; // Simpan path gambar ke dalam data
        }

        // Update produk dengan data baru
        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Ambil produk yang sesuai dengan kata kunci pencarian
        $products = Product::where('name', 'LIKE', "%$query%")
            ->orWhere('merk', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->get();

        // Tampilkan halaman pencarian dengan hasil
        return view('frontend.products-cust.search-result', compact('products', 'query'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.detail-products.index', compact('product'));
    }

    public function topSelling()
    {
        // Ambil data produk dengan jumlah total terjual
        $topSellingProducts = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->limit(10) // Batasi ke 10 produk teratas
            ->get();

        // Tampilkan halaman dengan data produk
        return view('frontend.homePageUser', compact('topSellingProducts'));
    }
}
