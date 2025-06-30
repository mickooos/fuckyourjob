<?php

namespace App\Filament\Resources\HandlerResource\Pages;

use App\Filament\Resources\HandlerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHandler extends ViewRecord
{
    protected static string $resource = HandlerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
