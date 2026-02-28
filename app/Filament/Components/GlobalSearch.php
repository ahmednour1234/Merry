<?php

namespace App\Filament\Components;

use App\Models\Office;
use App\Models\Identity\EndUser;
use App\Models\Cv;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GlobalSearch extends Component
{
    public function render(): View
    {
        return view('filament.components.global-search');
    }
}
