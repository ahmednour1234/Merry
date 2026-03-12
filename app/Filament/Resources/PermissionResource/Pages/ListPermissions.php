<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Filament\Resources\PermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermissions extends ListRecords
{
    protected static string $resource = PermissionResource::class;

    public function getTitle(): string
    {
        return 'قائمة الصلاحيات';
    }

    public function getBreadcrumbs(): array
    {
        $crumbs = parent::getBreadcrumbs();
        $keys = array_keys($crumbs);
        $last = end($keys);
        if ($last !== false && isset($crumbs[$last])) {
            $crumbs['قائمة الصلاحيات'] = $crumbs[$last];
            unset($crumbs[$last]);
        }
        return $crumbs;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('إضافة ' . static::getResource()::getModelLabel()),
        ];
    }
}
