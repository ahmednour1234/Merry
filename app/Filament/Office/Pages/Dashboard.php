<?php

namespace App\Filament\Office\Pages;

use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'لوحة التحكم';

    protected static ?string $title = 'لوحة التحكم';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected string $view = 'filament.office.pages.dashboard';

    public function getWidgets(): array
    {
        return [];
    }

    public function getColumns(): int | array
    {
        return 2;
    }
}
