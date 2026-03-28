@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="mb-4">Thêm sản phẩm</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('products.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="name">Tên sản phẩm</label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    required
                                    autofocus
                                >
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="price">Giá</label>
                                <input
                                    id="price"
                                    name="price"
                                    type="number"
                                    step="0.01"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price') }}"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="stock">Số lượng</label>
                                <input
                                    id="stock"
                                    name="stock"
                                    type="number"
                                    class="form-control @error('stock') is-invalid @enderror"
                                    value="{{ old('stock') }}"
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="category_id">Loại</label>
                                <select
                                    id="category_id"
                                    name="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Chọn loại --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-success" type="submit">Thêm</button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
