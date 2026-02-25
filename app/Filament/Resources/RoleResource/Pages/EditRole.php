<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Services\PermissionService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $permissions = $data['permissions'] ?? null;
        unset($data['permissions']);
        if ($permissions !== null) {
            $this->permissions = $permissions;
        }
        return $data;
    }

    protected function afterSave(): void
    {
        if (isset($this->permissions)) {
            $permissionService = app(PermissionService::class);
            $permissionService->syncRolePermissions($this->record, $this->permissions);
        }
    }

    protected $permissions = null;
}
