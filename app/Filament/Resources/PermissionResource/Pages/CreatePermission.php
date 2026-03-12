<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Filament\Resources\PermissionResource;
use App\Filament\Resources\Pages\BaseCreateRecord;

class CreatePermission extends BaseCreateRecord
{
    protected static string $resource = PermissionResource::class;

    public function getTitle(): string
    {
        return 'إضافة صلاحية';
    }

    public function getBreadcrumbs(): array
    {
        $crumbs = parent::getBreadcrumbs();
        $keys = array_keys($crumbs);
        $last = end($keys);
        if ($last !== false && isset($crumbs[$last])) {
            $crumbs['إضافة صلاحية'] = $crumbs[$last];
            unset($crumbs[$last]);
        }
        return $crumbs;
    }
}
