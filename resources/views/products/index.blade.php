@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Quản lý sản phẩm</h3>
            <form method="GET" action="{{ route('products.index') }}" class="mb-3 d-flex gap-2">

    <input type="text" name="name" placeholder="Tìm tên..." class="form-control">

    <select name="category_id" class="form-select">
        <option value="">-- Tất cả loại --</option>
        @foreach($categories as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>

    <select name="sort" class="form-select">
        <option value="">-- Sắp xếp --</option>
        <option value="asc">Giá tăng</option>
        <option value="desc">Giá giảm</option>
    </select>

    <button class="btn btn-secondary">Áp dụng</button>
</form>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                Thêm sản phẩm
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Tên</th>
                        <th>Loại</th>
                        <th style="width: 120px;">Giá</th>
                        <th style="width: 120px;">Số lượng</th>
                        <th style="width: 240px;" class="text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                             <a href="{{ route('products.show', $product->id) }}">
                             {{ $product->name }}
                            </a>
                            </td>
                            <td>{{ optional($product->category)->name ?? 'N/A' }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }}đ</td>
                            <td>{{ $product->stock }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">Xem</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="btn btn-sm btn-danger"
                                            type="submit"
                                            onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')"
                                        >
                                            Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
