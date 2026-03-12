<?php

namespace App\Filament\Resources\PlanResource\Pages;

use App\Filament\Resources\PlanResource;
use App\Filament\Resources\Pages\BaseCreateRecord;

class CreatePlan extends BaseCreateRecord
{
    protected static string $resource = PlanResource::class;

    public function getTitle(): string
    {
        return 'إضافة باقة';
    }

    public function getBreadcrumbs(): array
    {
        $crumbs = parent::getBreadcrumbs();
        $keys = array_keys($crumbs);
        $last = end($keys);
        if ($last !== false && isset($crumbs[$last])) {
            $crumbs['إضافة باقة'] = $crumbs[$last];
            unset($crumbs[$last]);
        }
        return $crumbs;
    }
}
