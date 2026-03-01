<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    /* Scoped to office panel only - does not affect auth layout */
    [data-panel-id="office"]:not(.fi-simple-layout) {
        font-family: 'Cairo', sans-serif;
    }
    
    [data-panel-id="office"]:not(.fi-simple-layout) .fi-sidebar {
        background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
    }
    
    [data-panel-id="office"]:not(.fi-simple-layout) .fi-main {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
    
    /* Ensure auth layout is not affected */
    .fi-simple-layout {
        font-family: 'Cairo', sans-serif;
    }

    /* Hide sidebar and header on auth pages */
    [data-panel-id="office"] body:has([data-page*="login"]) .fi-sidebar,
    [data-panel-id="office"] body:has([data-page*="register"]) .fi-sidebar,
    [data-panel-id="office"] body:has([data-page*="password"]) .fi-sidebar {
        display: none !important;
    }

    [data-panel-id="office"] body:has([data-page*="login"]) .fi-main,
    [data-panel-id="office"] body:has([data-page*="register"]) .fi-main,
    [data-panel-id="office"] body:has([data-page*="password"]) .fi-main {
        margin-left: 0 !important;
        margin-right: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    [data-panel-id="office"] body:has([data-page*="login"]) .fi-header,
    [data-panel-id="office"] body:has([data-page*="register"]) .fi-header,
    [data-panel-id="office"] body:has([data-page*="password"]) .fi-header {
        display: none !important;
    }
</style>
