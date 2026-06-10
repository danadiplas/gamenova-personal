<?php

namespace App\Filament\Resources\StockTiendaResource\Pages;

use App\Filament\Resources\StockTiendaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageStockTiendas extends ManageRecords
{
    protected static string $resource = StockTiendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
