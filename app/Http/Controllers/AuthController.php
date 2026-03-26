<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegister() {
        return view('auth.register'); // Trỏ tới file register.blade.php
    }

    // Xử lý lưu đăng ký
    public function register(Request $request) {
        $request->validate([
            'username' => 'required|alpha_num|unique:users',
            'password' => 'required|min:3|confirmed',
        ]);

        User::create([
            'name' => $request->username,
            'username' => $request->username,
            'email' => $request->username . '@localhost',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công, vui lòng đăng nhập!');
    }

    // Hiển thị form đăng nhập
    public function showLogin() {
        return view('auth.login'); // Trỏ tới file login.blade.php
    }

    // Xử lý kiểm tra đăng nhập
    public function login(Request $request) {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('users.index'); // Đăng nhập xong đẩy về trang Quản lý User
        }

        return back()->with('error', 'Sai tài khoản hoặc mật khẩu!');
    }

    // Xử lý Đăng xuất
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}