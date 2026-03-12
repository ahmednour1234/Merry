<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    public function getTitle(): string
    {
        return 'قائمة الأدوار';
    }

    public function getBreadcrumbs(): array
    {
        $crumbs = parent::getBreadcrumbs();
        $keys = array_keys($crumbs);
        $last = end($keys);
        if ($last !== false && isset($crumbs[$last])) {
            $crumbs['قائمة الأدوار'] = $crumbs[$last];
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
