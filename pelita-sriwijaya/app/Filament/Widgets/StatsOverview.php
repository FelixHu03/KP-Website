<?php

namespace App\Filament\Widgets;

use App\Models\CalonSiswa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters; 

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        $tahunDipilih = $this->filters['tahun_ajaran'] ?? null;

        // Query dasar
        $queryTK = CalonSiswa::query()->where('jenjang_dipilih', 'TK');
        $querySD = CalonSiswa::query()->where('jenjang_dipilih', 'SD');
        $querySMP = CalonSiswa::query()->where('jenjang_dipilih', 'SMP');

        if ($tahunDipilih) {
            $queryTK->where('tahun_ajaran', $tahunDipilih);
            $querySD->where('tahun_ajaran', $tahunDipilih);
            $querySMP->where('tahun_ajaran', $tahunDipilih);
            $labelTahun = "($tahunDipilih)";
        } else {
            $labelTahun = "(Semua)";
        }

        return [
            Stat::make('Total Pendaftar', CalonSiswa::count())
                ->description('Total akumulasi data')
                ->color('primary'),

            Stat::make("Pendaftar TK $labelTahun", $queryTK->count())
                ->description('Jumlah calon siswa TK')
                ->color('success'),
            Stat::make("Pendaftar SD $labelTahun", $querySD->count())
                ->description('Jumlah calon siswa SD')
                ->color('success'),

            Stat::make("Pendaftar SMP $labelTahun", $querySMP->count())
                ->description('Jumlah calon siswa SMP')
                ->color('info'),
        ];
    }
}