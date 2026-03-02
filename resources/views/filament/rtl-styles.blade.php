<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    /* RTL Support for all Filament panels */
    html[dir="rtl"],
    html[dir="rtl"] body,
    [data-panel-id],
    [data-panel-id] * {
        direction: rtl !important;
        text-align: right !important;
    }

    /* Font family */
    [data-panel-id],
    [data-panel-id] * {
        font-family: 'Cairo', sans-serif !important;
    }

    /* Sidebar RTL - Force right side */
    [data-panel-id] .fi-sidebar,
    [data-panel-id] .fi-sidebar-group,
    [data-panel-id] [class*="sidebar"] {
        right: 0 !important;
        left: auto !important;
        border-right: 1px solid rgba(0, 0, 0, 0.1) !important;
        border-left: none !important;
        position: fixed !important;
    }

    [data-panel-id] .fi-sidebar-nav {
        padding-right: 0.75rem !important;
        padding-left: 0 !important;
        direction: rtl !important;
    }

    [data-panel-id] .fi-sidebar-nav-item {
        padding-right: 0.75rem !important;
        padding-left: 0.5rem !important;
        text-align: right !important;
        direction: rtl !important;
    }

    [data-panel-id] .fi-sidebar-nav-item-icon {
        margin-left: 0.75rem !important;
        margin-right: 0 !important;
        order: 2;
    }

    [data-panel-id] .fi-sidebar-nav-item-label {
        order: 1;
        text-align: right !important;
    }

    /* Main content RTL - Force left side */
    [data-panel-id] .fi-main,
    [data-panel-id] .fi-main-content,
    [data-panel-id] [class*="main"] {
        margin-right: var(--sidebar-width, 16rem) !important;
        margin-left: 0 !important;
        padding-right: 0 !important;
        padding-left: 2rem !important;
    }

    [data-panel-id] .fi-header {
        right: var(--sidebar-width, 16rem) !important;
        left: 0 !important;
        padding-right: 0 !important;
        padding-left: 2rem !important;
    }

    /* Layout wrapper RTL */
    [data-panel-id] .fi-layout,
    [data-panel-id] [class*="layout"] {
        direction: rtl !important;
    }

    /* Navigation items */
    [data-panel-id] .fi-topbar-nav-item {
        margin-right: 0.5rem;
        margin-left: 0;
    }

    /* Forms RTL */
    [data-panel-id] .fi-input-wrapper,
    [data-panel-id] .fi-select-wrapper,
    [data-panel-id] .fi-textarea-wrapper {
        direction: rtl;
    }

    [data-panel-id] .fi-input,
    [data-panel-id] .fi-select,
    [data-panel-id] .fi-textarea {
        text-align: right;
        padding-right: 0.75rem;
        padding-left: 2.5rem;
    }

    [data-panel-id] .fi-input-icon,
    [data-panel-id] .fi-select-icon {
        right: 0.75rem;
        left: auto !important;
    }

    /* Buttons RTL */
    [data-panel-id] .fi-btn {
        direction: rtl;
    }

    [data-panel-id] .fi-btn-icon {
        margin-left: 0.5rem;
        margin-right: 0;
    }

    /* Tables RTL */
    [data-panel-id] table {
        direction: rtl;
    }

    [data-panel-id] table th,
    [data-panel-id] table td {
        text-align: right;
    }

    /* Modals RTL */
    [data-panel-id] .fi-modal {
        direction: rtl;
    }

    [data-panel-id] .fi-modal-header {
        padding-right: 1.5rem;
        padding-left: 1.5rem;
    }

    [data-panel-id] .fi-modal-close {
        left: 1rem;
        right: auto !important;
    }

    /* Dropdowns RTL */
    [data-panel-id] .fi-dropdown {
        direction: rtl;
        text-align: right;
    }

    /* Notifications RTL */
    [data-panel-id] .fi-notifications {
        left: 1rem;
        right: auto !important;
    }

    /* Breadcrumbs RTL */
    [data-panel-id] .fi-breadcrumbs {
        direction: rtl;
    }

    [data-panel-id] .fi-breadcrumbs-item {
        margin-left: 0.5rem;
        margin-right: 0;
    }

    [data-panel-id] .fi-breadcrumbs-separator {
        margin-left: 0.5rem;
        margin-right: 0;
        transform: scaleX(-1);
    }

    /* Tabs RTL */
    [data-panel-id] .fi-tabs {
        direction: rtl;
    }

    [data-panel-id] .fi-tabs-list {
        flex-direction: row-reverse;
    }

    /* Sections RTL */
    [data-panel-id] .fi-section {
        direction: rtl;
    }

    /* Cards RTL */
    [data-panel-id] .fi-card {
        direction: rtl;
        text-align: right;
    }

    /* Grid RTL */
    [data-panel-id] .fi-grid {
        direction: rtl;
    }

    /* Icons RTL adjustments */
    [data-panel-id] .fi-icon {
        display: inline-flex;
    }

    /* User menu RTL */
    [data-panel-id] .fi-user-menu {
        direction: rtl;
    }

    /* Action buttons RTL */
    [data-panel-id] .fi-ac-action {
        direction: rtl;
    }

    /* Checkbox and Radio RTL */
    [data-panel-id] .fi-checkbox,
    [data-panel-id] .fi-radio {
        margin-right: 0.5rem;
        margin-left: 0;
    }

    /* Toggle RTL */
    [data-panel-id] .fi-toggle {
        direction: rtl;
    }

    /* Badge RTL */
    [data-panel-id] .fi-badge {
        direction: rtl;
    }

    /* Pagination RTL */
    [data-panel-id] .fi-pagination {
        direction: rtl;
        flex-direction: row-reverse;
    }

    /* Stats widgets RTL */
    [data-panel-id] .fi-stats-overview-stat {
        direction: rtl;
        text-align: right;
    }

    /* Override any left/right specific styles */
    [data-panel-id] [style*="left:"],
    [data-panel-id] [style*="text-align: left"] {
        direction: rtl !important;
        text-align: right !important;
    }

    /* Force sidebar to right - Override Filament defaults */
    [data-panel-id] aside,
    [data-panel-id] [role="complementary"],
    [data-panel-id] .fi-sidebar-container {
        right: 0 !important;
        left: auto !important;
    }

    /* Force main content to left */
    [data-panel-id] main,
    [data-panel-id] [role="main"],
    [data-panel-id] .fi-main-container {
        margin-right: var(--sidebar-width, 16rem) !important;
        margin-left: 0 !important;
    }

    /* Office panel specific styles */
    [data-panel-id="office"]:not(.fi-simple-layout) .fi-sidebar {
        background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
    }

    [data-panel-id="office"]:not(.fi-simple-layout) .fi-main {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    [data-panel-id="office"] .fi-simple-layout {
        font-family: 'Cairo', sans-serif;
        direction: rtl;
    }

    /* Admin panel specific styles */
    [data-panel-id="admin"]:not(.fi-simple-layout) .fi-sidebar {
        background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
    }

    [data-panel-id="admin"]:not(.fi-simple-layout) .fi-main {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    [data-panel-id="admin"] .fi-simple-layout {
        font-family: 'Cairo', sans-serif;
        direction: rtl;
    }

    /* Dashboard UI Improvements */
    [data-panel-id] .fi-widgets-grid {
        gap: 1.5rem;
    }

    /* Stats Cards Enhancement */
    [data-panel-id] .fi-stats-overview-stat {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    [data-panel-id] .fi-stats-overview-stat::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #054F31 0%, #10b981 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    [data-panel-id] .fi-stats-overview-stat:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: rgba(5, 79, 49, 0.2);
    }

    [data-panel-id] .fi-stats-overview-stat:hover::before {
        opacity: 1;
    }

    /* Widget Cards Enhancement */
    [data-panel-id] .fi-widget {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    [data-panel-id] .fi-widget:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Stats Overview Header */
    [data-panel-id] .fi-stats-overview-stat-header {
        margin-bottom: 1rem;
    }

    [data-panel-id] .fi-stats-overview-stat-label {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    [data-panel-id] .fi-stats-overview-stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: #054F31;
        line-height: 1.2;
    }

    [data-panel-id] .fi-stats-overview-stat-icon {
        width: 3rem;
        height: 3rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        color: #054F31;
        margin-bottom: 1rem;
    }

    /* Section Headers */
    [data-panel-id] .fi-section-header {
        margin-bottom: 1.5rem;
    }

    [data-panel-id] .fi-section-header-heading {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    /* Card Content Spacing */
    [data-panel-id] .fi-card-content {
        padding: 1.5rem;
    }

    /* Icon Colors */
    [data-panel-id] .fi-icon {
        color: #054F31;
    }

    /* Badge Enhancement */
    [data-panel-id] .fi-badge {
        border-radius: 8px;
        padding: 0.375rem 0.75rem;
        font-weight: 600;
        font-size: 0.75rem;
    }

    /* Button Enhancement */
    [data-panel-id] .fi-btn {
        border-radius: 10px;
        font-weight: 600;
        padding: 0.625rem 1.25rem;
        transition: all 0.2s ease;
    }

    [data-panel-id] .fi-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(5, 79, 49, 0.2);
    }

    /* Grid Improvements */
    [data-panel-id] .fi-widgets-grid {
        margin-top: 1.5rem;
    }

    /* Stats Overview Grid */
    [data-panel-id] .fi-stats-overview {
        gap: 1.5rem;
    }

    /* Gradient Background for Main Content */
    [data-panel-id] .fi-main-content {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        min-height: 100vh;
        padding: 2rem;
    }

    /* Page Header Enhancement */
    [data-panel-id] .fi-header-heading {
        font-size: 1.875rem;
        font-weight: 900;
        color: #054F31;
        margin-bottom: 0.5rem;
    }

    /* Sidebar Enhancement */
    [data-panel-id] .fi-sidebar-nav-item-label {
        font-weight: 600;
        font-size: 0.9375rem;
    }

    [data-panel-id] .fi-sidebar-nav-item.is-active {
        background: linear-gradient(90deg, #f0fdf4 0%, #dcfce7 100%);
        border-right: 3px solid #054F31;
    }

    [data-panel-id] .fi-sidebar-nav-item.is-active .fi-sidebar-nav-item-label {
        color: #054F31;
        font-weight: 700;
    }

    /* Animation for Cards */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    [data-panel-id] .fi-stats-overview-stat,
    [data-panel-id] .fi-widget {
        animation: fadeInUp 0.5s ease-out;
    }

    [data-panel-id] .fi-stats-overview-stat:nth-child(1) { animation-delay: 0.1s; }
    [data-panel-id] .fi-stats-overview-stat:nth-child(2) { animation-delay: 0.2s; }
    [data-panel-id] .fi-stats-overview-stat:nth-child(3) { animation-delay: 0.3s; }
    [data-panel-id] .fi-stats-overview-stat:nth-child(4) { animation-delay: 0.4s; }
    [data-panel-id] .fi-stats-overview-stat:nth-child(5) { animation-delay: 0.5s; }
    [data-panel-id] .fi-stats-overview-stat:nth-child(6) { animation-delay: 0.6s; }
    [data-panel-id] .fi-stats-overview-stat:nth-child(7) { animation-delay: 0.7s; }
    [data-panel-id] .fi-stats-overview-stat:nth-child(8) { animation-delay: 0.8s; }

    /* Responsive Improvements */
    @media (max-width: 768px) {
        [data-panel-id] .fi-stats-overview-stat {
            padding: 1.25rem;
        }

        [data-panel-id] .fi-stats-overview-stat-value {
            font-size: 1.5rem;
        }
    }
</style>

<script>
    // Set dir="rtl" on HTML element for Office panel
    (function() {
        // Check if we're on the Office panel
        const panelId = document.querySelector('[data-panel-id]')?.getAttribute('data-panel-id');
        if (panelId === 'office') {
            document.documentElement.setAttribute('dir', 'rtl');
            document.documentElement.setAttribute('lang', 'ar');
        }
    })();
</script>
