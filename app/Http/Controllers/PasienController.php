<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PasienController extends Controller
{
    /**
     * Menampilkan daftar semua pasien.
     */
    public function index()
    {
        // Mengambil semua data pasien, dan memuat relasi 'user' untuk mendapatkan nama dan email.
        $pasiens = Pasien::with('user')->latest()->get();
        
        // Mengarahkan ke view 'pasien.index' dengan data pasien.
        return view('pasien.index', compact('pasiens'));
    }

    /**
     * Menampilkan formulir untuk membuat pasien baru.
     */
    public function create()
    {
        // Mengarahkan ke view 'pasien.create'
        return view('pasien.create');
    }

    /**
     * Menyimpan data pasien baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            // Validasi untuk tabel users
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Email harus unik
            'password' => 'required|string|min:8|confirmed',
            
            // Validasi untuk tabel pasien
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P', // ENUM(L,P)
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'tinggi_badan' => 'nullable|numeric|max:300',
            'berat_badan' => 'nullable|numeric|max:500',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
        ]);

        // 2. Simpan data Pasien dan User dalam Transaksi
        // Transaksi memastikan kedua operasi (User dan Pasien) berhasil atau gagal bersama.
        DB::beginTransaction();
        try {
            // A. Buat data User terlebih dahulu
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'pasien', // Tetapkan role sebagai 'pasien'
            ]);

            // B. Buat data Pasien, menghubungkan dengan user_id yang baru dibuat
            Pasien::create([
                'user_id' => $user->id,
                'golongan_darah' => $request->golongan_darah,
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => $request->berat_badan,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]);

            DB::commit(); // Konfirmasi perubahan ke database
            return redirect()->route('pasien.index')->with('success', 'Data Pasien baru berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika ada kegagalan
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data Pasien. Silakan coba lagi.']);
        }
    }

    /**
     * Menampilkan detail pasien tertentu.
     */
    public function show(Pasien $pasien)
    {
        // Memuat detail user dan riwayat medis
        $pasien->load('user', 'rekamMedis', 'alergi'); 

        return view('pasien.show', compact('pasien'));
    }

    /**
     * Menampilkan formulir untuk mengedit data pasien.
     */
    public function edit(Pasien $pasien)
    {
        // Pastikan relasi user dimuat
        $pasien->load('user');
        
        return view('pasien.edit', compact('pasien'));
    }

    /**
     * Memperbarui (update) data pasien di database.
     */
    public function update(Request $request, Pasien $pasien)
    {
        // 1. Validasi Input
        $request->validate([
            // Email harus unik kecuali untuk email pasien ini sendiri
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($pasien->user->id)],
            'password' => 'nullable|string|min:8|confirmed', // Password opsional saat update
            
            // Validasi untuk tabel pasien
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'tinggi_badan' => 'nullable|numeric|max:300',
            'berat_badan' => 'nullable|numeric|max:500',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
        ]);

        // 2. Update data dalam Transaksi
        DB::beginTransaction();
        try {
            // A. Update data User
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
            ];
            
            // Hanya update password jika diisi
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $pasien->user->update($userData);

            // B. Update data Pasien
            $pasien->update($request->only([
                'golongan_darah',
                'tinggi_badan',
                'berat_badan',
                'tanggal_lahir',
                'jenis_kelamin',
                'alamat',
                'no_hp',
            ]));

            DB::commit();
            return redirect()->route('pasien.index')->with('success', 'Data Pasien berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Gagal memperbarui data Pasien. Silakan coba lagi.']);
        }
    }

    /**
     * Menghapus data pasien dari database.
     */
    public function destroy(Pasien $pasien)
    {
        // Gunakan Transaksi karena melibatkan dua tabel (User dan Pasien)
        DB::beginTransaction();
        try {

            

            DB::commit();
            return redirect()->route('pasien.index')->with('success', 'Data Pasien berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menghapus data Pasien.']);
        }
    }
}