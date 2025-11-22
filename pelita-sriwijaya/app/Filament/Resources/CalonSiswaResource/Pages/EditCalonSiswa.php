<?php

namespace App\Filament\Resources\CalonSiswaResource\Pages;

use App\Filament\Resources\CalonSiswaResource;
use App\Models\CalonSiswa;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCalonSiswa extends EditRecord
{
    protected static string $resource = CalonSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('previous')
                ->label('Sebelumnya')
                ->icon('heroicon-o-chevron-left') 
                ->color('gray')
                ->url(function () {
                    // Cari ID sebelumnya
                    $previousRecord = CalonSiswa::where('id', '<', $this->record->id)
                        ->orderBy('id', 'desc') 
                        ->first();

                    return $previousRecord
                        ? CalonSiswaResource::getUrl('edit', ['record' => $previousRecord->id])
                        : null;
                })
                // Tombol hanya muncul jika ada data sebelumnya
                ->visible(fn() => CalonSiswa::where('id', '<', $this->record->id)->exists())
                ->keyBindings(['ArrowLeft']), 

            // 2. Tombol KE data selanjutnya
            Actions\Action::make('next')
                ->label('Selanjutnya')
                ->icon('heroicon-o-chevron-right') 
                ->iconPosition('after') 
                ->color('gray')
                ->url(function () {
                    // Cari ID yang lebih BESAR dari ID saat ini 
                    $nextRecord = CalonSiswa::where('id', '>', $this->record->id)
                        ->orderBy('id', 'asc') 
                        ->first();

                    return $nextRecord
                        ? CalonSiswaResource::getUrl('edit', ['record' => $nextRecord->id])
                        : null;
                })
                // Tombol hanya muncul jika ada data selanjutnya
                ->visible(fn() => CalonSiswa::where('id', '>', $this->record->id)->exists())
                ->keyBindings(['ArrowRight']),
            Actions\DeleteAction::make(),
        ];
    }
}
