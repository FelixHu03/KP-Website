<?php

namespace App\Filament\Resources\DataOrangTuaResource\Pages;

use App\Filament\Resources\DataOrangTuaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataOrangTuas extends ListRecords
{
    protected static string $resource = DataOrangTuaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
