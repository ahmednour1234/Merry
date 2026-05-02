<script>
    // Set dir="rtl" on HTML element for Office panel - Run immediately
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
    /* ═══════════════════════════════════════════
       OFFICE PANEL — CUSTOM TOPBAR DESIGN
    ═══════════════════════════════════════════ */

    /* Main topbar */
    header.fi-topbar,
    .fi-topbar {
        background: linear-gradient(135deg, #054F31 0%, #076b42 100%) !important;
        border-bottom: 1px solid rgba(255,255,255,.08) !important;
        box-shadow: 0 2px 16px rgba(5,47,29,.35) !important;
        height: 64px !important;
    }

    /* Topbar inner nav */
    .fi-topbar nav,
    header.fi-topbar > div,
    .fi-topbar-nav {
        height: 64px !important;
        padding: 0 1.25rem !important;
        gap: .75rem !important;
    }

    /* Brand / Logo area */
    .fi-sidebar-header,
    .fi-logo {
        background: transparent !important;
        border: none !important;
        padding: 0 1rem !important;
    }

    .fi-logo span,
    .fi-logo-name {
        font-size: 1.1rem !important;
        font-weight: 800 !important;
        color: #ffffff !important;
        letter-spacing: -.3px !important;
    }

    /* Breadcrumb / Page title area */
    .fi-breadcrumbs ol {
        gap: .35rem !important;
    }

    .fi-breadcrumbs li a,
    .fi-breadcrumbs li span {
        color: rgba(255,255,255,.7) !important;
        font-size: .82rem !important;
        font-weight: 500 !important;
    }

    .fi-breadcrumbs li:last-child span {
        color: #fff !important;
        font-weight: 700 !important;
    }

    .fi-breadcrumbs svg {
        color: rgba(255,255,255,.4) !important;
    }

    /* Topbar right: user menu + notifications */
    .fi-topbar-item button,
    .fi-user-menu > button,
    .fi-dropdown-trigger {
        border-radius: 10px !important;
        transition: background .2s !important;
    }

    .fi-topbar-item button:hover,
    .fi-user-menu > button:hover {
        background: rgba(255,255,255,.1) !important;
    }

    /* User avatar in topbar */
    .fi-user-menu .fi-avatar,
    .fi-topbar .fi-avatar {
        ring: 2px !important;
        ring-color: rgba(255,255,255,.3) !important;
        box-shadow: 0 0 0 2px rgba(255,255,255,.25) !important;
    }

    /* User name / label in topbar */
    .fi-user-menu span,
    .fi-topbar-item span[class*="text"] {
        color: #fff !important;
        font-weight: 600 !important;
        font-size: .85rem !important;
    }

    /* Notification bell */
    .fi-topbar .fi-icon-btn,
    .fi-notifications-trigger {
        color: rgba(255,255,255,.85) !important;
        border-radius: 10px !important;
        padding: .45rem !important;
        transition: background .2s !important;
    }

    .fi-topbar .fi-icon-btn:hover,
    .fi-notifications-trigger:hover {
        background: rgba(255,255,255,.12) !important;
        color: #fff !important;
    }

    /* Notification badge */
    .fi-badge {
        background: #ef4444 !important;
        font-size: .65rem !important;
        font-weight: 700 !important;
        min-width: 18px !important;
        height: 18px !important;
    }

    /* SVG icons in topbar */
    .fi-topbar svg,
    header.fi-topbar svg {
        color: rgba(255,255,255,.85) !important;
    }

    /* Sidebar (left) */
    .fi-sidebar {
        border-right: none !important;
        border-left: 1px solid rgba(5,47,29,.12) !important;
        background: #fafafa !important;
    }

    .fi-sidebar-header {
        background: linear-gradient(135deg, #054F31 0%, #076b42 100%) !important;
        border-bottom: 1px solid rgba(255,255,255,.08) !important;
        padding: 1rem 1.25rem !important;
    }

    /* Sidebar nav items */
    .fi-sidebar-item-button {
        border-radius: 10px !important;
        font-size: .88rem !important;
        font-weight: 600 !important;
        transition: all .18s !important;
        margin: 1px 0 !important;
    }

    .fi-sidebar-item-button:hover {
        background: rgba(5,79,49,.07) !important;
        color: #054F31 !important;
    }

    .fi-sidebar-item-button.fi-active,
    .fi-sidebar-item-button[aria-current] {
        background: #e8f5ed !important;
        color: #054F31 !important;
        font-weight: 700 !important;
    }

    .fi-sidebar-item-button.fi-active svg,
    .fi-sidebar-item-button[aria-current] svg {
        color: #054F31 !important;
    }

    /* Sidebar group labels */
    .fi-sidebar-group-label {
        font-size: .72rem !important;
        font-weight: 700 !important;
        letter-spacing: .06em !important;
        color: #9ca3af !important;
        text-transform: uppercase !important;
    }

    /* Page header */
    .fi-header {
        padding: 1.25rem 1.5rem .75rem !important;
        border-bottom: 1px solid #f0f0f0 !important;
        background: #fff !important;
    }

    .fi-header-heading {
        font-size: 1.35rem !important;
        font-weight: 800 !important;
        color: #111827 !important;
    }

    /* Dropdown panel */
    .fi-dropdown-panel {
        border-radius: 14px !important;
        box-shadow: 0 8px 30px rgba(0,0,0,.12) !important;
        border: 1px solid #e5e7eb !important;
        overflow: hidden !important;
    }

    .fi-dropdown-item {
        font-size: .88rem !important;
        font-weight: 500 !important;
        border-radius: 8px !important;
        margin: 2px 6px !important;
    }

    .fi-dropdown-item:hover {
        background: #f0fdf4 !important;
        color: #054F31 !important;
    }

    /* Tables */
    .fi-ta-header-cell {
        font-weight: 700 !important;
        font-size: .82rem !important;
        color: #6b7280 !important;
        text-transform: uppercase !important;
        letter-spacing: .04em !important;
    }

    /* Buttons */
    .fi-btn-color-primary {
        background: #054F31 !important;
        border-color: #054F31 !important;
    }

    .fi-btn-color-primary:hover {
        background: #076b42 !important;
    }

    /* Widget cards */
    .fi-wi-stats-overview-stat {
        border-radius: 14px !important;
        border: 1.5px solid #e5e7eb !important;
    }
</style>
