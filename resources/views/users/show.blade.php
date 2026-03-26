@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="mb-4">Chi tiết user</h3>

                        <div class="mb-3">
                            <strong>ID:</strong> {{ $user->id }}
                        </div>
                        <div class="mb-3">
                            <strong>Username:</strong> {{ $user->username }}
                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong> {{ $user->email }}
                        </div>
                        <div class="mb-4">
                            <strong>Tên:</strong> {{ $user->name }}
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Sửa</a>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

