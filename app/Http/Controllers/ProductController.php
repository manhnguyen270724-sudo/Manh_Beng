<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private function ensureDefaultCategory(): void
    {
        if (Category::count() > 0) {
            return;
        }

        // Tạo category mặc định để tránh lỗi validate khi bảng categories đang trống.
        Category::create([
            'name' => 'Default',
        ]);
    }

    //Xem danh sách
   public function index(Request $request)
{
    $query = Product::with('category');

    //tìm theo tên
    if ($request->name) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    //lọc theo category
    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    //sắp xếp giá
    if ($request->sort == 'asc') {
        $query->orderBy('price', 'asc');
    } elseif ($request->sort == 'desc') {
        $query->orderBy('price', 'desc');
    }

    $products = $query->paginate(10);

    // lấy category cho dropdown
    $categories = Category::all();

    return view('products.index', compact('products', 'categories'));
}


    // 2. Hiển thị form thêm
    public function create()
    {
        $this->ensureDefaultCategory();
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    // 3. Lưu sản phẩm mới
    public function store(Request $request)
    {
        $this->ensureDefaultCategory();

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id'
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')
                         ->with('success', 'Thêm thành công!');
    }

    // 4. Hiển thị form sửa
    public function edit($id)
    {
        $this->ensureDefaultCategory();

        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    // 5. Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $this->ensureDefaultCategory();

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')
                         ->with('success', 'Cập nhật thành công!');
    }

    // 6. Xóa sản phẩm
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect()->route('products.index')
                         ->with('success', 'Đã xóa sản phẩm!');
    }

    // Hiển thị chi tiết sản phẩm
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        return view('products.show', compact('product'));
    }
}
