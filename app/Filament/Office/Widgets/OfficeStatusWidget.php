<?php

namespace App\Filament\Office\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class OfficeStatusWidget extends Widget
{
    protected string $view = 'filament.office.widgets.office-status-widget';

    protected int | string | array $columnSpan = 'full';

    public function getViewData(): array
    {
        $office = Auth::guard('office-panel')->user();

        return [
            'office' => $office,
            'isActive' => $office?->active ?? false,
            'isBlocked' => $office?->blocked ?? false,
            'statusText' => $this->getStatusText(),
            'statusColor' => $this->getStatusColor(),
        ];
    }

    protected function getStatusText(): string
    {
        $office = Auth::guard('office-panel')->user();
        
        if ($office?->blocked) {
            return 'محظور';
        }
        
        if (!$office?->active) {
            return 'قيد المراجعة';
        }
        
        return 'نشط';
    }

    protected function getStatusColor(): string
    {
        $office = Auth::guard('office-panel')->user();
        
        if ($office?->blocked) {
            return 'danger';
        }
        
        if (!$office?->active) {
            return 'warning';
        }
        
        return 'success';
    }
}
