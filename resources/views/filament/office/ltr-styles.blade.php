<script>
    // Set dir="ltr" on HTML element for Office panel
    (function() {
        // Check if we're on the Office panel
        const panelId = document.querySelector('[data-panel-id]')?.getAttribute('data-panel-id');
        if (panelId === 'office') {
            document.documentElement.setAttribute('dir', 'ltr');
            document.documentElement.setAttribute('lang', 'en');
        }
    })();
</script>
