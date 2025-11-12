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
        return $request->validate([
            'nama_ayah' => 'required|string|max:255',
            'nik_ayah' => 'required|string|max:16',
            'tanggallahir_ayah' => 'required|date',
            'pendidikan_ayah' => 'required|string',
            'pekerjaan_ayah' => 'required|string|max:255',
            'penghasilan_ayah' => 'required|string',
            'hp_ayah' => 'required|string|max:13',

            'nama_ibu' => 'required|string|max:255',
            'nik_ibu' => 'required|string|max:16',
            'tanggallahir_ibu' => 'required|date',
            'pendidikan_ibu' => 'required|string',
            'pekerjaan_ibu' => 'required|string|max:255',
            'penghasilan_ibu' => 'required|string',
            'hp_ibu' => 'required|string|max:13',

            'alamat' => 'required|string',
            'sumber_informasi' => 'required|string',
        ]);
    }
}
