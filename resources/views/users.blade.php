@extends('layouts.app') @section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0 text-dark">
            <i class="fas fa-users me-2"></i> Quản lý User
        </h2>
        <span class="text-muted fw-bold">
            <i class="fas fa-user-circle me-1"></i> Xin chào, {{ Auth::user()->username ?? 'hieupc' }}
        </span>
    </div>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-success px-3 py-2 shadow-sm">
            <i class="fas fa-user-plus me-1"></i> Thêm User
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="py-3 px-4" style="width: 5%">#</th>
                        <th scope="col" class="py-3 px-4" style="width: 20%">Username</th>
                        <th scope="col" class="py-3 px-4 text-center" style="width: 20%">Hành động</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($users as $key => $user)
                    <tr>
                        <td class="align-middle px-4 fw-bold">{{ $key + 1 }}</td>
                        <td class="align-middle px-4">
                            <i class="far fa-user text-secondary me-2"></i> {{ $user->username }}
                        </td>
                        <td class="align-middle text-center px-4">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm px-3 py-1">
                                    Xem
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm px-3 py-1">
                                    Sửa
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm px-2 py-1" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?');" title="Xóa">
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
    </div>
</div>
@endsection