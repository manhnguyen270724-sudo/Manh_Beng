@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="mb-0">Chi tiết sản phẩm</h3>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">Quay lại</a>
                        </div>

                        <div class="mb-2"><strong>ID:</strong> {{ $product->id }}</div>
                        <div class="mb-2"><strong>Tên:</strong> {{ $product->name }}</div>
                        <div class="mb-2"><strong>Loại:</strong> {{ optional($product->category)->name ?? 'N/A' }}</div>
                        <div class="mb-2"><strong>Giá:</strong> {{ number_format($product->price, 0, ',', '.') }}đ</div>
                        <div class="mb-2"><strong>Số lượng:</strong> {{ $product->stock }}</div>

                        <div class="mt-4 d-flex gap-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Sửa</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="btn btn-danger"
                                    type="submit"
                                    onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')"
                                >
                                    Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

