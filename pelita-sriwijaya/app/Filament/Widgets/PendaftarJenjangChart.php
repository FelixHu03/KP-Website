<?php

namespace App\Filament\Widgets;

use App\Models\CalonSiswa;
use App\Models\TahunAjaran;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PendaftarJenjangChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Pendaftar per Jenjang';
    
    protected static ?int $sort = 2; 

    protected function getFilters(): ?array
    {
        // Mengambil list tahun dari database (atau bisa manual array)
        return TahunAjaran::query()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun', 'tahun')
            ->toArray();
            

    }

    protected function getData(): array
    {
        $activeFilter = $this->filter; 

        // Query Data
        $query = CalonSiswa::query();

        if ($activeFilter) {
            $query->where('tahun_ajaran', $activeFilter);
        }

        $data = $query->select('jenjang_dipilih', DB::raw('count(*) as total'))
            ->groupBy('jenjang_dipilih')
            ->pluck('total', 'jenjang_dipilih');

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pendaftar',
                    'data' => $data->values(),
                    'backgroundColor' => [
                        '#fbbf24', // TK (Warning/Yellow)
                        '#22c55e', // SD (Success/Green)
                        '#3b82f6', // SMP (Info/Blue)
                    ],
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}