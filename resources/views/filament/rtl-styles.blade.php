<script>
    // Set dir="rtl" on HTML element for Admin panel - Run immediately
    (function() {
        // Set RTL immediately
        document.documentElement.setAttribute('dir', 'rtl');
        document.documentElement.setAttribute('lang', 'ar');

        // Watch for any changes and override them
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'dir') {
                    if (document.documentElement.getAttribute('dir') !== 'rtl') {
                        document.documentElement.setAttribute('dir', 'rtl');
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
                document.documentElement.setAttribute('dir', 'rtl');
                document.documentElement.setAttribute('lang', 'ar');
            });
        }

        window.addEventListener('load', function() {
            document.documentElement.setAttribute('dir', 'rtl');
            document.documentElement.setAttribute('lang', 'ar');
        });
    })();
</script>
<style>
    /* RTL Support for Admin Panel */
    [dir="rtl"] {
        direction: rtl;
        text-align: right;
    }

    [dir="rtl"] .fi-sidebar,
    [dir="rtl"] .fi-main,
    [dir="rtl"] .fi-header {
        direction: rtl;
    }

    [dir="rtl"] input,
    [dir="rtl"] textarea,
    [dir="rtl"] select {
        text-align: right;
        direction: rtl;
    }

    [dir="rtl"] .fi-input-wrp input,
    [dir="rtl"] .fi-input-wrp textarea {
        text-align: right;
    }

    [dir="rtl"] .fi-btn {
        direction: rtl;
    }

    [dir="rtl"] .fi-modal {
        direction: rtl;
    }

    [dir="rtl"] .fi-dropdown {
        direction: rtl;
        text-align: right;
    }

    [dir="rtl"] .fi-table {
        direction: rtl;
    }

    [dir="rtl"] .fi-table th,
    [dir="rtl"] .fi-table td {
        text-align: right;
    }

    [dir="rtl"] .fi-form-section {
        direction: rtl;
    }

    [dir="rtl"] .fi-section-header {
        direction: rtl;
        text-align: right;
    }

    [dir="rtl"] .fi-badge {
        direction: rtl;
    }

    [dir="rtl"] .fi-notification {
        direction: rtl;
        text-align: right;
    }
</style>
