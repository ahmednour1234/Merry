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

    /* ═══════════════════════════════════════════
       MOBILE BOTTOM NAV BAR
    ═══════════════════════════════════════════ */
    @media (max-width: 1024px) {
        /* Hide Filament sidebar on mobile */
        .fi-sidebar,
        .fi-sidebar-nav,
        aside.fi-sidebar {
            display: none !important;
        }

        /* Remove left margin that compensates for sidebar */
        .fi-main,
        main.fi-main,
        .fi-main-ctn {
            margin-inline-start: 0 !important;
            max-width: 100% !important;
        }

        /* Add bottom padding so content doesn't hide behind nav bar */
        .fi-body,
        body {
            padding-bottom: calc(64px + env(safe-area-inset-bottom, 0px)) !important;
        }
    }

    /* Bottom nav bar itself */
    .office-mobile-nav {
        display: none;
        position: fixed;
        bottom: 0; left: 0; right: 0;
        z-index: 9999;
        background: #fff;
        border-top: 1px solid #e5e7eb;
        box-shadow: 0 -4px 20px rgba(0,0,0,.1);
        height: 64px;
        align-items: stretch;
        padding-bottom: env(safe-area-inset-bottom, 0px);
        direction: rtl;
    }

    @media (max-width: 1024px) {
        .office-mobile-nav { display: flex; }
    }

    .office-mob-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: .2rem;
        text-decoration: none;
        color: #9ca3af;
        font-size: .6rem;
        font-weight: 700;
        font-family: 'Cairo', sans-serif;
        transition: color .2s;
        position: relative;
        padding: .5rem .25rem;
    }

    .office-mob-item.active,
    .office-mob-item:hover {
        color: #054F31;
    }

    .office-mob-item.active::before {
        content: '';
        position: absolute;
        top: 0; left: 50%;
        transform: translateX(-50%);
        width: 30px; height: 3px;
        background: #054F31;
        border-radius: 0 0 4px 4px;
    }

    .office-mob-item svg {
        width: 22px; height: 22px; display: block; flex-shrink: 0;
    }

    .office-mob-label {
        display: block; white-space: nowrap; line-height: 1;
    }
</style>

{{-- Mobile bottom nav bar HTML (injected via JS after body) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    var path = window.location.pathname;

    function isActive(href) {
        return path === href || path.startsWith(href + '/') ? 'active' : '';
    }

    var nav = document.createElement('nav');
    nav.className = 'office-mobile-nav';
    nav.setAttribute('aria-label', 'التنقل السريع');
    nav.innerHTML = `
        <a href="/office" class="office-mob-item ${path === '/office' ? 'active' : ''}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12L11.204 3.045a1.125 1.125 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="office-mob-label">الرئيسية</span>
        </a>
        <a href="/office/cvs" class="office-mob-item ${isActive('/office/cvs')}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            <span class="office-mob-label">السير الذاتية</span>
        </a>
        <a href="/office/bookings" class="office-mob-item ${isActive('/office/bookings')}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
            </svg>
            <span class="office-mob-label">الحجوزات</span>
        </a>
        <a href="/office/subscriptions" class="office-mob-item ${isActive('/office/subscriptions')}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
            </svg>
            <span class="office-mob-label">الاشتراكات</span>
        </a>
        <a href="/office/profile" class="office-mob-item ${isActive('/office/profile')}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <span class="office-mob-label">حسابي</span>
        </a>
    `;
    document.body.appendChild(nav);
});
</script>
