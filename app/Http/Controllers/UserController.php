<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Menampilkan semua user beserta relasi
    public function index()
    {
        return response()->json(User::with(['cars', 'rentals', 'reviews'])->get());
    }

    // Register user baru
    public function store(Request $request)
    {
        // Validasi input untuk registrasi
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email', // Pastikan email unik
            'phone' => 'nullable|string',
            'password' => 'required|string|min:6',
        ]);

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Buat user baru
        $user = User::create($validated);

        // Login setelah registrasi berhasil
        Auth::login($user);

        return redirect()->route('signin'); // Redirect ke halaman profile untuk melengkapi data
    }

    // Tampilkan data user tertentu (menggunakan user_id)
    public function show()
    {
        $user = Auth::user();

        if ($user) {
            return view('profile.show', compact('user')); // Asumsi kamu punya view 'profile.show'
        } else {
            return redirect()->route('signin'); // Redirect jika tidak ada yang login
        }
    }

    // Update user (menggunakan Auth::id() yang akan merujuk ke user_id)
    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('signin'); // Atau handle jika tidak ada user login
        }

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => ['sometimes','email',Rule::unique('users', 'email')->ignore($user->user_id, 'user_id'),],
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'identity_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'password' => 'nullable|string|min:6', // Hilangkan 'confirmed' jika tidak ada input konfirmasi
            'driving_license' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'name_bank' => 'nullable|string',
            'bank_number' => 'nullable|string',
        ]);

        // Proses upload file (seperti yang sudah ada)
        if ($request->hasFile('identity_card')) {
            if ($user->identity_card) {
                Storage::delete($user->identity_card);
            }
            $validated['identity_card'] = $request->file('identity_card')->store('identity_cards', 'public');
        }

        if ($request->hasFile('driving_license')) {
            if ($user->driving_license) {
                Storage::delete($user->driving_license);
            }
            $validated['driving_license'] = $request->file('driving_license')->store('driving_licenses', 'public');
        }

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // Jangan update kalau kosong
        }

        $user->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }

    // Hapus user (menggunakan user_id dari parameter route)
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Laravel akan mencari berdasarkan primary key (yang seharusnya sudah diatur ke 'user_id' di model)
        $user->delete();

        Auth::logout(); // Logout user dulu

        return redirect()->route('home')->with('success', 'Akun Anda telah dihapus.');
    }

    // Login/signin user
    public function signin(Request $request)
    {
        // Validasi input signin
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Cek apakah user ada
        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401); // Unauthorized
        }

        // Signin user
        Auth::login($user);

        return redirect()->route('profile.show'); // Redirect ke halaman profile untuk melengkapi data
    }
}