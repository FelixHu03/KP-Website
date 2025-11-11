<?php

namespace App\Http\Controllers;

use App\Models\DataOrangTua;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DataOrangTuaController extends Controller
{
    public function create()
    {
        return view('page.ppdb.formulir.formulir-dataOrangTua');
    }

    /**
     * Simpan data orang tua yang baru.
     */
    public function store(Request $request)
    {
        // 1. Validasi semua input
        $validated = $request->validate([
            'nama_ayah' => 'required|string|max:255',
            'nik_ayah' => 'required|string|max:20',
            'tanggallahir_ayah' => 'required|date',
            'pendidikan_ayah' => 'required|string',
            'pekerjaan_ayah' => 'required|string|max:255',
            'penghasilan_ayah' => 'required|string',
            'hp_ayah' => 'required|string|max:15',
            
            'nama_ibu' => 'required|string|max:255',
            'nik_ibu' => 'required|string|max:20',
            'tanggallahir_ibu' => 'required|date',
            'pendidikan_ibu' => 'required|string',
            'pekerjaan_ibu' => 'required|string|max:255',
            'penghasilan_ibu' => 'required|string',
            'hp_ibu' => 'required|string|max:15',
            
            'alamat' => 'required|string',
            'sumber_informasi' => 'required|string',
        ]);

        // 2. Dapatkan ID user yang sedang login
        $userId = Auth::guard('ppdb')->id();

        // 3. Tambahkan user_id ke data yang divalidasi
        $validated['user_ppdb_id'] = $userId;

        // 4. Buat data orang tua
        DataOrangTua::create($validated);

        // 5. Arahkan ke dashboard utama
        return redirect()->route('ppdb-online.index')->with('success', 'Data orang tua berhasil disimpan! Selamat datang.');
    }
}
