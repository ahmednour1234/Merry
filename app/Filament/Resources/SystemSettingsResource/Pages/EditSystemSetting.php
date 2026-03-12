<?php

namespace App\Filament\Resources\SystemSettingsResource\Pages;

use App\Filament\Resources\SystemSettingsResource;
use App\Services\SystemSettings;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Actions;
use Illuminate\Support\Facades\Cache;

class EditSystemSetting extends BaseEditRecord
{
    protected static string $resource = SystemSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $settings = app(SystemSettings::class);
        
        // Handle value encoding
        if (isset($data['value'])) {
            if ($data['type'] === 'json') {
                // Try to decode if it's a JSON string, otherwise keep as is
                if (is_string($data['value'])) {
                    $decoded = json_decode($data['value'], true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $data['value'] = $decoded;
                    }
                }
            }
        }
        
        return $data;
    }

    protected function afterSave(): void
    {
        // Clear cache for this setting
        $record = $this->record;
        $cacheKey = "settings:{$record->scope}:{$record->key}";
        Cache::forget($cacheKey);
        
        // Special handling for app.locale
        if ($record->key === 'app.locale' && is_string($record->value)) {
            app()->setLocale($record->value);
            config(['app.locale' => $record->value]);
        }
    }
}
