<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules; // Untuk password rule

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::with('user')->latest()->paginate(10);
        return view('admin.karyawan.index', compact('karyawans')); // Buat view ini
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.karyawan.create'); // Buat view ini
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nik' => ['nullable', 'string', 'max:20', 'unique:' . Karyawan::class],
            'alamat' => ['nullable', 'string'],
            'no_telepon' => ['nullable', 'string', 'max:15'],
            'posisi' => ['required', 'string', 'max:100'],
            'tanggal_masuk' => ['required', 'date'],
            'gaji_pokok' => ['required', 'numeric', 'min:0'],
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'karyawan',
            ]);

            $karyawan = new Karyawan([
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'posisi' => $request->posisi,
                'tanggal_masuk' => $request->tanggal_masuk,
                'gaji_pokok' => $request->gaji_pokok,
            ]);
            $user->karyawan()->save($karyawan);

            DB::commit();
            return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log error $e->getMessage()
            return back()->withInput()->with('error', 'Gagal menambahkan karyawan. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        $karyawan->load('user');
        return view('admin.karyawan.show', compact('karyawan')); // Buat view ini
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        $karyawan->load('user');
        return view('admin.karyawan.edit', compact('karyawan')); // Buat view ini
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
         $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class.',email,'.$karyawan->user_id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'nik' => ['nullable', 'string', 'max:20', 'unique:'.Karyawan::class.',nik,'.$karyawan->id],
            'alamat' => ['nullable', 'string'],
            'no_telepon' => ['nullable', 'string', 'max:15'],
            'posisi' => ['required', 'string', 'max:100'],
            'tanggal_masuk' => ['required', 'date'],
            'gaji_pokok' => ['required', 'numeric', 'min:0'],
        ]);

        DB::beginTransaction();
        try {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
            ];
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            $karyawan->user()->update($userData);

            $karyawan->update([
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'posisi' => $request->posisi,
                'tanggal_masuk' => $request->tanggal_masuk,
                'gaji_pokok' => $request->gaji_pokok,
            ]);

            DB::commit();
            return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log error $e->getMessage()
            return back()->withInput()->with('error', 'Gagal memperbarui data karyawan. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        DB::beginTransaction();
        try {
            // Hapus user akan otomatis menghapus karyawan karena onDelete('cascade')
            // dan juga absensi serta gaji yang terkait dengan karyawan tersebut.
            $karyawan->user->delete();
            DB::commit();
            return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log error $e->getMessage()
            return back()->with('error', 'Gagal menghapus karyawan. Silakan coba lagi.');
        }
    }
}
