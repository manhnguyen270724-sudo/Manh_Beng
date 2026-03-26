<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderByDesc('id')->get();

        return view('users', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'alpha_num', 'unique:users,username'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);

        $username = $validated['username'];

        User::create([
            'name' => $username,
            'username' => $username,
            'email' => $username . '@localhost',
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'Thêm user thành công.');
    }

    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'alpha_num', 'unique:users,username,' . $user->id],
        ]);

        $username = $validated['username'];

        $user->name = $username;
        $user->username = $username;
        $user->email = $username . '@localhost';

        // Chỉ cập nhật mật khẩu nếu người dùng nhập mật khẩu mới
        if ($request->filled('password')) {
            $validatedPassword = $request->validate([
                'password' => ['required', 'string', 'min:3', 'confirmed'],
            ]);

            $user->password = Hash::make($validatedPassword['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Cập nhật user thành công.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Không thể xóa tài khoản đang đăng nhập.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Đã xóa user thành công.');
    }
}

