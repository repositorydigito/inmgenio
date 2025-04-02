<?php

namespace App\Filament\Resources\PowerBiVisualizationResource\Pages;

use App\Filament\Resources\PowerBiVisualizationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPowerBiVisualization extends EditRecord
{
    protected static string $resource = PowerBiVisualizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
