<?php

namespace App\Filament\Resources\DataOrangTuaResource\Pages;

use App\Filament\Resources\DataOrangTuaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataOrangTua extends EditRecord
{
    protected static string $resource = DataOrangTuaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
