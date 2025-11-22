<?php

namespace App\Filament\Resources\DataOrangTuaResource\Pages;

use App\Filament\Resources\DataOrangTuaResource;
use App\Models\DataOrangTua;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataOrangTua extends EditRecord
{
    protected static string $resource = DataOrangTuaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('previous')
                ->label('Sebelumnya')
                ->icon('heroicon-o-chevron-left') 
                ->color('gray')
                ->url(function () {
                    // Cari ID sebelumnya
                    $previousRecord = DataOrangTua::where('id', '<', $this->record->id)
                        ->orderBy('id', 'desc') 
                        ->first();

                    return $previousRecord
                        ? DataOrangTuaResource::getUrl('edit', ['record' => $previousRecord->id])
                        : null;
                })
                // Tombol hanya muncul jika ada data sebelumnya
                ->visible(fn() => DataOrangTua::where('id', '<', $this->record->id)->exists())
                ->keyBindings(['ArrowLeft']), 

            // 2. Tombol KE data selanjutnya
            Actions\Action::make('next')
                ->label('Selanjutnya')
                ->icon('heroicon-o-chevron-right') 
                ->iconPosition('after') 
                ->color('gray')
                ->url(function () {
                    // Cari ID yang lebih BESAR dari ID saat ini 
                    $nextRecord = DataOrangTua::where('id', '>', $this->record->id)
                        ->orderBy('id', 'asc') 
                        ->first();

                    return $nextRecord
                        ? DataOrangTuaResource::getUrl('edit', ['record' => $nextRecord->id])
                        : null;
                })
                // Tombol hanya muncul jika ada data selanjutnya
                ->visible(fn() => DataOrangTua::where('id', '>', $this->record->id)->exists())
                ->keyBindings(['ArrowRight']),
            Actions\DeleteAction::make(),
        ];
    }
}
