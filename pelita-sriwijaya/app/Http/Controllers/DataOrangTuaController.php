<?php

namespace App\Http\Controllers;

use App\Models\DataOrangTua;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


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
        // 1. Validasi Data
        $validated = $this->validateData($request);

        // Ambil file KK
        $fileKK = $request->file('kartukeluarga');
        unset($validated['kartukeluarga']); 

        $dataOrangTua = null;
        $finalBasePath = null;

        try {
            $manager = new ImageManager(new Driver());

            $baseNamaSlug = Str::slug($validated['nama_ayah'], '_');
            $baseStoragePath = "dataOrangTua";

            // Logika Folder Unik (nama_ayah, nama_ayah_1, ...)
            $counter = 0;
            $finalNamaSlug = $baseNamaSlug;
            $finalBasePath = "{$baseStoragePath}/{$finalNamaSlug}";

            while (Storage::disk('public')->exists($finalBasePath)) {
                $counter++;
                $finalNamaSlug = "{$baseNamaSlug}_{$counter}";
                $finalBasePath = "{$baseStoragePath}/{$finalNamaSlug}";
            }

            if ($fileKK) {
                $ext = strtolower($fileKK->getClientOriginalExtension());
                $isPdf = ($ext === 'pdf');
                $fileExt = $isPdf ? 'pdf' : 'jpg';

                // Nama file: kartukeluarga_namaayah.jpg
                $fileName = "kartukeluarga_{$finalNamaSlug}.{$fileExt}";
                $fullPath = "{$finalBasePath}/kartukeluarga/{$fileName}";

                if ($isPdf) {
                    Storage::disk('public')->put($fullPath, file_get_contents($fileKK));
                } else {
                    $image = $manager->read($fileKK);
                    $image->resize(1200, null, fn($c) => $c->aspectRatio()->upsize());
                    $encoded = $image->toJpeg(85);
                    Storage::disk('public')->put($fullPath, (string)$encoded);
                }

                $validated['kartukeluarga'] = $fullPath;
            }

            $validated['user_ppdb_id'] = Auth::guard('ppdb')->id();
            $dataOrangTua = DataOrangTua::create($validated);

            return redirect()->route('ppdb-online.index')
                ->with('success', 'Data orang tua berhasil disimpan! Selamat datang.');
        } catch (Exception $e) {
            // Rollback: Hapus folder jika gagal simpan DB
            if ($finalBasePath && Storage::disk('public')->exists($finalBasePath)) {
                Storage::disk('public')->deleteDirectory($finalBasePath);
            }

            Log::error('Gagal simpan data ortu: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
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
        // Validasi (Note: saat update, file KK mungkin tidak wajib jika tidak diganti)
        // Anda mungkin perlu menyesuaikan validateData agar 'kartukeluarga' menjadi 'nullable' saat update
        $validated = $this->validateData($request); 
        
        $dataOrangTua = Auth::guard('ppdb')->user()->dataOrangTua;
        
        $fileKK = $request->file('kartukeluarga');
        unset($validated['kartukeluarga']); // Hapus dulu

        // Jika ada file baru diupload
        if ($fileKK) {
            try {
                $manager = new ImageManager(new Driver());
                
                $oldPath = $dataOrangTua->kartukeluarga;

                $baseNamaSlug = Str::slug($validated['nama_ayah'], '_');
                $baseStoragePath = "dataOrangTua";
                $counter = 0;
                $finalNamaSlug = $baseNamaSlug;
                $finalBasePath = "{$baseStoragePath}/{$finalNamaSlug}";

                while (Storage::disk('public')->exists($finalBasePath) && 
                       !str_contains($dataOrangTua->kartukeluarga ?? '', $finalBasePath)) { 
                    $counter++;
                    $finalNamaSlug = "{$baseNamaSlug}_{$counter}";
                    $finalBasePath = "{$baseStoragePath}/{$finalNamaSlug}";
                }

                // Simpan file baru
                $ext = strtolower($fileKK->getClientOriginalExtension());
                $isPdf = ($ext === 'pdf');
                $fileExt = $isPdf ? 'pdf' : 'jpg';
                $fileName = "kartukeluarga_{$finalNamaSlug}.{$fileExt}";
                $fullPath = "{$finalBasePath}/kartukeluarga/{$fileName}";

                if ($isPdf) {
                    Storage::disk('public')->put($fullPath, file_get_contents($fileKK));
                } else {
                    $image = $manager->read($fileKK);
                    $image->resize(1200, null, fn($c) => $c->aspectRatio()->upsize());
                    $encoded = $image->toJpeg(85);
                    Storage::disk('public')->put($fullPath, (string)$encoded);
                }

                // Hapus file lama jika ada
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }

                $validated['kartukeluarga'] = $fullPath;

            } catch (Exception $e) {
                return back()->withInput()->withErrors(['error' => 'Gagal upload KK baru: ' . $e->getMessage()]);
            }
        }

        $dataOrangTua->update($validated);

        return redirect()->route('ppdb-online.index')->with('success', 'Data orang tua berhasil diperbarui.');
    }
    // Fungsi validasi data
    private function validateData(Request $request)
    {
        $isUpdate = $request->isMethod('put') || $request->isMethod('patch');
        $rules = [
            'nik_keluarga' => 'required|string |digits:16',
            'kartukeluarga' => $isUpdate ? 'nullable|file|mimes:jpg,png,jpeg,pdf|max:2048' : 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
            'nama_ayah' => 'required|string|max:255',
            'nik_ayah' => 'required|string|digits:16', 
            'tanggallahir_ayah' => 'required|date',
            'pendidikan_ayah' => 'required|string',
            'pekerjaan_ayah' => 'required|string|max:255',
            'penghasilan_ayah' => 'required|string',
            'hp_ayah' => 'required|string|digits_between:10,13',

            'nama_ibu' => 'required|string|max:255',
            'nik_ibu' => 'required|string|digits:16',
            'tanggallahir_ibu' => 'required|date',
            'pendidikan_ibu' => 'required|string',
            'pekerjaan_ibu' => 'required|string|max:255',
            'penghasilan_ibu' => 'required|string',
            'hp_ibu' => 'required|string|digits_between:10,13',


            'alamat' => 'required|string',
            'sumber_informasi' => 'required|string',

        ];

        $messages = [
            'nik_ayah.digits' => 'Nomor NIK harus 16 digit.',
            'nik_ibu.digits' => 'Nomor NIK harus 16 digit.',

            'hp_ayah.digits_between' => 'Nomor Handphone harus 10 sampai 13 digit.',
            'hp_ibu.digits_between' => 'Nomor Handphone harus 10 sampai 13 digit.',
        ];

        return $request->validate($rules, $messages);
    }
}
