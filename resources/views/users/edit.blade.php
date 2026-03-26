@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="mb-4">Sửa user</h3>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input
                                    id="username"
                                    name="username"
                                    type="text"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username', $user->username) }}"
                                    required
                                    autofocus
                                >
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu mới (bỏ trống nếu không đổi)</label>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                >
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                                <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                >
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-primary" type="submit">Cập nhật</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

