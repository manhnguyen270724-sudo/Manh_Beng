<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. Xem danh sách
    // public function index()
    // {
    //     $products = Product::with('category')->get();
    //     $categories = Category::all();

    //     return view('products.index', compact('products', 'categories'));
    // }

    public function index() {
    return "Chào Bèng, nếu thấy dòng này thì lỗi nằm ở Database!";
}
    // 2. Hiển thị form thêm
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // 3. Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
                         ->with('success', 'Thêm thành công!');
    }

    // 4. Hiển thị form sửa
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    // 5. Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required'
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

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
}
