<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Services\PermissionService;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

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
