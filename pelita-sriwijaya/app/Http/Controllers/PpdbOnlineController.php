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
use Illuminate\Validation\Rule;

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
            ->select('id', 'namalengkap', 'nik', 'tanggallahir', 'jenjang_dipilih', 'created_at','status')
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
            // 'nik' => 'required|string|unique:calon_siswas,nik', // Validasi NIK unik mungkin terlalu ketat jika mendaftar 2 anak
            'nik' => [
                'required',
                'string',
                Rule::unique('calon_siswas')->where(function ($query) use ($request) {
                    return $query->where('jenjang_dipilih', $request->jenjang_dipilih);
                })
            ],
            'tempatlahir' => 'required|string',
            'tanggallahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'vegetarian' => 'required|string',
            'handphone' => 'required|string|digits_between:10,13',
            'akta_kelahiran' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
            'foto_raport'   => 'required_if:jenjang_dipilih,SMP|file|mimes:jpg,png,jpeg,pdf|max:2048',
            'asalsekolah'   => 'required_if:jenjang_dipilih,SD,SMP|nullable|string',
            'nisn'          => 'required_if:jenjang_dipilih,SMP|nullable|string|max:10',
            'nilai_ijazah'  => 'required_if:jenjang_dipilih,SMP|nullable|numeric|between:0,100',
            'gelombang'     => 'required|string',
            'konfirmasi_data_ortu' => 'required',
        ]);

        $validated['user_ppdb_id'] = Auth::guard('ppdb')->id();

        $aktaFile  = $request->file('akta_kelahiran');
        $raportFile = $request->file('foto_raport');

        unset($validated['akta_kelahiran'], $validated['foto_raport'], $validated['konfirmasi_data_ortu']);

        $calonSiswa = null;
        $finalBasePath = null;

        try {

            // 1. BUAT INSTANCE SISWA
            $calonSiswa = CalonSiswa::create($validated);
            $studentId = $calonSiswa->id;
            
            // 2. TENTUKAN PATH DASAR DAN SLUG
            $manager = new ImageManager(new Driver());
            $jenjang = strtolower($validated['jenjang_dipilih']);
            $tahunAjaranAsli = $validated['tahun_ajaran'];
            $tahunAjaranFolder = str_replace('/', '-', $tahunAjaranAsli);
            $baseNamaSlug = Str::slug($validated['namalengkap'], '_'); // 'felix'
            
            // Path dasar tempat folder jenjang berada
            $baseStoragePath = "dokumen_siswa/{$tahunAjaranFolder}/{$jenjang}"; // HASIL: 'dokumen_siswa/2025-2026/sd'

            $counter = 0;
            $finalNamaSlug = $baseNamaSlug; 
            $finalBasePath = "{$baseStoragePath}/{$finalNamaSlug}"; // 'dokumen_siswa/2025-2026/sd/felix'

            // Loop untuk mengecek apakah DIREKTORI ini sudah ada
            while (Storage::disk('public')->exists($finalBasePath)) {
                $counter++;
                $finalNamaSlug = "{$baseNamaSlug}_{$counter}"; // 'felix_1'
                $finalBasePath = "{$baseStoragePath}/{$finalNamaSlug}"; // 'dokumen_siswa/2025-2026/sd/felix_1'
            }
            $saveFile = function ($file, $jenisDokumen) use ($manager, $finalBasePath, $finalNamaSlug) {
                $ext  = strtolower($file->getClientOriginalExtension());
                $isPdf = ($ext === 'pdf');
                $fileExt = ($isPdf ? 'pdf' : 'jpg');
                
                // Buat nama file menggunakan slug unik dari folder
                $finalName = "{$jenisDokumen}_{$finalNamaSlug}.{$fileExt}"; // 'akta_kelahiran_felix_1.jpg'
                
                // Path lengkap ke file
                $path = "{$finalBasePath}/{$finalName}"; //'dokumen_siswa/.../felix_1/akta_kelahiran_felix_1.jpg'

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

            // 6. PROSES FOTO RAPORT
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
        } catch (Exception $e) {

            if ($calonSiswa) {
                $calonSiswa->dokumen()->delete();
                
                if ($finalBasePath && Storage::disk('public')->exists($finalBasePath)) {
                    Storage::disk('public')->deleteDirectory($finalBasePath);
                }
                
                // Hapus data siswa
                $calonSiswa->delete();
            }

            Log::error('Gagal mendaftar siswa: ' . $e->getMessage() . ' di baris ' . $e->getLine());

            return back()->withInput()->withErrors([
                'file_upload' => 'Terjadi kesalahan saat memproses file Anda. Pesan Error: B' . $e->getMessage()
            ]);
        }

        // Jika BERHASIL
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
