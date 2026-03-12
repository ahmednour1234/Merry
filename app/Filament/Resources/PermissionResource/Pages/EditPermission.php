<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Filament\Resources\PermissionResource;
use App\Filament\Resources\Pages\BaseEditRecord;
use Filament\Actions;

class EditPermission extends BaseEditRecord
{
    protected static string $resource = PermissionResource::class;

    public function getTitle(): string
    {
        return 'تعديل صلاحية';
    }

    public function getBreadcrumbs(): array
    {
        $crumbs = parent::getBreadcrumbs();
        $keys = array_keys($crumbs);
        $last = end($keys);
        if ($last !== false && isset($crumbs[$last])) {
            $crumbs['تعديل صلاحية'] = $crumbs[$last];
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
}
