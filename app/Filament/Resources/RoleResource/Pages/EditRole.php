<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Services\PermissionService;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Actions;

class EditRole extends BaseEditRecord
{
    protected static string $resource = RoleResource::class;

    public function getTitle(): string
    {
        return 'تعديل دور';
    }

    public function getBreadcrumbs(): array
    {
        $crumbs = parent::getBreadcrumbs();
        $keys = array_keys($crumbs);
        $last = end($keys);
        if ($last !== false && isset($crumbs[$last])) {
            $crumbs['تعديل دور'] = $crumbs[$last];
            unset($crumbs[$last]);
        }
        return $crumbs;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('حذف')
                ->modalHeading('تأكيد الحذف')
                ->modalDescription('هل أنت متأكد من الحذف؟')
                ->modalSubmitActionLabel('نعم، احذف'),
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
