<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Services\PermissionService;
use App\Filament\Resources\Pages\BaseCreateRecord;

class CreateRole extends BaseCreateRecord
{
    protected static string $resource = RoleResource::class;

    public function getTitle(): string
    {
        return 'إضافة دور';
    }

    public function getBreadcrumbs(): array
    {
        $crumbs = parent::getBreadcrumbs();
        $keys = array_keys($crumbs);
        $last = end($keys);
        if ($last !== false && isset($crumbs[$last])) {
            $crumbs['إضافة دور'] = $crumbs[$last];
            unset($crumbs[$last]);
        }
        return $crumbs;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $permissions = $data['permissions'] ?? [];
        unset($data['permissions']);
        $this->permissions = $permissions;
        return $data;
    }

    protected function afterCreate(): void
    {
        if (!empty($this->permissions)) {
            $permissionService = app(PermissionService::class);
            $permissionService->syncRolePermissions($this->record, $this->permissions);
        }
    }

    protected $permissions = [];
}
