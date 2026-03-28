@extends('Source.master')

@section('content')
<div class="space50">&nbsp;</div>

<div class="container beta-relative">

  {{-- Thống kê --}}
  <div class="row">
    <div class="col-12 col-md-6" style="background: red;color:white;padding:10px;">
      Số sản phẩm: {{ count($products) }}
    </div>

    <div class="col-12 col-md-6" style="background: blue;color:white;padding:10px;">
      Đã bán:
      <p>Tổng: {{ $sumSold ?? 0 }}</p>
      <p>Hôm nay: 1</p>
      <p>Tháng này: 3</p>
      <p>Năm nay: 4</p>
    </div>
  </div>

  <div class="space20"></div>

  {{-- Tiêu đề + nút --}}
  <div class="d-flex justify-content-between">
    <h2>Danh sách sản phẩm</h2>

    <div>
      <a href="#" class="btn btn-secondary">Xuất PDF</a>
      <a href="{{ route('products.create') }}" class="btn btn-primary">Add</a>
    </div>
  </div>

  <div class="space20"></div>

  {{-- Table --}}
  <table id="table_admin_product" class="table table-striped display">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Loại</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Thao tác</th>
      </tr>
    </thead>

    <tbody>
      @foreach($products as $product)
      <tr>
        <td>{{ $product->id }}</td>

        <td>{{ $product->name }}</td>

        {{-- category --}}
        <td>{{ $product->category->name ?? 'N/A' }}</td>

        <td>{{ number_format($product->price) }}đ</td>

        <td>{{ $product->stock }}</td>

        <td>
          {{-- Edit --}}
          <a href="{{ route('products.edit', $product->id) }}"
             class="btn btn-warning btn-sm">
             Edit
          </a>

          {{-- Delete --}}
          <form action="{{ route('products.destroy', $product->id) }}"
                method="POST"
                style="display:inline;">
            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Bạn có chắc muốn xóa không?')">
              Delete
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="space50">&nbsp;</div>
</div>

<script>
$(document).ready(function() {
  $('#table_admin_product').DataTable();
});
</script>
@endsection
