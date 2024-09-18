<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    // Tampilkan halaman profil pengguna
    public function show()
    {
        $user = Auth::user(); // Ambil data pengguna yang sedang login
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(), // Pastikan email unik
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed', // Password tidak wajib diisi
        ]);

        $user = Auth::user();

        // Update data pengguna
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        // Jika password baru diisi, maka lakukan perubahan password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan
        $user->save();

        // Redirect kembali dengan pesan sukses
        return Redirect::to('/profile')->with('success', 'Data berhasil diupdate');
    }
}
