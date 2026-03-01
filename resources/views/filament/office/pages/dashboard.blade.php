<x-filament-panels::page>
    @php
        $widgets = $this->getWidgets();
        $columns = $this->getColumns();
    @endphp
    
    @if(!empty($widgets))
        <div class="fi-widgets-grid grid gap-6 {{ is_array($columns) ? '' : 'grid-cols-1 md:grid-cols-' . $columns }}">
            @foreach($widgets as $widget)
                @livewire($widget)
            @endforeach
        </div>
    @endif
</x-filament-panels::page>
