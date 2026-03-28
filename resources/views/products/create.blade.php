@extends('Source.master')

@section('content')
<div class="container">
    <h2>Thêm sản phẩm</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Tên sản phẩm"><br><br>

        <input type="number" name="price" placeholder="Giá"><br><br>

        <input type="number" name="stock" placeholder="Số lượng"><br><br>

        <select name="category_id">
            <option value="">-- Chọn loại --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Thêm</button>
    </form>
</div>
@endsection
