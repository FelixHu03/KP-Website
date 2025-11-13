<?php

namespace App\Http\Controllers;

use App\Models\ppdbOnline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PpdbOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.ppdb.ppdb-online');
    }

    public function showPendaftaranPage()
    {
        return view('page.ppdb.pendaftaranPpdb');
    }
    public function showFormulir(Request $request, string $jenjang)
    {
        // Validasi sederhana agar URL-nya aman
        $jenjang_valid = strtoupper($jenjang);
        if (!in_array($jenjang_valid, ['TK', 'SD', 'SMP'])) {
            // Jika jenjang tidak valid, kembalikan ke halaman pendaftaran
            return redirect()->route('ppdb-online.pendaftaran');
        }

        // Kirim 'jenjang' ke view
        return view('page.ppdb.formulir.formulir-ppdb', [
            'jenjang_dipilih' => $jenjang_valid
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data anak (dari step 1 formulir)
        $validated = $request->validate([
            'jenjang_dipilih' => 'required|string',
            'tahun_ajaran' => 'required|string',
            'namalengkap' => 'required|string|max:255',
            'namapanggilan' => 'required|string|max:255',
            'nik' => 'required|string|unique:ppdb_onlines,nik',
            'tempatlahir' => 'required|string',
            'tanggallahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'vegetarian' => 'required|string',
            'handphone' => 'required|string',

            // Validasi kondisional (jika bukan TK)
            'asalsekolah' => 'required_if:jenjang_dipilih,SD,SMP',
            'nins' => 'required_if:jenjang_dipilih,SD,SMP',

            // Validasi kondisional (jika SMP)
            'nilai_ijazah' => 'required_if:jenjang_dipilih,SMP',
            'foto_raport' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        // 2. Tambahkan ID User (Orang Tua) yang sedang login
        $validated['user_ppdb_id'] = Auth::guard('ppdb')->id();

        // 3. Handle upload file jika ada
        if ($request->hasFile('foto_raport')) {
            // Simpan file dan dapatkan path-nya
            $path = $request->file('foto_raport')->store('raport', 'public');
            $validated['foto_raport'] = $path;
        }

        // 4. Simpan data anak ke database
        ppdbOnline::create($validated);

        // 5. Arahkan kembali ke dashboard
        return redirect()->route('ppdb-online.index')->with('success', 'Data anak berhasil didaftarkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ppdbOnline $ppdbOnline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ppdbOnline $ppdbOnline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ppdbOnline $ppdbOnline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ppdbOnline $ppdbOnline)
    {
        //
    }
}
