<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'لوحة التحكم';

    public static function getNavigationGroup(): ?string
    {
        return 'الإدارة';
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public function getTitle(): string
    {
        return 'لوحة التحكم';
    }
}
