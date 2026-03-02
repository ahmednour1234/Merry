<script>
    // Set dir="ltr" on HTML element for Office panel - Run immediately
    (function() {
        // Set LTR immediately
        document.documentElement.setAttribute('dir', 'ltr');
        document.documentElement.setAttribute('lang', 'en');
        
        // Watch for any changes and override them
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'dir') {
                    if (document.documentElement.getAttribute('dir') !== 'ltr') {
                        document.documentElement.setAttribute('dir', 'ltr');
                    }
                }
            });
        });
        
        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['dir']
        });
        
        // Also set on DOMContentLoaded and window load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                document.documentElement.setAttribute('dir', 'ltr');
                document.documentElement.setAttribute('lang', 'en');
            });
        }
        
        window.addEventListener('load', function() {
            document.documentElement.setAttribute('dir', 'ltr');
            document.documentElement.setAttribute('lang', 'en');
        });
    })();
</script>
