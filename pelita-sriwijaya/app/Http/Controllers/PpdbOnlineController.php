<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\DokumenCalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;


use Exception;
use Illuminate\Support\Facades\Log;

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
    public function showRiwayat()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::guard('ppdb')->id();

        $riwayatList = CalonSiswa::where('user_ppdb_id', $userId)
            ->select('id', 'namalengkap', 'nik', 'tanggallahir', 'jenjang_dipilih', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        // Tampilkan view list dan kirim datanya
        return view('page.ppdb.riwayat-pendaftaran', [
            'riwayatList' => $riwayatList
        ]);
    }
    public function showDetailRiwayat($id)
    {
        // Ambil data siswa, tapi juga load relasi '
        $calonSiswa = CalonSiswa::with(['dokumen', 'user.dataOrangTua'])
            ->where('id', $id)
            ->where('user_ppdb_id', Auth::guard('ppdb')->id()) // Keamanan: pastikan ini milik user yg login
            ->firstOrFail(); // Akan error 404 jika bukan miliknya

        // Tampilkan view detail dan kirim datanya
        return view('page.ppdb.detail-pendaftaran', [
            'siswa' => $calonSiswa
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
        $validated = $request->validate([
            'jenjang_dipilih' => 'required|string',
            'tahun_ajaran' => 'required|string',
            'namalengkap' => 'required|string|max:255',
            'namapanggilan' => 'required|string|max:255',
            'nik' => 'required|string|unique:calon_siswas,nik',
            'tempatlahir' => 'required|string',
            'tanggallahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'vegetarian' => 'required|string',
            'handphone' => 'required|string|digits_between:10,13',
            'akta_kelahiran' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
            'foto_raport'   => 'required_if:jenjang_dipilih,SMP|file|mimes:jpg,png,jpeg,pdf|max:2048',
            'asalsekolah'   => 'required_if:jenjang_dipilih,SD,SMP|nullable|string',
            'nins'          => 'required_if:jenjang_dipilih,SMP|nullable|string',
            'nilai_ijazah'  => 'required_if:jenjang_dipilih,SMP|nullable|numeric',
            'konfirmasi_data_ortu' => 'required',
        ]);

        $validated['user_ppdb_id'] = Auth::guard('ppdb')->id();

        $aktaFile  = $request->file('akta_kelahiran');
        $raportFile = $request->file('foto_raport');

        unset($validated['akta_kelahiran'], $validated['foto_raport']);

        // Variabel $calonSiswa kita deklarasikan di luar try
        $calonSiswa = null;

        try { // <-- MULAI TRY DI SINI

            $calonSiswa = CalonSiswa::create($validated);
            $studentId = $calonSiswa->id;

            $manager = new ImageManager(new Driver());
            $jenjang = strtolower($validated['jenjang_dipilih']);
            $namaSlug = Str::slug($validated['namalengkap'], '_');
            $basePath = "dokumen_siswa/{$jenjang}/{$studentId}";

            $saveFile = function ($file, $jenisDokumen) use ($manager, $basePath, $namaSlug) {
                $ext  = strtolower($file->getClientOriginalExtension());
                $isPdf = ($ext === 'pdf');
                $finalName = $jenisDokumen . '_' . $namaSlug . '.' . ($isPdf ? 'pdf' : 'jpg');
                $path = "{$basePath}/{$finalName}";

                if ($isPdf) {
                    Storage::disk('public')->put($path, file_get_contents($file));
                } else {
                    $image = $manager->read($file);
                    $image->resize(1200, null, fn($c) => $c->aspectRatio()->upsize());
                    $encoded = $image->toJpeg(85);
                    Storage::disk('public')->put($path, (string)$encoded);
                }
                return $path;
            };

            // Proses Akta Kelahiran
            if ($aktaFile) {
                $pathAkta = $saveFile($aktaFile, "akta_kelahiran");

                $calonSiswa->dokumen()->create([
                    'jenis_dokumen'     => 'AKTA_KELAHIRAN',
                    'nama_file_asli'    => $aktaFile->getClientOriginalName(),
                    'path_penyimpanan'  => $pathAkta,
                    'tipe_file'         => $aktaFile->getMimeType(),
                    'ukuran_file'       => $aktaFile->getSize(),
                    'status_verifikasi' => 'Diunggah',
                ]);
            }

            // Proses Foto Raport
            if ($raportFile) {
                $pathRaport = $saveFile($raportFile, "foto_raport");

                $calonSiswa->dokumen()->create([
                    'jenis_dokumen'     => 'FOTO_RAPORT',
                    'nama_file_asli'    => $raportFile->getClientOriginalName(),
                    'path_penyimpanan'  => $pathRaport,
                    'tipe_file'         => $raportFile->getMimeType(),
                    'ukuran_file'       => $raportFile->getSize(),
                    'status_verifikasi' => 'Diunggah',
                ]);
            }
        } catch (Exception $e) { // <-- TANGKAP ERROR DI SINI

            // Jika siswa telanjur dibuat, hapus lagi (rollback)
            if ($calonSiswa) {
                $calonSiswa->delete();
            }

            // Catat error di log server
            Log::error('Gagal mendaftar siswa: ' . $e->getMessage() . ' di baris ' . $e->getLine());

            // Kembalikan ke formulir DENGAN PESAN ERROR
            return back()->withInput()->withErrors([
                'file_upload' => 'Terjadi kesalahan saat memproses file Anda. Pesan Error: ' . $e->getMessage()
            ]);
        }

        // Jika BERHASIL (tidak ada error), baru redirect
        return redirect()
            ->route('ppdb-online.index')
            ->with('success', 'Data anak dan dokumen berhasil didaftarkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CalonSiswa $CalonSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CalonSiswa $CalonSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CalonSiswa $CalonSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CalonSiswa $CalonSiswa)
    {
        //
    }
}
