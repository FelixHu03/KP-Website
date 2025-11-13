<?php

namespace App\Http\Controllers;

use App\Models\DataOrangTua;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DataOrangTuaController extends Controller
{
    public function create()
    {
        $user = Auth::guard('ppdb')->user();
        if ($user->dataOrangTua) {
            return redirect()->route('ppdb.data-orangtua.edit');
        }

        return view('page.ppdb.formulir.formulir-dataOrangTua');
    }
    // fungsi untuk menyimpan data orang tua
    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        // Dapatkan ID user
        $userId = Auth::guard('ppdb')->id();
        $validated['user_ppdb_id'] = $userId;
        DataOrangTua::create($validated);
        return redirect()->route('ppdb-online.index')->with('success', 'Data orang tua berhasil disimpan! Selamat datang.');
    }

    public function edit()
    {
        // Ambil data orang tua dari user yang login
        $dataOrangTua = Auth::guard('ppdb')->user()->dataOrangTua;

        // Jika user belum punya data, paksa dia ke halaman 'create'
        if (!$dataOrangTua) {
            return redirect()->route('ppdb.data-orangtua.create')->with('error', 'Harap isi data Anda terlebih dahulu.');
        }

        // Tampilkan view 'update' dengan data yang ada
        return view('page.ppdb.formulir.updateFormulir-orangTua', [
            'dataOrangTua' => $dataOrangTua
        ]);
    }


    public function update(Request $request)
    {
        // Validasi data yang masuk
        $validated = $this->validateData($request);

        // Ambil data orang tua yang ada
        $dataOrangTua = Auth::guard('ppdb')->user()->dataOrangTua;

        // Update data
        $dataOrangTua->update($validated);

        return redirect()->route('ppdb-online.index')->with('success', 'Data orang tua berhasil diperbarui.');
    }

    // Fungsi validasi data
    private function validateData(Request $request)
    {
        // 1. Tentukan Aturan Validasi
        $rules = [
            'nik_keluarga' => 'required|string |digits:16',
            'nama_ayah' => 'required|string|max:255',
            'nik_ayah' => 'required|string|digits:16', // Menggunakan 'digits:16' (16 digit persis)
            'tanggallahir_ayah' => 'required|date',
            'pendidikan_ayah' => 'required|string',
            'pekerjaan_ayah' => 'required|string|max:255',
            'penghasilan_ayah' => 'required|string',
            'hp_ayah' => 'required|string|digits_between:10,13', 

            'nama_ibu' => 'required|string|max:255',
            'nik_ibu' => 'required|string|digits:16', // Menggunakan 'digits:16'
            'tanggallahir_ibu' => 'required|date',
            'pendidikan_ibu' => 'required|string',
            'pekerjaan_ibu' => 'required|string|max:255',
            'penghasilan_ibu' => 'required|string',
            'hp_ibu' => 'required|string|digits_between:10,13',

            'alamat' => 'required|string',
            'sumber_informasi' => 'required|string',
            
        ];

        // 2. Tentukan Pesan Error Kustom
        $messages = [
            'nik_ayah.digits' => 'Nomor NIK harus 16 digit.',
            'nik_ibu.digits' => 'Nomor NIK harus 16 digit.',
            
            'hp_ayah.digits_between' => 'Nomor Handphone harus 10 sampai 13 digit.',
            'hp_ibu.digits_between' => 'Nomor Handphone harus 10 sampai 13 digit.',
        ];

        // 3. Jalankan Validasi
        return $request->validate($rules, $messages);
    }
}
