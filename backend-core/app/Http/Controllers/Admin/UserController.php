<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Gunakan helper untuk mendapatkan secret code. Default: 'hackathon123'
    private function getSecretCode()
    {
        return env('ADMIN_SECRET_CODE', 'hackathon123');
    }

    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'access_code' => 'required|string'
        ]);

        if (!hash_equals($this->getSecretCode(), $request->access_code)) {
            return back()->withInput()->withErrors(['access_code' => 'Kode akses khusus salah! Anda tidak berhak menambahkan admin.']);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin baru berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        // Jangan biarkan user superadmin diedit jika bukan dirinya sendiri, tapi untuk simpelnya, biarkan dulu
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'access_code' => 'required|string'
        ]);

        if (!hash_equals($this->getSecretCode(), $request->access_code)) {
            return back()->withInput()->withErrors(['access_code' => 'Kode akses khusus salah! Anda tidak berhak mengubah admin ini.']);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Data Admin berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user)
    {
        // Untuk menghapus, kita juga bisa meminta access_code via form konfirmasi,
        // Tapi untuk mempermudah, kita bisa pakai input hidden atau input langsung.
        // Di sini kita harapkan ada parameter access_code.
        $request->validate([
            'access_code_delete' => 'required|string'
        ]);

        if (!hash_equals($this->getSecretCode(), $request->access_code_delete)) {
            return back()->withErrors(['access_code' => 'Kode akses khusus salah! Gagal menghapus admin.']);
        }

        // Cegah admin menghapus dirinya sendiri
        if (auth()->id() === $user->id) {
            return back()->withErrors(['error' => 'Anda tidak bisa menghapus akun Anda sendiri saat sedang login.']);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Akun Admin berhasil dihapus.');
    }
}
