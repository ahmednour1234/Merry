<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "https://mery.alemtayaz.com/";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.3.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.3.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-health">
                                <a href="#endpoints-GETapi-health">GET api/health</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-debug-token">
                                <a href="#endpoints-GETapi-v1-debug-token">GET api/v1/debug/token</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-ping">
                                <a href="#endpoints-GETapi-v1-ping">GET api/v1/ping</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-test-auth">
                                <a href="#endpoints-GETapi-v1-test-auth">GET api/v1/test-auth</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-auth-login">
                                <a href="#endpoints-POSTapi-v1-auth-login">POST api/v1/auth/login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-auth-logout">
                                <a href="#endpoints-POSTapi-v1-auth-logout">POST api/v1/auth/logout</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-system-pages">
                                <a href="#endpoints-GETapi-v1-admin-system-pages">List pages</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-system-pages--id-">
                                <a href="#endpoints-GETapi-v1-admin-system-pages--id-">Show single page by ID or slug</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-admin-system-pages">
                                <a href="#endpoints-POSTapi-v1-admin-system-pages">Create page</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-admin-system-pages--id-">
                                <a href="#endpoints-PUTapi-v1-admin-system-pages--id-">Update page</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-admin-system-pages--id--toggle">
                                <a href="#endpoints-POSTapi-v1-admin-system-pages--id--toggle">Toggle page active status</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-admin-system-pages--id-">
                                <a href="#endpoints-DELETEapi-v1-admin-system-pages--id-">Delete page</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-system-settings">
                                <a href="#endpoints-GETapi-v1-admin-system-settings">GET /v1/admin/system/settings?scope=global|null
يعرض الإعدادات حسب الـ scope (أو الكل لو scope=null)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-admin-system-settings--key-">
                                <a href="#endpoints-PUTapi-v1-admin-system-settings--key-">PUT /v1/admin/system/settings/{key}
body: { value: mixed, scope?: string, type?: "string"|"json" }</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-system-permissions">
                                <a href="#endpoints-GETapi-v1-admin-system-permissions">GET api/v1/admin/system/permissions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-admin-system-permissions">
                                <a href="#endpoints-POSTapi-v1-admin-system-permissions">POST api/v1/admin/system/permissions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-admin-system-permissions--id-">
                                <a href="#endpoints-PUTapi-v1-admin-system-permissions--id-">PUT api/v1/admin/system/permissions/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-admin-system-permissions--id-">
                                <a href="#endpoints-DELETEapi-v1-admin-system-permissions--id-">DELETE api/v1/admin/system/permissions/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-admin-system-permissions--id--toggle">
                                <a href="#endpoints-POSTapi-v1-admin-system-permissions--id--toggle">POST api/v1/admin/system/permissions/{id}/toggle</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-system-offices">
                                <a href="#endpoints-GETapi-v1-admin-system-offices">عرض قائمة المكاتب مع الفلاتر</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-system-offices-stats">
                                <a href="#endpoints-GETapi-v1-admin-system-offices-stats">إحصائيات سريعة للمكاتب وملفات السير الذاتية</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-system-offices--id-">
                                <a href="#endpoints-GETapi-v1-admin-system-offices--id-">عرض مكتب واحد حسب المعرّف</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-admin-system-offices">
                                <a href="#endpoints-POSTapi-v1-admin-system-offices">إنشاء مكتب جديد</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-admin-system-offices--id-">
                                <a href="#endpoints-PUTapi-v1-admin-system-offices--id-">تحديث بيانات المكتب</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-admin-system-offices--id--block">
                                <a href="#endpoints-POSTapi-v1-admin-system-offices--id--block">حظر / إلغاء حظر</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-admin-system-offices--id--toggle">
                                <a href="#endpoints-POSTapi-v1-admin-system-offices--id--toggle">تفعيل / تعطيل</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-admin-system-offices--id-">
                                <a href="#endpoints-DELETEapi-v1-admin-system-offices--id-">حذف مكتب</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-office-auth-register">
                                <a href="#endpoints-POSTapi-v1-office-auth-register">POST /api/v1/office/auth/register
يقبل اختيارياً: fcm_token, device, platform
لا يصدر توكن عند التسجيل — الحساب يبقى قيد المراجعة.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-office-auth-login">
                                <a href="#endpoints-POSTapi-v1-office-auth-login">POST /api/v1/office/auth/login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-office-auth-forgot-password">
                                <a href="#endpoints-POSTapi-v1-office-auth-forgot-password">POST /api/v1/office/auth/forgot-password
يُرسل كود 6 أرقام للبريد، صالح لمدة 15 دقيقة.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-office-auth-reset-password">
                                <a href="#endpoints-POSTapi-v1-office-auth-reset-password">POST /api/v1/office/auth/reset-password
يُتحقق من الكود ثم يغيّر كلمة المرور.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-office-me">
                                <a href="#endpoints-GETapi-v1-office-me">GET /api/v1/office/me</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-office-auth-logout">
                                <a href="#endpoints-POSTapi-v1-office-auth-logout">POST /api/v1/office/auth/logout
يقبل اختيارياً: fcm_token</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-office-fcm-tokens">
                                <a href="#endpoints-POSTapi-v1-office-fcm-tokens">POST /api/v1/office/fcm-tokens</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-office-fcm-tokens">
                                <a href="#endpoints-DELETEapi-v1-office-fcm-tokens">DELETE /api/v1/office/fcm-tokens</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-office-plans">
                                <a href="#endpoints-GETapi-v1-office-plans">GET /api/v1/office/plans
إرجاع قائمة الخطط مع سعر نهائي حسب العملة القادمة من الهيدر</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-office-subscription">
                                <a href="#endpoints-GETapi-v1-office-subscription">GET /api/v1/office/subscription
إرجاع الاشتراك الحالي للمكتب</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-office-subscribe">
                                <a href="#endpoints-POSTapi-v1-office-subscribe">POST /api/v1/office/subscribe
body: plan_code, coupon (optional)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-office-subscription-auto-renew">
                                <a href="#endpoints-POSTapi-v1-office-subscription-auto-renew">POST /api/v1/office/subscription/auto-renew
body: { auto_renew: bool }</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-enduser-auth-register">
                                <a href="#endpoints-POSTapi-v1-enduser-auth-register">POST /api/v1/enduser/auth/register</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-enduser-auth-login">
                                <a href="#endpoints-POSTapi-v1-enduser-auth-login">POST /api/v1/enduser/auth/login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-enduser-auth-forgot-password-start">
                                <a href="#endpoints-POSTapi-v1-enduser-auth-forgot-password-start">POST /api/v1/enduser/auth/forgot-password/start
Step 1: Accept national_id only, return a short-lived token.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-enduser-auth-forgot-password-verify-phone">
                                <a href="#endpoints-POSTapi-v1-enduser-auth-forgot-password-verify-phone">POST /api/v1/enduser/auth/forgot-password/verify-phone
Step 2: Verify phone matches stored phone, return reset token if valid.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-enduser-auth-reset-password">
                                <a href="#endpoints-POSTapi-v1-enduser-auth-reset-password">POST /api/v1/enduser/auth/reset-password
Step 3: Direct password reset using reset_token, no email/SMS.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-enduser-cities">
                                <a href="#endpoints-GETapi-v1-enduser-cities">GET api/v1/enduser/cities</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-enduser-currencies">
                                <a href="#endpoints-GETapi-v1-enduser-currencies">GET api/v1/enduser/currencies</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-enduser-categories">
                                <a href="#endpoints-GETapi-v1-enduser-categories">GET api/v1/enduser/categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-enduser-offices">
                                <a href="#endpoints-GETapi-v1-enduser-offices">GET api/v1/enduser/offices</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-enduser-cvs">
                                <a href="#endpoints-GETapi-v1-enduser-cvs">GET api/v1/enduser/cvs</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-enduser-me">
                                <a href="#endpoints-GETapi-v1-enduser-me">GET /api/v1/enduser/me</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-enduser-profile">
                                <a href="#endpoints-PUTapi-v1-enduser-profile">PUT /api/v1/enduser/profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-enduser-auth-logout">
                                <a href="#endpoints-POSTapi-v1-enduser-auth-logout">POST /api/v1/enduser/auth/logout</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-notifications" class="tocify-header">
                <li class="tocify-item level-1" data-unique="notifications">
                    <a href="#notifications">Notifications</a>
                </li>
                                    <ul id="tocify-subheader-notifications" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="notifications-GETapi-v1-admin-system-notifications">
                                <a href="#notifications-GETapi-v1-admin-system-notifications">List notifications</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notifications-POSTapi-v1-admin-system-notifications--id--read">
                                <a href="#notifications-POSTapi-v1-admin-system-notifications--id--read">Mark a notification as read</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notifications-POSTapi-v1-admin-system-notifications-read-all">
                                <a href="#notifications-POSTapi-v1-admin-system-notifications-read-all">Mark all as read</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notifications-POSTapi-v1-admin-system-notifications-broadcast">
                                <a href="#notifications-POSTapi-v1-admin-system-notifications-broadcast">Broadcast a notification</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notifications-GETapi-v1-office-notifications">
                                <a href="#notifications-GETapi-v1-office-notifications">List notifications</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notifications-POSTapi-v1-office-notifications--id--read">
                                <a href="#notifications-POSTapi-v1-office-notifications--id--read">Mark a notification as read</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notifications-POSTapi-v1-office-notifications-read-all">
                                <a href="#notifications-POSTapi-v1-office-notifications-read-all">Mark all as read</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-office-cvs" class="tocify-header">
                <li class="tocify-item level-1" data-unique="office-cvs">
                    <a href="#office-cvs">Office / CVs</a>
                </li>
                                    <ul id="tocify-subheader-office-cvs" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="office-cvs-GETapi-v1-office-cvs">
                                <a href="#office-cvs-GETapi-v1-office-cvs">GET /api/v1/office/cvs - List my CVs</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="office-cvs-POSTapi-v1-office-cvs">
                                <a href="#office-cvs-POSTapi-v1-office-cvs">POST /api/v1/office/cvs</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="office-cvs-PUTapi-v1-office-cvs--id-">
                                <a href="#office-cvs-PUTapi-v1-office-cvs--id-">PUT/PATCH /api/v1/office/cvs/{id} - Update CV</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="office-cvs-POSTapi-v1-office-cvs--id--toggle">
                                <a href="#office-cvs-POSTapi-v1-office-cvs--id--toggle">POST /api/v1/office/cvs/{id}/toggle-active</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="office-cvs-POSTapi-v1-office-cvs--id--resubmit">
                                <a href="#office-cvs-POSTapi-v1-office-cvs--id--resubmit">POST /api/v1/office/cvs/{id}/resubmit</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="office-cvs-DELETEapi-v1-office-cvs--id-">
                                <a href="#office-cvs-DELETEapi-v1-office-cvs--id-">DELETE /api/v1/office/cvs/{id}</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-audit-logs" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-audit-logs">
                    <a href="#system-audit-logs">System / Audit Logs</a>
                </li>
                                    <ul id="tocify-subheader-system-audit-logs" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-audit-logs-GETapi-v1-admin-system-audit-logs">
                                <a href="#system-audit-logs-GETapi-v1-admin-system-audit-logs">List audit logs (read-only).</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-cvs" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-cvs">
                    <a href="#system-cvs">System / CVs</a>
                </li>
                                    <ul id="tocify-subheader-system-cvs" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-cvs-GETapi-v1-admin-system-cvs">
                                <a href="#system-cvs-GETapi-v1-admin-system-cvs">List CVs (filters supported)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-cvs-GETapi-v1-admin-system-cvs-stats">
                                <a href="#system-cvs-GETapi-v1-admin-system-cvs-stats">Stats</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-cvs-POSTapi-v1-admin-system-cvs--id--approve">
                                <a href="#system-cvs-POSTapi-v1-admin-system-cvs--id--approve">Approve CV</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-cvs-POSTapi-v1-admin-system-cvs--id--reject">
                                <a href="#system-cvs-POSTapi-v1-admin-system-cvs--id--reject">Reject CV (reason required)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-cvs-POSTapi-v1-admin-system-cvs--id--freeze">
                                <a href="#system-cvs-POSTapi-v1-admin-system-cvs--id--freeze">Freeze CV</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-cvs-POSTapi-v1-admin-system-cvs--id--unfreeze">
                                <a href="#system-cvs-POSTapi-v1-admin-system-cvs--id--unfreeze">Unfreeze CV (back to pending)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-cvs-DELETEapi-v1-admin-system-cvs--id-">
                                <a href="#system-cvs-DELETEapi-v1-admin-system-cvs--id-">Delete CV</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-categories" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-categories">
                    <a href="#system-categories">System / Categories</a>
                </li>
                                    <ul id="tocify-subheader-system-categories" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-categories-GETapi-v1-admin-system-categories">
                                <a href="#system-categories-GETapi-v1-admin-system-categories">List categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-categories-POSTapi-v1-admin-system-categories">
                                <a href="#system-categories-POSTapi-v1-admin-system-categories">Create category</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-categories-PUTapi-v1-admin-system-categories--id-">
                                <a href="#system-categories-PUTapi-v1-admin-system-categories--id-">Update category</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-categories-DELETEapi-v1-admin-system-categories--id-">
                                <a href="#system-categories-DELETEapi-v1-admin-system-categories--id-">Delete category (soft)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-categories-POSTapi-v1-admin-system-categories--id--toggle">
                                <a href="#system-categories-POSTapi-v1-admin-system-categories--id--toggle">Toggle active</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-categories-POSTapi-v1-admin-system-categories--id--translations">
                                <a href="#system-categories-POSTapi-v1-admin-system-categories--id--translations">Upsert translation</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-cities" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-cities">
                    <a href="#system-cities">System / Cities</a>
                </li>
                                    <ul id="tocify-subheader-system-cities" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-cities-GETapi-v1-cities">
                                <a href="#system-cities-GETapi-v1-cities">List cities</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-cities-POSTapi-v1-admin-system-cities">
                                <a href="#system-cities-POSTapi-v1-admin-system-cities">Create a city with translations</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-cities-PUTapi-v1-admin-system-cities--id-">
                                <a href="#system-cities-PUTapi-v1-admin-system-cities--id-">Update a city and/or its translations</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-cities-DELETEapi-v1-admin-system-cities--id-">
                                <a href="#system-cities-DELETEapi-v1-admin-system-cities--id-">Soft delete a city</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-cities-POSTapi-v1-admin-system-cities--id--toggle">
                                <a href="#system-cities-POSTapi-v1-admin-system-cities--id--toggle">Toggle active</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-coupons" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-coupons">
                    <a href="#system-coupons">System / Coupons</a>
                </li>
                                    <ul id="tocify-subheader-system-coupons" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-coupons-GETapi-v1-admin-system-coupons">
                                <a href="#system-coupons-GETapi-v1-admin-system-coupons">GET api/v1/admin/system/coupons</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-coupons-POSTapi-v1-admin-system-coupons">
                                <a href="#system-coupons-POSTapi-v1-admin-system-coupons">POST api/v1/admin/system/coupons</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-coupons-PUTapi-v1-admin-system-coupons--id-">
                                <a href="#system-coupons-PUTapi-v1-admin-system-coupons--id-">PUT api/v1/admin/system/coupons/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-coupons-DELETEapi-v1-admin-system-coupons--id-">
                                <a href="#system-coupons-DELETEapi-v1-admin-system-coupons--id-">DELETE api/v1/admin/system/coupons/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-coupons-POSTapi-v1-admin-system-coupons--id--toggle">
                                <a href="#system-coupons-POSTapi-v1-admin-system-coupons--id--toggle">POST api/v1/admin/system/coupons/{id}/toggle</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-currencies" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-currencies">
                    <a href="#system-currencies">System / Currencies</a>
                </li>
                                    <ul id="tocify-subheader-system-currencies" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-currencies-GETapi-v1-admin-system-currencies">
                                <a href="#system-currencies-GETapi-v1-admin-system-currencies">List currencies (paginated). Use ?all=1 to return all.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-currencies-POSTapi-v1-admin-system-currencies">
                                <a href="#system-currencies-POSTapi-v1-admin-system-currencies">Upsert a currency.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-currencies-PUTapi-v1-admin-system-currencies--code-">
                                <a href="#system-currencies-PUTapi-v1-admin-system-currencies--code-">Update a currency.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-currencies-DELETEapi-v1-admin-system-currencies--code-">
                                <a href="#system-currencies-DELETEapi-v1-admin-system-currencies--code-">Soft-delete a currency.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-currencies-POSTapi-v1-admin-system-currencies--code--toggle">
                                <a href="#system-currencies-POSTapi-v1-admin-system-currencies--code--toggle">Toggle active flag.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-exchange-rates" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-exchange-rates">
                    <a href="#system-exchange-rates">System / Exchange Rates</a>
                </li>
                                    <ul id="tocify-subheader-system-exchange-rates" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-exchange-rates-GETapi-v1-admin-system-exchange-rates">
                                <a href="#system-exchange-rates-GETapi-v1-admin-system-exchange-rates">List exchange rates (paginated). Use ?all=1 to return all.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-exchange-rates-POSTapi-v1-admin-system-exchange-rates">
                                <a href="#system-exchange-rates-POSTapi-v1-admin-system-exchange-rates">Upsert a rate (base-quote).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-exchange-rates-POSTapi-v1-admin-system-exchange-rates-toggle">
                                <a href="#system-exchange-rates-POSTapi-v1-admin-system-exchange-rates-toggle">Toggle active for a pair.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-insurance-companies" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-insurance-companies">
                    <a href="#system-insurance-companies">System / Insurance Companies</a>
                </li>
                                    <ul id="tocify-subheader-system-insurance-companies" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-insurance-companies-GETapi-v1-admin-system-insurance-companies">
                                <a href="#system-insurance-companies-GETapi-v1-admin-system-insurance-companies">GET api/v1/admin/system/insurance-companies</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-insurance-companies-POSTapi-v1-admin-system-insurance-companies">
                                <a href="#system-insurance-companies-POSTapi-v1-admin-system-insurance-companies">POST api/v1/admin/system/insurance-companies</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-insurance-companies-PUTapi-v1-admin-system-insurance-companies--id-">
                                <a href="#system-insurance-companies-PUTapi-v1-admin-system-insurance-companies--id-">PUT api/v1/admin/system/insurance-companies/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-insurance-companies-DELETEapi-v1-admin-system-insurance-companies--id-">
                                <a href="#system-insurance-companies-DELETEapi-v1-admin-system-insurance-companies--id-">DELETE api/v1/admin/system/insurance-companies/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-insurance-companies-POSTapi-v1-admin-system-insurance-companies--id--toggle">
                                <a href="#system-insurance-companies-POSTapi-v1-admin-system-insurance-companies--id--toggle">POST api/v1/admin/system/insurance-companies/{id}/toggle</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-languages" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-languages">
                    <a href="#system-languages">System / Languages</a>
                </li>
                                    <ul id="tocify-subheader-system-languages" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-languages-GETapi-v1-admin-system-languages">
                                <a href="#system-languages-GETapi-v1-admin-system-languages">List system languages

Paginated list. Use ?per_page=0 or ?all=1 to fetch all.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-languages-POSTapi-v1-admin-system-languages">
                                <a href="#system-languages-POSTapi-v1-admin-system-languages">Store or update a system language</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-nationalities" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-nationalities">
                    <a href="#system-nationalities">System / Nationalities</a>
                </li>
                                    <ul id="tocify-subheader-system-nationalities" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-nationalities-GETapi-v1-admin-system-nationalities">
                                <a href="#system-nationalities-GETapi-v1-admin-system-nationalities">List nationalities</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-nationalities-POSTapi-v1-admin-system-nationalities">
                                <a href="#system-nationalities-POSTapi-v1-admin-system-nationalities">Create nationality</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-nationalities-PUTapi-v1-admin-system-nationalities--id-">
                                <a href="#system-nationalities-PUTapi-v1-admin-system-nationalities--id-">Update nationality</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-nationalities-DELETEapi-v1-admin-system-nationalities--id-">
                                <a href="#system-nationalities-DELETEapi-v1-admin-system-nationalities--id-">Delete nationality</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-nationalities-POSTapi-v1-admin-system-nationalities--id--toggle">
                                <a href="#system-nationalities-POSTapi-v1-admin-system-nationalities--id--toggle">Toggle nationality</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-nationalities-POSTapi-v1-admin-system-nationalities--id--translations">
                                <a href="#system-nationalities-POSTapi-v1-admin-system-nationalities--id--translations">Upsert translation</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-plans" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-plans">
                    <a href="#system-plans">System / Plans</a>
                </li>
                                    <ul id="tocify-subheader-system-plans" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-plans-GETapi-v1-admin-system-plans">
                                <a href="#system-plans-GETapi-v1-admin-system-plans">GET api/v1/admin/system/plans</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-plans-POSTapi-v1-admin-system-plans">
                                <a href="#system-plans-POSTapi-v1-admin-system-plans">POST api/v1/admin/system/plans</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-plans-PUTapi-v1-admin-system-plans--code-">
                                <a href="#system-plans-PUTapi-v1-admin-system-plans--code-">PUT api/v1/admin/system/plans/{code}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-plans-DELETEapi-v1-admin-system-plans--code-">
                                <a href="#system-plans-DELETEapi-v1-admin-system-plans--code-">DELETE api/v1/admin/system/plans/{code}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-plans-POSTapi-v1-admin-system-plans--code--toggle">
                                <a href="#system-plans-POSTapi-v1-admin-system-plans--code--toggle">POST api/v1/admin/system/plans/{code}/toggle</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-plans-POSTapi-v1-admin-system-plans--code--translations">
                                <a href="#system-plans-POSTapi-v1-admin-system-plans--code--translations">POST api/v1/admin/system/plans/{code}/translations</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-plans-POSTapi-v1-admin-system-plans--code--features">
                                <a href="#system-plans-POSTapi-v1-admin-system-plans--code--features">POST api/v1/admin/system/plans/{code}/features</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-promotions" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-promotions">
                    <a href="#system-promotions">System / Promotions</a>
                </li>
                                    <ul id="tocify-subheader-system-promotions" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-promotions-GETapi-v1-admin-system-promotions">
                                <a href="#system-promotions-GETapi-v1-admin-system-promotions">GET api/v1/admin/system/promotions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-promotions-POSTapi-v1-admin-system-promotions">
                                <a href="#system-promotions-POSTapi-v1-admin-system-promotions">POST api/v1/admin/system/promotions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-promotions-PUTapi-v1-admin-system-promotions--id-">
                                <a href="#system-promotions-PUTapi-v1-admin-system-promotions--id-">PUT api/v1/admin/system/promotions/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-promotions-DELETEapi-v1-admin-system-promotions--id-">
                                <a href="#system-promotions-DELETEapi-v1-admin-system-promotions--id-">DELETE api/v1/admin/system/promotions/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-promotions-POSTapi-v1-admin-system-promotions--id--toggle">
                                <a href="#system-promotions-POSTapi-v1-admin-system-promotions--id--toggle">POST api/v1/admin/system/promotions/{id}/toggle</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-roles" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-roles">
                    <a href="#system-roles">System / Roles</a>
                </li>
                                    <ul id="tocify-subheader-system-roles" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-roles-GETapi-v1-admin-system-roles">
                                <a href="#system-roles-GETapi-v1-admin-system-roles">GET api/v1/admin/system/roles</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-roles-POSTapi-v1-admin-system-roles">
                                <a href="#system-roles-POSTapi-v1-admin-system-roles">POST api/v1/admin/system/roles</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-roles-PUTapi-v1-admin-system-roles--id-">
                                <a href="#system-roles-PUTapi-v1-admin-system-roles--id-">PUT api/v1/admin/system/roles/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-roles-DELETEapi-v1-admin-system-roles--id-">
                                <a href="#system-roles-DELETEapi-v1-admin-system-roles--id-">DELETE api/v1/admin/system/roles/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-roles-POSTapi-v1-admin-system-roles--id--toggle">
                                <a href="#system-roles-POSTapi-v1-admin-system-roles--id--toggle">POST api/v1/admin/system/roles/{id}/toggle</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-roles-POSTapi-v1-admin-system-roles--id--sync-permissions">
                                <a href="#system-roles-POSTapi-v1-admin-system-roles--id--sync-permissions">POST api/v1/admin/system/roles/{id}/sync-permissions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-roles-GETapi-v1-admin-system-roles--id-">
                                <a href="#system-roles-GETapi-v1-admin-system-roles--id-">GET api/v1/admin/system/roles/{id}</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-system-users" class="tocify-header">
                <li class="tocify-item level-1" data-unique="system-users">
                    <a href="#system-users">System / Users</a>
                </li>
                                    <ul id="tocify-subheader-system-users" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="system-users-GETapi-v1-admin-system-users">
                                <a href="#system-users-GETapi-v1-admin-system-users">GET api/v1/admin/system/users</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-users-POSTapi-v1-admin-system-users">
                                <a href="#system-users-POSTapi-v1-admin-system-users">POST api/v1/admin/system/users</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-users-PUTapi-v1-admin-system-users--id-">
                                <a href="#system-users-PUTapi-v1-admin-system-users--id-">PUT api/v1/admin/system/users/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-users-DELETEapi-v1-admin-system-users--id-">
                                <a href="#system-users-DELETEapi-v1-admin-system-users--id-">DELETE api/v1/admin/system/users/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-users-POSTapi-v1-admin-system-users--id--toggle">
                                <a href="#system-users-POSTapi-v1-admin-system-users--id--toggle">POST api/v1/admin/system/users/{id}/toggle</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="system-users-POSTapi-v1-admin-system-users--id--sync-roles">
                                <a href="#system-users-POSTapi-v1-admin-system-users--id--sync-roles">POST api/v1/admin/system/users/{id}/sync-roles</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: November 23, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>Auto-generated API docs and Postman collection.</p>
<aside>
    <strong>Base URL</strong>: <code>https://mery.alemtayaz.com/</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer your-token"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-health">GET api/health</h2>

<p>
</p>



<span id="example-requests-GETapi-health">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/health"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/health"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-health">
    </span>
<span id="execution-results-GETapi-health" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-health"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-health"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-health" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-health">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-health" data-method="GET"
      data-path="api/health"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-health', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-health"
                    onclick="tryItOut('GETapi-health');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-health"
                    onclick="cancelTryOut('GETapi-health');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-health"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/health</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-GETapi-v1-debug-token">GET api/v1/debug/token</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-debug-token">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/debug/token"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/debug/token"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-debug-token">
    </span>
<span id="execution-results-GETapi-v1-debug-token" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-debug-token"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-debug-token"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-debug-token" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-debug-token">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-debug-token" data-method="GET"
      data-path="api/v1/debug/token"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-debug-token', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-debug-token"
                    onclick="tryItOut('GETapi-v1-debug-token');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-debug-token"
                    onclick="cancelTryOut('GETapi-v1-debug-token');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-debug-token"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/debug/token</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-GETapi-v1-ping">GET api/v1/ping</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-ping">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/ping"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/ping"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-ping">
    </span>
<span id="execution-results-GETapi-v1-ping" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-ping"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-ping"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-ping" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-ping">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-ping" data-method="GET"
      data-path="api/v1/ping"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-ping', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-ping"
                    onclick="tryItOut('GETapi-v1-ping');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-ping"
                    onclick="cancelTryOut('GETapi-v1-ping');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-ping"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/ping</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-GETapi-v1-test-auth">GET api/v1/test-auth</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-test-auth">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/test-auth"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/test-auth"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-test-auth">
    </span>
<span id="execution-results-GETapi-v1-test-auth" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-test-auth"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-test-auth"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-test-auth" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-test-auth">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-test-auth" data-method="GET"
      data-path="api/v1/test-auth"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-test-auth', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-test-auth"
                    onclick="tryItOut('GETapi-v1-test-auth');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-test-auth"
                    onclick="cancelTryOut('GETapi-v1-test-auth');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-test-auth"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/test-auth</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-auth-login">POST api/v1/auth/login</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/auth/login"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/auth/login"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-login">
</span>
<span id="execution-results-POSTapi-v1-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-login" data-method="POST"
      data-path="api/v1/auth/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-login"
                    onclick="tryItOut('POSTapi-v1-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-login"
                    onclick="cancelTryOut('POSTapi-v1-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/login</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-auth-logout">POST api/v1/auth/logout</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/auth/logout"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/auth/logout"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-logout">
</span>
<span id="execution-results-POSTapi-v1-auth-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-logout" data-method="POST"
      data-path="api/v1/auth/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-logout"
                    onclick="tryItOut('POSTapi-v1-auth-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-logout"
                    onclick="cancelTryOut('POSTapi-v1-auth-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/logout</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-GETapi-v1-admin-system-pages">List pages</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-pages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/pages?title=About&amp;slug=about-us&amp;active=1&amp;from=2025-01-01&amp;to=2025-12-31&amp;per_page=15"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/pages"
);

const params = {
    "title": "About",
    "slug": "about-us",
    "active": "1",
    "from": "2025-01-01",
    "to": "2025-12-31",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-pages">
    </span>
<span id="execution-results-GETapi-v1-admin-system-pages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-pages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-pages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-pages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-pages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-pages" data-method="GET"
      data-path="api/v1/admin/system/pages"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-pages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-pages"
                    onclick="tryItOut('GETapi-v1-admin-system-pages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-pages"
                    onclick="cancelTryOut('GETapi-v1-admin-system-pages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-pages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/pages</code></b>
        </p>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="GETapi-v1-admin-system-pages"
               value="About"
               data-component="query">
    <br>
<p>Search by title. Example: <code>About</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="GETapi-v1-admin-system-pages"
               value="about-us"
               data-component="query">
    <br>
<p>Filter by slug. Example: <code>about-us</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="GETapi-v1-admin-system-pages" style="display: none">
            <input type="radio" name="active"
                   value="1"
                   data-endpoint="GETapi-v1-admin-system-pages"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-admin-system-pages" style="display: none">
            <input type="radio" name="active"
                   value="0"
                   data-endpoint="GETapi-v1-admin-system-pages"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Filter by active. Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="from"                data-endpoint="GETapi-v1-admin-system-pages"
               value="2025-01-01"
               data-component="query">
    <br>
<p>date Example: <code>2025-01-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="to"                data-endpoint="GETapi-v1-admin-system-pages"
               value="2025-12-31"
               data-component="query">
    <br>
<p>date Example: <code>2025-12-31</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-admin-system-pages"
               value="15"
               data-component="query">
    <br>
<p>Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="endpoints-GETapi-v1-admin-system-pages--id-">Show single page by ID or slug</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-pages--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/pages/17"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/pages/17"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-pages--id-">
    </span>
<span id="execution-results-GETapi-v1-admin-system-pages--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-pages--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-pages--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-pages--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-pages--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-pages--id-" data-method="GET"
      data-path="api/v1/admin/system/pages/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-pages--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-pages--id-"
                    onclick="tryItOut('GETapi-v1-admin-system-pages--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-pages--id-"
                    onclick="cancelTryOut('GETapi-v1-admin-system-pages--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-pages--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/pages/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-admin-system-pages--id-"
               value="17"
               data-component="url">
    <br>
<p>The page ID or slug Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-admin-system-pages">Create page</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-pages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/pages" \
    --header "Content-Type: application/json" \
    --data "{
    \"title\": \"About Us\",
    \"slug\": \"about-us\",
    \"content\": \"Page content here\",
    \"meta_title\": \"About Us - Meta Title\",
    \"meta_description\": \"Meta description\",
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/pages"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "About Us",
    "slug": "about-us",
    "content": "Page content here",
    "meta_title": "About Us - Meta Title",
    "meta_description": "Meta description",
    "active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-pages">
</span>
<span id="execution-results-POSTapi-v1-admin-system-pages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-pages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-pages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-pages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-pages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-pages" data-method="POST"
      data-path="api/v1/admin/system/pages"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-pages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-pages"
                    onclick="tryItOut('POSTapi-v1-admin-system-pages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-pages"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-pages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-pages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/pages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-pages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-v1-admin-system-pages"
               value="About Us"
               data-component="body">
    <br>
<p>Example: <code>About Us</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="POSTapi-v1-admin-system-pages"
               value="about-us"
               data-component="body">
    <br>
<p>Example: <code>about-us</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content</code></b>&nbsp;&nbsp;
<small>text</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="content"                data-endpoint="POSTapi-v1-admin-system-pages"
               value="Page content here"
               data-component="body">
    <br>
<p>Example: <code>Page content here</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta_title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta_title"                data-endpoint="POSTapi-v1-admin-system-pages"
               value="About Us - Meta Title"
               data-component="body">
    <br>
<p>Example: <code>About Us - Meta Title</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta_description</code></b>&nbsp;&nbsp;
<small>text</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta_description"                data-endpoint="POSTapi-v1-admin-system-pages"
               value="Meta description"
               data-component="body">
    <br>
<p>Example: <code>Meta description</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-pages" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-pages"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-pages" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-pages"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-v1-admin-system-pages--id-">Update page</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-admin-system-pages--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/pages/17" \
    --header "Content-Type: application/json" \
    --data "{
    \"title\": \"About Us\",
    \"slug\": \"about-us\",
    \"content\": \"Page content here\",
    \"meta_title\": \"About Us - Meta Title\",
    \"meta_description\": \"Meta description\",
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/pages/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "About Us",
    "slug": "about-us",
    "content": "Page content here",
    "meta_title": "About Us - Meta Title",
    "meta_description": "Meta description",
    "active": true
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-pages--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-system-pages--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-pages--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-pages--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-pages--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-pages--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-pages--id-" data-method="PUT"
      data-path="api/v1/admin/system/pages/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-pages--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-pages--id-"
                    onclick="tryItOut('PUTapi-v1-admin-system-pages--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-pages--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-pages--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-pages--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/pages/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-system-pages--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-admin-system-pages--id-"
               value="17"
               data-component="url">
    <br>
<p>Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-v1-admin-system-pages--id-"
               value="About Us"
               data-component="body">
    <br>
<p>Example: <code>About Us</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="PUTapi-v1-admin-system-pages--id-"
               value="about-us"
               data-component="body">
    <br>
<p>Example: <code>about-us</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content</code></b>&nbsp;&nbsp;
<small>text</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="content"                data-endpoint="PUTapi-v1-admin-system-pages--id-"
               value="Page content here"
               data-component="body">
    <br>
<p>Example: <code>Page content here</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta_title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta_title"                data-endpoint="PUTapi-v1-admin-system-pages--id-"
               value="About Us - Meta Title"
               data-component="body">
    <br>
<p>Example: <code>About Us - Meta Title</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta_description</code></b>&nbsp;&nbsp;
<small>text</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta_description"                data-endpoint="PUTapi-v1-admin-system-pages--id-"
               value="Meta description"
               data-component="body">
    <br>
<p>Example: <code>Meta description</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-pages--id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-pages--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-pages--id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-pages--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-admin-system-pages--id--toggle">Toggle page active status</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-pages--id--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/pages/17/toggle" \
    --header "Content-Type: application/json" \
    --data "{
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/pages/17/toggle"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-pages--id--toggle">
</span>
<span id="execution-results-POSTapi-v1-admin-system-pages--id--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-pages--id--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-pages--id--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-pages--id--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-pages--id--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-pages--id--toggle" data-method="POST"
      data-path="api/v1/admin/system/pages/{id}/toggle"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-pages--id--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-pages--id--toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-pages--id--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-pages--id--toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-pages--id--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-pages--id--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/pages/{id}/toggle</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-pages--id--toggle"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-admin-system-pages--id--toggle"
               value="17"
               data-component="url">
    <br>
<p>Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-pages--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-pages--id--toggle"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-pages--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-pages--id--toggle"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-admin-system-pages--id-">Delete page</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-pages--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/pages/17"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/pages/17"
);

fetch(url, {
    method: "DELETE",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-pages--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-system-pages--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-pages--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-pages--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-pages--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-pages--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-pages--id-" data-method="DELETE"
      data-path="api/v1/admin/system/pages/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-pages--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-pages--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-pages--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-pages--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-pages--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-pages--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/pages/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-admin-system-pages--id-"
               value="17"
               data-component="url">
    <br>
<p>Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-admin-system-settings">GET /v1/admin/system/settings?scope=global|null
يعرض الإعدادات حسب الـ scope (أو الكل لو scope=null)</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-settings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/settings"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/settings"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-settings">
    </span>
<span id="execution-results-GETapi-v1-admin-system-settings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-settings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-settings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-settings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-settings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-settings" data-method="GET"
      data-path="api/v1/admin/system/settings"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-settings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-settings"
                    onclick="tryItOut('GETapi-v1-admin-system-settings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-settings"
                    onclick="cancelTryOut('GETapi-v1-admin-system-settings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-settings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/settings</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-PUTapi-v1-admin-system-settings--key-">PUT /v1/admin/system/settings/{key}
body: { value: mixed, scope?: string, type?: &quot;string&quot;|&quot;json&quot; }</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-admin-system-settings--key-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/settings/consequatur"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/settings/consequatur"
);

fetch(url, {
    method: "PUT",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-settings--key-">
</span>
<span id="execution-results-PUTapi-v1-admin-system-settings--key-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-settings--key-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-settings--key-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-settings--key-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-settings--key-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-settings--key-" data-method="PUT"
      data-path="api/v1/admin/system/settings/{key}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-settings--key-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-settings--key-"
                    onclick="tryItOut('PUTapi-v1-admin-system-settings--key-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-settings--key-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-settings--key-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-settings--key-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/settings/{key}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>key</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="key"                data-endpoint="PUTapi-v1-admin-system-settings--key-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-admin-system-permissions">GET api/v1/admin/system/permissions</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-permissions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/permissions"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/permissions"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-permissions">
    </span>
<span id="execution-results-GETapi-v1-admin-system-permissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-permissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-permissions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-permissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-permissions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-permissions" data-method="GET"
      data-path="api/v1/admin/system/permissions"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-permissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-permissions"
                    onclick="tryItOut('GETapi-v1-admin-system-permissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-permissions"
                    onclick="cancelTryOut('GETapi-v1-admin-system-permissions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-permissions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/permissions</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-admin-system-permissions">POST api/v1/admin/system/permissions</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-permissions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/permissions" \
    --header "Content-Type: application/json" \
    --data "{
    \"name\": \"List Users\",
    \"slug\": \"system.users.index\",
    \"guard\": \"api\",
    \"active\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/permissions"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "List Users",
    "slug": "system.users.index",
    "guard": "api",
    "active": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-permissions">
</span>
<span id="execution-results-POSTapi-v1-admin-system-permissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-permissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-permissions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-permissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-permissions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-permissions" data-method="POST"
      data-path="api/v1/admin/system/permissions"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-permissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-permissions"
                    onclick="tryItOut('POSTapi-v1-admin-system-permissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-permissions"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-permissions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-permissions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/permissions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-permissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-permissions"
               value="List Users"
               data-component="body">
    <br>
<p>Permission display name. Must not be greater than 191 characters. Example: <code>List Users</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="POSTapi-v1-admin-system-permissions"
               value="system.users.index"
               data-component="body">
    <br>
<p>Unique slug (module.action). Must not be greater than 191 characters. Example: <code>system.users.index</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>guard</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="guard"                data-endpoint="POSTapi-v1-admin-system-permissions"
               value="api"
               data-component="body">
    <br>
<p>Auth guard. Must not be greater than 32 characters. Example: <code>api</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-permissions" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-permissions"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-permissions" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-permissions"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active flag. Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-v1-admin-system-permissions--id-">PUT api/v1/admin/system/permissions/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-admin-system-permissions--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/permissions/consequatur" \
    --header "Content-Type: application/json" \
    --data "{
    \"name\": \"Create User\",
    \"slug\": \"system.users.store\",
    \"guard\": \"api\",
    \"active\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/permissions/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Create User",
    "slug": "system.users.store",
    "guard": "api",
    "active": false
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-permissions--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-system-permissions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-permissions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-permissions--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-permissions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-permissions--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-permissions--id-" data-method="PUT"
      data-path="api/v1/admin/system/permissions/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-permissions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-permissions--id-"
                    onclick="tryItOut('PUTapi-v1-admin-system-permissions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-permissions--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-permissions--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-permissions--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/permissions/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-system-permissions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-v1-admin-system-permissions--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the permission. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-admin-system-permissions--id-"
               value="Create User"
               data-component="body">
    <br>
<p>Permission display name. Must not be greater than 191 characters. Example: <code>Create User</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="PUTapi-v1-admin-system-permissions--id-"
               value="system.users.store"
               data-component="body">
    <br>
<p>Unique slug. Must not be greater than 191 characters. Example: <code>system.users.store</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>guard</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="guard"                data-endpoint="PUTapi-v1-admin-system-permissions--id-"
               value="api"
               data-component="body">
    <br>
<p>Auth guard. Must not be greater than 32 characters. Example: <code>api</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-permissions--id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-permissions--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-permissions--id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-permissions--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active flag. Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-admin-system-permissions--id-">DELETE api/v1/admin/system/permissions/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-permissions--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/permissions/consequatur"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/permissions/consequatur"
);

fetch(url, {
    method: "DELETE",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-permissions--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-system-permissions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-permissions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-permissions--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-permissions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-permissions--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-permissions--id-" data-method="DELETE"
      data-path="api/v1/admin/system/permissions/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-permissions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-permissions--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-permissions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-permissions--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-permissions--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-permissions--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/permissions/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-admin-system-permissions--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the permission. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-admin-system-permissions--id--toggle">POST api/v1/admin/system/permissions/{id}/toggle</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-permissions--id--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/permissions/consequatur/toggle"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/permissions/consequatur/toggle"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-permissions--id--toggle">
</span>
<span id="execution-results-POSTapi-v1-admin-system-permissions--id--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-permissions--id--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-permissions--id--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-permissions--id--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-permissions--id--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-permissions--id--toggle" data-method="POST"
      data-path="api/v1/admin/system/permissions/{id}/toggle"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-permissions--id--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-permissions--id--toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-permissions--id--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-permissions--id--toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-permissions--id--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-permissions--id--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/permissions/{id}/toggle</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-v1-admin-system-permissions--id--toggle"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the permission. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-admin-system-offices">عرض قائمة المكاتب مع الفلاتر</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-offices">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/offices"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/offices"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-offices">
    </span>
<span id="execution-results-GETapi-v1-admin-system-offices" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-offices"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-offices"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-offices" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-offices">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-offices" data-method="GET"
      data-path="api/v1/admin/system/offices"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-offices', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-offices"
                    onclick="tryItOut('GETapi-v1-admin-system-offices');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-offices"
                    onclick="cancelTryOut('GETapi-v1-admin-system-offices');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-offices"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/offices</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-GETapi-v1-admin-system-offices-stats">إحصائيات سريعة للمكاتب وملفات السير الذاتية</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-offices-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/offices-stats"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/offices-stats"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-offices-stats">
    </span>
<span id="execution-results-GETapi-v1-admin-system-offices-stats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-offices-stats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-offices-stats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-offices-stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-offices-stats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-offices-stats" data-method="GET"
      data-path="api/v1/admin/system/offices-stats"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-offices-stats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-offices-stats"
                    onclick="tryItOut('GETapi-v1-admin-system-offices-stats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-offices-stats"
                    onclick="cancelTryOut('GETapi-v1-admin-system-offices-stats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-offices-stats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/offices-stats</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-GETapi-v1-admin-system-offices--id-">عرض مكتب واحد حسب المعرّف</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-offices--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/offices/17"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/offices/17"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-offices--id-">
    </span>
<span id="execution-results-GETapi-v1-admin-system-offices--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-offices--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-offices--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-offices--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-offices--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-offices--id-" data-method="GET"
      data-path="api/v1/admin/system/offices/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-offices--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-offices--id-"
                    onclick="tryItOut('GETapi-v1-admin-system-offices--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-offices--id-"
                    onclick="cancelTryOut('GETapi-v1-admin-system-offices--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-offices--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/offices/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-admin-system-offices--id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the office. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-admin-system-offices">إنشاء مكتب جديد</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-offices">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/offices" \
    --header "Content-Type: multipart/form-data" \
    --form "name=مكتب التميّز"\
    --form "commercial_reg_no=1010123456"\
    --form "city_id=1"\
    --form "address=الرياض - حي العليا"\
    --form "phone=+966500000000"\
    --form "email=office@example.com"\
    --form "password=secret123"\
    --form "active="\
    --form "blocked="\
    --form "image=@E:\xampp\htdocs\xampp\mery\resources\scribe\examples\office.jpg" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/offices"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'مكتب التميّز');
body.append('commercial_reg_no', '1010123456');
body.append('city_id', '1');
body.append('address', 'الرياض - حي العليا');
body.append('phone', '+966500000000');
body.append('email', 'office@example.com');
body.append('password', 'secret123');
body.append('active', '');
body.append('blocked', '');
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-offices">
</span>
<span id="execution-results-POSTapi-v1-admin-system-offices" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-offices"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-offices"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-offices" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-offices">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-offices" data-method="POST"
      data-path="api/v1/admin/system/offices"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-offices', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-offices"
                    onclick="tryItOut('POSTapi-v1-admin-system-offices');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-offices"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-offices');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-offices"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/offices</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-offices"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-offices"
               value="مكتب التميّز"
               data-component="body">
    <br>
<p>اسم المكتب. Must not be greater than 191 characters. Example: <code>مكتب التميّز</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>commercial_reg_no</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="commercial_reg_no"                data-endpoint="POSTapi-v1-admin-system-offices"
               value="1010123456"
               data-component="body">
    <br>
<p>رقم السجل التجاري. Must not be greater than 191 characters. Example: <code>1010123456</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="city_id"                data-endpoint="POSTapi-v1-admin-system-offices"
               value="1"
               data-component="body">
    <br>
<p>معرّف المدينة (cities.id). Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-v1-admin-system-offices"
               value="الرياض - حي العليا"
               data-component="body">
    <br>
<p>العنوان التفصيلي. Must not be greater than 255 characters. Example: <code>الرياض - حي العليا</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-v1-admin-system-offices"
               value="+966500000000"
               data-component="body">
    <br>
<p>رقم الجوال. Must not be greater than 32 characters. Example: <code>+966500000000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-admin-system-offices"
               value="office@example.com"
               data-component="body">
    <br>
<p>البريد الإلكتروني. Must be a valid email address. Must not be greater than 191 characters. Example: <code>office@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-admin-system-offices"
               value="secret123"
               data-component="body">
    <br>
<p>كلمة المرور. Must be at least 6 characters. Example: <code>secret123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-offices" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-offices"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-offices" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-offices"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>نشط. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>blocked</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-offices" style="display: none">
            <input type="radio" name="blocked"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-offices"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-offices" style="display: none">
            <input type="radio" name="blocked"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-offices"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>محظور. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="POSTapi-v1-admin-system-offices"
               value=""
               data-component="body">
    <br>
<p>صورة المكتب (اختيارية). Must be an image. Must not be greater than 2048 kilobytes. Example: <code>resources/scribe/examples/office.jpg</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-v1-admin-system-offices--id-">تحديث بيانات المكتب</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-admin-system-offices--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/offices/17" \
    --header "Content-Type: multipart/form-data" \
    --form "name=vmqeopfuudtdsufvyvddq"\
    --form "commercial_reg_no=amniihfqcoynlazghdtqt"\
    --form "city_id=17"\
    --form "address=mqeopfuudtdsufvyvddqa"\
    --form "phone=mniihfqcoynlazghdtqtq"\
    --form "email=ablanda@example.org"\
    --form "password='YAKYLk4&gt;SJIrIV#lz."\
    --form "active="\
    --form "blocked=1"\
    --form "image=@C:\Users\ahmednour\AppData\Local\Microsoft\WinGet\Packages\Astronomer.Astro_Microsoft.Winget.Source_8wekyb3d8bbwe\php14B5.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/offices/17"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'vmqeopfuudtdsufvyvddq');
body.append('commercial_reg_no', 'amniihfqcoynlazghdtqt');
body.append('city_id', '17');
body.append('address', 'mqeopfuudtdsufvyvddqa');
body.append('phone', 'mniihfqcoynlazghdtqtq');
body.append('email', 'ablanda@example.org');
body.append('password', ''YAKYLk4&gt;SJIrIV#lz.');
body.append('active', '');
body.append('blocked', '1');
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-offices--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-system-offices--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-offices--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-offices--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-offices--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-offices--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-offices--id-" data-method="PUT"
      data-path="api/v1/admin/system/offices/{id}"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-offices--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-offices--id-"
                    onclick="tryItOut('PUTapi-v1-admin-system-offices--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-offices--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-offices--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-offices--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/offices/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-system-offices--id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-admin-system-offices--id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the office. Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-admin-system-offices--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 191 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>commercial_reg_no</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="commercial_reg_no"                data-endpoint="PUTapi-v1-admin-system-offices--id-"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 191 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="city_id"                data-endpoint="PUTapi-v1-admin-system-offices--id-"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-v1-admin-system-offices--id-"
               value="mqeopfuudtdsufvyvddqa"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>mqeopfuudtdsufvyvddqa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-v1-admin-system-offices--id-"
               value="mniihfqcoynlazghdtqtq"
               data-component="body">
    <br>
<p>Must not be greater than 32 characters. Example: <code>mniihfqcoynlazghdtqtq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-v1-admin-system-offices--id-"
               value="ablanda@example.org"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 191 characters. Example: <code>ablanda@example.org</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="PUTapi-v1-admin-system-offices--id-"
               value="'YAKYLk4>SJIrIV#lz."
               data-component="body">
    <br>
<p>Must be at least 6 characters. Example: <code>'YAKYLk4&gt;SJIrIV#lz.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-offices--id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-offices--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-offices--id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-offices--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>blocked</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-offices--id-" style="display: none">
            <input type="radio" name="blocked"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-offices--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-offices--id-" style="display: none">
            <input type="radio" name="blocked"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-offices--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="PUTapi-v1-admin-system-offices--id-"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 2048 kilobytes. Example: <code>C:\Users\ahmednour\AppData\Local\Microsoft\WinGet\Packages\Astronomer.Astro_Microsoft.Winget.Source_8wekyb3d8bbwe\php14B5.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-admin-system-offices--id--block">حظر / إلغاء حظر</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-offices--id--block">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/offices/17/block"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/offices/17/block"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-offices--id--block">
</span>
<span id="execution-results-POSTapi-v1-admin-system-offices--id--block" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-offices--id--block"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-offices--id--block"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-offices--id--block" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-offices--id--block">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-offices--id--block" data-method="POST"
      data-path="api/v1/admin/system/offices/{id}/block"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-offices--id--block', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-offices--id--block"
                    onclick="tryItOut('POSTapi-v1-admin-system-offices--id--block');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-offices--id--block"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-offices--id--block');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-offices--id--block"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/offices/{id}/block</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-admin-system-offices--id--block"
               value="17"
               data-component="url">
    <br>
<p>The ID of the office. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-admin-system-offices--id--toggle">تفعيل / تعطيل</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-offices--id--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/offices/17/toggle"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/offices/17/toggle"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-offices--id--toggle">
</span>
<span id="execution-results-POSTapi-v1-admin-system-offices--id--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-offices--id--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-offices--id--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-offices--id--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-offices--id--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-offices--id--toggle" data-method="POST"
      data-path="api/v1/admin/system/offices/{id}/toggle"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-offices--id--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-offices--id--toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-offices--id--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-offices--id--toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-offices--id--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-offices--id--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/offices/{id}/toggle</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-admin-system-offices--id--toggle"
               value="17"
               data-component="url">
    <br>
<p>The ID of the office. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEapi-v1-admin-system-offices--id-">حذف مكتب</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-offices--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/offices/17"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/offices/17"
);

fetch(url, {
    method: "DELETE",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-offices--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-system-offices--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-offices--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-offices--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-offices--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-offices--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-offices--id-" data-method="DELETE"
      data-path="api/v1/admin/system/offices/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-offices--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-offices--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-offices--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-offices--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-offices--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-offices--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/offices/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-admin-system-offices--id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the office. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-office-auth-register">POST /api/v1/office/auth/register
يقبل اختيارياً: fcm_token, device, platform
لا يصدر توكن عند التسجيل — الحساب يبقى قيد المراجعة.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-office-auth-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/office/auth/register" \
    --header "Content-Type: multipart/form-data" \
    --form "name=مكتب التميز للاستقدام"\
    --form "commercial_reg_no=1010123456"\
    --form "city_id=1"\
    --form "address=الرياض - حي العليا"\
    --form "phone=+966500000000"\
    --form "email=office@example.com"\
    --form "password=secret123"\
    --form "image=@E:\xampp\htdocs\xampp\mery\resources\scribe\examples\office.jpg" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/auth/register"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'مكتب التميز للاستقدام');
body.append('commercial_reg_no', '1010123456');
body.append('city_id', '1');
body.append('address', 'الرياض - حي العليا');
body.append('phone', '+966500000000');
body.append('email', 'office@example.com');
body.append('password', 'secret123');
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-office-auth-register">
</span>
<span id="execution-results-POSTapi-v1-office-auth-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-office-auth-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-office-auth-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-office-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-office-auth-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-office-auth-register" data-method="POST"
      data-path="api/v1/office/auth/register"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-office-auth-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-office-auth-register"
                    onclick="tryItOut('POSTapi-v1-office-auth-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-office-auth-register"
                    onclick="cancelTryOut('POSTapi-v1-office-auth-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-office-auth-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/office/auth/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-office-auth-register"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-office-auth-register"
               value="مكتب التميز للاستقدام"
               data-component="body">
    <br>
<p>اسم المكتب. Must not be greater than 191 characters. Example: <code>مكتب التميز للاستقدام</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>commercial_reg_no</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="commercial_reg_no"                data-endpoint="POSTapi-v1-office-auth-register"
               value="1010123456"
               data-component="body">
    <br>
<p>رقم السجل التجاري (فريد). Must not be greater than 191 characters. Example: <code>1010123456</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="city_id"                data-endpoint="POSTapi-v1-office-auth-register"
               value="1"
               data-component="body">
    <br>
<p>معرّف المدينة. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-v1-office-auth-register"
               value="الرياض - حي العليا"
               data-component="body">
    <br>
<p>العنوان. Must not be greater than 255 characters. Example: <code>الرياض - حي العليا</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-v1-office-auth-register"
               value="+966500000000"
               data-component="body">
    <br>
<p>رقم الجوال. Must not be greater than 32 characters. Example: <code>+966500000000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-office-auth-register"
               value="office@example.com"
               data-component="body">
    <br>
<p>البريد الإلكتروني. Must be a valid email address. Must not be greater than 191 characters. Example: <code>office@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-office-auth-register"
               value="secret123"
               data-component="body">
    <br>
<p>كلمة المرور. Must be at least 6 characters. Example: <code>secret123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="POSTapi-v1-office-auth-register"
               value=""
               data-component="body">
    <br>
<p>صورة المكتب (اختيارية). Must be an image. Must not be greater than 2048 kilobytes. Example: <code>resources/scribe/examples/office.jpg</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-office-auth-login">POST /api/v1/office/auth/login</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-office-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/office/auth/login" \
    --header "Content-Type: application/json" \
    --data "{
    \"email\": \"office@example.com\",
    \"password\": \"secret123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/auth/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "office@example.com",
    "password": "secret123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-office-auth-login">
</span>
<span id="execution-results-POSTapi-v1-office-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-office-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-office-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-office-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-office-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-office-auth-login" data-method="POST"
      data-path="api/v1/office/auth/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-office-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-office-auth-login"
                    onclick="tryItOut('POSTapi-v1-office-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-office-auth-login"
                    onclick="cancelTryOut('POSTapi-v1-office-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-office-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/office/auth/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-office-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-office-auth-login"
               value="office@example.com"
               data-component="body">
    <br>
<p>البريد الإلكتروني للمكتب. Must be a valid email address. Example: <code>office@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-office-auth-login"
               value="secret123"
               data-component="body">
    <br>
<p>كلمة المرور. Example: <code>secret123</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-office-auth-forgot-password">POST /api/v1/office/auth/forgot-password
يُرسل كود 6 أرقام للبريد، صالح لمدة 15 دقيقة.</h2>

<p>
</p>

<p>الرد دائمًا عام لتجنّب كشف وجود البريد.</p>

<span id="example-requests-POSTapi-v1-office-auth-forgot-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/office/auth/forgot-password" \
    --header "Content-Type: application/json" \
    --data "{
    \"email\": \"office@example.com\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/auth/forgot-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "office@example.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-office-auth-forgot-password">
</span>
<span id="execution-results-POSTapi-v1-office-auth-forgot-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-office-auth-forgot-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-office-auth-forgot-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-office-auth-forgot-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-office-auth-forgot-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-office-auth-forgot-password" data-method="POST"
      data-path="api/v1/office/auth/forgot-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-office-auth-forgot-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-office-auth-forgot-password"
                    onclick="tryItOut('POSTapi-v1-office-auth-forgot-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-office-auth-forgot-password"
                    onclick="cancelTryOut('POSTapi-v1-office-auth-forgot-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-office-auth-forgot-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/office/auth/forgot-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-office-auth-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-office-auth-forgot-password"
               value="office@example.com"
               data-component="body">
    <br>
<p>البريد المرتبط بحساب المكتب لتوليد رمز الاستعادة. Must be a valid email address. The <code>email</code> of an existing record in the system.offices table. Example: <code>office@example.com</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-office-auth-reset-password">POST /api/v1/office/auth/reset-password
يُتحقق من الكود ثم يغيّر كلمة المرور.</h2>

<p>
</p>

<p>يدعم bypass للتطوير بكود 1234 (أو من config('auth.reset_dev_code')) في بيئات غير الإنتاج.</p>

<span id="example-requests-POSTapi-v1-office-auth-reset-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/office/auth/reset-password" \
    --header "Content-Type: application/json" \
    --data "{
    \"email\": \"office@example.com\",
    \"code\": \"123456\",
    \"password\": \"NewStrongPass!23\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/auth/reset-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "office@example.com",
    "code": "123456",
    "password": "NewStrongPass!23"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-office-auth-reset-password">
</span>
<span id="execution-results-POSTapi-v1-office-auth-reset-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-office-auth-reset-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-office-auth-reset-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-office-auth-reset-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-office-auth-reset-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-office-auth-reset-password" data-method="POST"
      data-path="api/v1/office/auth/reset-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-office-auth-reset-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-office-auth-reset-password"
                    onclick="tryItOut('POSTapi-v1-office-auth-reset-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-office-auth-reset-password"
                    onclick="cancelTryOut('POSTapi-v1-office-auth-reset-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-office-auth-reset-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/office/auth/reset-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-office-auth-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-office-auth-reset-password"
               value="office@example.com"
               data-component="body">
    <br>
<p>البريد المرتبط بالحساب. Must be a valid email address. The <code>email</code> of an existing record in the system.offices table. Example: <code>office@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-office-auth-reset-password"
               value="123456"
               data-component="body">
    <br>
<p>كود الاستعادة المرسل عبر البريد (6 أرقام). Must be 6 characters. Example: <code>123456</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-office-auth-reset-password"
               value="NewStrongPass!23"
               data-component="body">
    <br>
<p>كلمة المرور الجديدة. Must be at least 6 characters. Example: <code>NewStrongPass!23</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-office-me">GET /api/v1/office/me</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-office-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/office/me"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/me"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-office-me">
    </span>
<span id="execution-results-GETapi-v1-office-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-office-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-office-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-office-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-office-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-office-me" data-method="GET"
      data-path="api/v1/office/me"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-office-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-office-me"
                    onclick="tryItOut('GETapi-v1-office-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-office-me"
                    onclick="cancelTryOut('GETapi-v1-office-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-office-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/office/me</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-office-auth-logout">POST /api/v1/office/auth/logout
يقبل اختيارياً: fcm_token</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-office-auth-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/office/auth/logout"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/auth/logout"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-office-auth-logout">
</span>
<span id="execution-results-POSTapi-v1-office-auth-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-office-auth-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-office-auth-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-office-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-office-auth-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-office-auth-logout" data-method="POST"
      data-path="api/v1/office/auth/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-office-auth-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-office-auth-logout"
                    onclick="tryItOut('POSTapi-v1-office-auth-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-office-auth-logout"
                    onclick="cancelTryOut('POSTapi-v1-office-auth-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-office-auth-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/office/auth/logout</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-office-fcm-tokens">POST /api/v1/office/fcm-tokens</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-office-fcm-tokens">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/office/fcm-tokens" \
    --header "Content-Type: application/json" \
    --data "{
    \"token\": \"fcm_token_xxx_yyy_zzz\",
    \"device\": \"android\",
    \"platform\": \"office-app\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/fcm-tokens"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "fcm_token_xxx_yyy_zzz",
    "device": "android",
    "platform": "office-app"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-office-fcm-tokens">
</span>
<span id="execution-results-POSTapi-v1-office-fcm-tokens" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-office-fcm-tokens"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-office-fcm-tokens"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-office-fcm-tokens" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-office-fcm-tokens">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-office-fcm-tokens" data-method="POST"
      data-path="api/v1/office/fcm-tokens"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-office-fcm-tokens', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-office-fcm-tokens"
                    onclick="tryItOut('POSTapi-v1-office-fcm-tokens');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-office-fcm-tokens"
                    onclick="cancelTryOut('POSTapi-v1-office-fcm-tokens');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-office-fcm-tokens"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/office/fcm-tokens</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-office-fcm-tokens"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="POSTapi-v1-office-fcm-tokens"
               value="fcm_token_xxx_yyy_zzz"
               data-component="body">
    <br>
<p>Firebase Cloud Messaging token. Must not be greater than 512 characters. Example: <code>fcm_token_xxx_yyy_zzz</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>device</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="device"                data-endpoint="POSTapi-v1-office-fcm-tokens"
               value="android"
               data-component="body">
    <br>
<p>نوع الجهاز (ios / android / web). Must not be greater than 191 characters. Example: <code>android</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>platform</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="platform"                data-endpoint="POSTapi-v1-office-fcm-tokens"
               value="office-app"
               data-component="body">
    <br>
<p>منصة العميل/التطبيق إن لزم. Must not be greater than 191 characters. Example: <code>office-app</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-office-fcm-tokens">DELETE /api/v1/office/fcm-tokens</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-office-fcm-tokens">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/office/fcm-tokens"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/fcm-tokens"
);

fetch(url, {
    method: "DELETE",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-office-fcm-tokens">
</span>
<span id="execution-results-DELETEapi-v1-office-fcm-tokens" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-office-fcm-tokens"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-office-fcm-tokens"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-office-fcm-tokens" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-office-fcm-tokens">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-office-fcm-tokens" data-method="DELETE"
      data-path="api/v1/office/fcm-tokens"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-office-fcm-tokens', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-office-fcm-tokens"
                    onclick="tryItOut('DELETEapi-v1-office-fcm-tokens');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-office-fcm-tokens"
                    onclick="cancelTryOut('DELETEapi-v1-office-fcm-tokens');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-office-fcm-tokens"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/office/fcm-tokens</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-GETapi-v1-office-plans">GET /api/v1/office/plans
إرجاع قائمة الخطط مع سعر نهائي حسب العملة القادمة من الهيدر</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-office-plans">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/office/plans"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/plans"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-office-plans">
    </span>
<span id="execution-results-GETapi-v1-office-plans" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-office-plans"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-office-plans"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-office-plans" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-office-plans">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-office-plans" data-method="GET"
      data-path="api/v1/office/plans"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-office-plans', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-office-plans"
                    onclick="tryItOut('GETapi-v1-office-plans');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-office-plans"
                    onclick="cancelTryOut('GETapi-v1-office-plans');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-office-plans"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/office/plans</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-GETapi-v1-office-subscription">GET /api/v1/office/subscription
إرجاع الاشتراك الحالي للمكتب</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-office-subscription">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/office/subscription"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/subscription"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-office-subscription">
    </span>
<span id="execution-results-GETapi-v1-office-subscription" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-office-subscription"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-office-subscription"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-office-subscription" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-office-subscription">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-office-subscription" data-method="GET"
      data-path="api/v1/office/subscription"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-office-subscription', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-office-subscription"
                    onclick="tryItOut('GETapi-v1-office-subscription');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-office-subscription"
                    onclick="cancelTryOut('GETapi-v1-office-subscription');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-office-subscription"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/office/subscription</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-office-subscribe">POST /api/v1/office/subscribe
body: plan_code, coupon (optional)</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-office-subscribe">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/office/subscribe" \
    --header "Content-Type: application/json" \
    --data "{
    \"plan_code\": \"consequatur\",
    \"coupon\": \"mqeopfuudtdsufvyvddqa\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/subscribe"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "plan_code": "consequatur",
    "coupon": "mqeopfuudtdsufvyvddqa"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-office-subscribe">
</span>
<span id="execution-results-POSTapi-v1-office-subscribe" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-office-subscribe"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-office-subscribe"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-office-subscribe" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-office-subscribe">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-office-subscribe" data-method="POST"
      data-path="api/v1/office/subscribe"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-office-subscribe', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-office-subscribe"
                    onclick="tryItOut('POSTapi-v1-office-subscribe');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-office-subscribe"
                    onclick="cancelTryOut('POSTapi-v1-office-subscribe');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-office-subscribe"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/office/subscribe</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-office-subscribe"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>plan_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="plan_code"                data-endpoint="POSTapi-v1-office-subscribe"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>code</code> of an existing record in the system.plans table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>coupon</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="coupon"                data-endpoint="POSTapi-v1-office-subscribe"
               value="mqeopfuudtdsufvyvddqa"
               data-component="body">
    <br>
<p>Must not be greater than 64 characters. Example: <code>mqeopfuudtdsufvyvddqa</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-office-subscription-auto-renew">POST /api/v1/office/subscription/auto-renew
body: { auto_renew: bool }</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-office-subscription-auto-renew">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/office/subscription/auto-renew" \
    --header "Content-Type: application/json" \
    --data "{
    \"auto_renew\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/subscription/auto-renew"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "auto_renew": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-office-subscription-auto-renew">
</span>
<span id="execution-results-POSTapi-v1-office-subscription-auto-renew" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-office-subscription-auto-renew"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-office-subscription-auto-renew"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-office-subscription-auto-renew" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-office-subscription-auto-renew">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-office-subscription-auto-renew" data-method="POST"
      data-path="api/v1/office/subscription/auto-renew"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-office-subscription-auto-renew', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-office-subscription-auto-renew"
                    onclick="tryItOut('POSTapi-v1-office-subscription-auto-renew');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-office-subscription-auto-renew"
                    onclick="cancelTryOut('POSTapi-v1-office-subscription-auto-renew');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-office-subscription-auto-renew"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/office/subscription/auto-renew</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-office-subscription-auto-renew"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>auto_renew</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-office-subscription-auto-renew" style="display: none">
            <input type="radio" name="auto_renew"
                   value="true"
                   data-endpoint="POSTapi-v1-office-subscription-auto-renew"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-office-subscription-auto-renew" style="display: none">
            <input type="radio" name="auto_renew"
                   value="false"
                   data-endpoint="POSTapi-v1-office-subscription-auto-renew"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-enduser-auth-register">POST /api/v1/enduser/auth/register</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-enduser-auth-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/enduser/auth/register" \
    --header "Content-Type: application/json" \
    --data "{
    \"national_id\": \"1234567890\",
    \"name\": \"John Doe\",
    \"phone\": \"+966500000001\",
    \"password\": \"secret1234\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/enduser/auth/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "national_id": "1234567890",
    "name": "John Doe",
    "phone": "+966500000001",
    "password": "secret1234"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-enduser-auth-register">
</span>
<span id="execution-results-POSTapi-v1-enduser-auth-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-enduser-auth-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-enduser-auth-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-enduser-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-enduser-auth-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-enduser-auth-register" data-method="POST"
      data-path="api/v1/enduser/auth/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-enduser-auth-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-enduser-auth-register"
                    onclick="tryItOut('POSTapi-v1-enduser-auth-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-enduser-auth-register"
                    onclick="cancelTryOut('POSTapi-v1-enduser-auth-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-enduser-auth-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/enduser/auth/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-enduser-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>national_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="national_id"                data-endpoint="POSTapi-v1-enduser-auth-register"
               value="1234567890"
               data-component="body">
    <br>
<p>Unique national identifier used for login. Example: <code>1234567890</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-enduser-auth-register"
               value="John Doe"
               data-component="body">
    <br>
<p>Full name. Must not be greater than 255 characters. Example: <code>John Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-v1-enduser-auth-register"
               value="+966500000001"
               data-component="body">
    <br>
<p>Phone number. Must not be greater than 20 characters. Example: <code>+966500000001</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-enduser-auth-register"
               value="secret1234"
               data-component="body">
    <br>
<p>Password (min 8 characters). Must be at least 8 characters. Example: <code>secret1234</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-enduser-auth-login">POST /api/v1/enduser/auth/login</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-enduser-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/enduser/auth/login" \
    --header "Content-Type: application/json" \
    --data "{
    \"national_id\": \"1234567890\",
    \"password\": \"secret123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/enduser/auth/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "national_id": "1234567890",
    "password": "secret123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-enduser-auth-login">
</span>
<span id="execution-results-POSTapi-v1-enduser-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-enduser-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-enduser-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-enduser-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-enduser-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-enduser-auth-login" data-method="POST"
      data-path="api/v1/enduser/auth/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-enduser-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-enduser-auth-login"
                    onclick="tryItOut('POSTapi-v1-enduser-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-enduser-auth-login"
                    onclick="cancelTryOut('POSTapi-v1-enduser-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-enduser-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/enduser/auth/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-enduser-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>national_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="national_id"                data-endpoint="POSTapi-v1-enduser-auth-login"
               value="1234567890"
               data-component="body">
    <br>
<p>Registered national ID. The <code>national_id</code> of an existing record in the identity.end_users table. Example: <code>1234567890</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-enduser-auth-login"
               value="secret123"
               data-component="body">
    <br>
<p>Account password. Example: <code>secret123</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-enduser-auth-forgot-password-start">POST /api/v1/enduser/auth/forgot-password/start
Step 1: Accept national_id only, return a short-lived token.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-enduser-auth-forgot-password-start">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/enduser/auth/forgot-password/start" \
    --header "Content-Type: application/json" \
    --data "{
    \"national_id\": \"1234567890\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/enduser/auth/forgot-password/start"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "national_id": "1234567890"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-enduser-auth-forgot-password-start">
</span>
<span id="execution-results-POSTapi-v1-enduser-auth-forgot-password-start" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-enduser-auth-forgot-password-start"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-enduser-auth-forgot-password-start"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-enduser-auth-forgot-password-start" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-enduser-auth-forgot-password-start">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-enduser-auth-forgot-password-start" data-method="POST"
      data-path="api/v1/enduser/auth/forgot-password/start"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-enduser-auth-forgot-password-start', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-enduser-auth-forgot-password-start"
                    onclick="tryItOut('POSTapi-v1-enduser-auth-forgot-password-start');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-enduser-auth-forgot-password-start"
                    onclick="cancelTryOut('POSTapi-v1-enduser-auth-forgot-password-start');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-enduser-auth-forgot-password-start"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/enduser/auth/forgot-password/start</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-enduser-auth-forgot-password-start"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>national_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="national_id"                data-endpoint="POSTapi-v1-enduser-auth-forgot-password-start"
               value="1234567890"
               data-component="body">
    <br>
<p>National ID to locate the account. The <code>national_id</code> of an existing record in the identity.end_users table. Example: <code>1234567890</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-enduser-auth-forgot-password-verify-phone">POST /api/v1/enduser/auth/forgot-password/verify-phone
Step 2: Verify phone matches stored phone, return reset token if valid.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-enduser-auth-forgot-password-verify-phone">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/enduser/auth/forgot-password/verify-phone" \
    --header "Content-Type: application/json" \
    --data "{
    \"token\": \"fp_abcd1234\",
    \"phone\": \"+966500000001\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/enduser/auth/forgot-password/verify-phone"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "fp_abcd1234",
    "phone": "+966500000001"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-enduser-auth-forgot-password-verify-phone">
</span>
<span id="execution-results-POSTapi-v1-enduser-auth-forgot-password-verify-phone" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-enduser-auth-forgot-password-verify-phone"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-enduser-auth-forgot-password-verify-phone"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-enduser-auth-forgot-password-verify-phone" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-enduser-auth-forgot-password-verify-phone">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-enduser-auth-forgot-password-verify-phone" data-method="POST"
      data-path="api/v1/enduser/auth/forgot-password/verify-phone"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-enduser-auth-forgot-password-verify-phone', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-enduser-auth-forgot-password-verify-phone"
                    onclick="tryItOut('POSTapi-v1-enduser-auth-forgot-password-verify-phone');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-enduser-auth-forgot-password-verify-phone"
                    onclick="cancelTryOut('POSTapi-v1-enduser-auth-forgot-password-verify-phone');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-enduser-auth-forgot-password-verify-phone"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/enduser/auth/forgot-password/verify-phone</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-enduser-auth-forgot-password-verify-phone"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="POSTapi-v1-enduser-auth-forgot-password-verify-phone"
               value="fp_abcd1234"
               data-component="body">
    <br>
<p>Token received from the start step. Example: <code>fp_abcd1234</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-v1-enduser-auth-forgot-password-verify-phone"
               value="+966500000001"
               data-component="body">
    <br>
<p>Phone number associated with the account. Must not be greater than 20 characters. Example: <code>+966500000001</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-enduser-auth-reset-password">POST /api/v1/enduser/auth/reset-password
Step 3: Direct password reset using reset_token, no email/SMS.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-enduser-auth-reset-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/enduser/auth/reset-password" \
    --header "Content-Type: application/json" \
    --data "{
    \"reset_token\": \"rp_abcdef123456\",
    \"password\": \"newsecret1234\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/enduser/auth/reset-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reset_token": "rp_abcdef123456",
    "password": "newsecret1234"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-enduser-auth-reset-password">
</span>
<span id="execution-results-POSTapi-v1-enduser-auth-reset-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-enduser-auth-reset-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-enduser-auth-reset-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-enduser-auth-reset-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-enduser-auth-reset-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-enduser-auth-reset-password" data-method="POST"
      data-path="api/v1/enduser/auth/reset-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-enduser-auth-reset-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-enduser-auth-reset-password"
                    onclick="tryItOut('POSTapi-v1-enduser-auth-reset-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-enduser-auth-reset-password"
                    onclick="cancelTryOut('POSTapi-v1-enduser-auth-reset-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-enduser-auth-reset-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/enduser/auth/reset-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-enduser-auth-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reset_token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reset_token"                data-endpoint="POSTapi-v1-enduser-auth-reset-password"
               value="rp_abcdef123456"
               data-component="body">
    <br>
<p>Token received after phone verification. Example: <code>rp_abcdef123456</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-enduser-auth-reset-password"
               value="newsecret1234"
               data-component="body">
    <br>
<p>New password. Must be at least 8 characters. Example: <code>newsecret1234</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-enduser-cities">GET api/v1/enduser/cities</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-enduser-cities">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/enduser/cities"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/enduser/cities"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-enduser-cities">
    </span>
<span id="execution-results-GETapi-v1-enduser-cities" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-enduser-cities"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-enduser-cities"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-enduser-cities" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-enduser-cities">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-enduser-cities" data-method="GET"
      data-path="api/v1/enduser/cities"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-enduser-cities', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-enduser-cities"
                    onclick="tryItOut('GETapi-v1-enduser-cities');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-enduser-cities"
                    onclick="cancelTryOut('GETapi-v1-enduser-cities');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-enduser-cities"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/enduser/cities</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-GETapi-v1-enduser-currencies">GET api/v1/enduser/currencies</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-enduser-currencies">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/enduser/currencies"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/enduser/currencies"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-enduser-currencies">
    </span>
<span id="execution-results-GETapi-v1-enduser-currencies" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-enduser-currencies"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-enduser-currencies"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-enduser-currencies" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-enduser-currencies">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-enduser-currencies" data-method="GET"
      data-path="api/v1/enduser/currencies"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-enduser-currencies', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-enduser-currencies"
                    onclick="tryItOut('GETapi-v1-enduser-currencies');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-enduser-currencies"
                    onclick="cancelTryOut('GETapi-v1-enduser-currencies');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-enduser-currencies"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/enduser/currencies</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-GETapi-v1-enduser-categories">GET api/v1/enduser/categories</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-enduser-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/enduser/categories"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/enduser/categories"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-enduser-categories">
    </span>
<span id="execution-results-GETapi-v1-enduser-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-enduser-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-enduser-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-enduser-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-enduser-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-enduser-categories" data-method="GET"
      data-path="api/v1/enduser/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-enduser-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-enduser-categories"
                    onclick="tryItOut('GETapi-v1-enduser-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-enduser-categories"
                    onclick="cancelTryOut('GETapi-v1-enduser-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-enduser-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/enduser/categories</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-GETapi-v1-enduser-offices">GET api/v1/enduser/offices</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-enduser-offices">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/enduser/offices"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/enduser/offices"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-enduser-offices">
    </span>
<span id="execution-results-GETapi-v1-enduser-offices" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-enduser-offices"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-enduser-offices"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-enduser-offices" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-enduser-offices">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-enduser-offices" data-method="GET"
      data-path="api/v1/enduser/offices"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-enduser-offices', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-enduser-offices"
                    onclick="tryItOut('GETapi-v1-enduser-offices');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-enduser-offices"
                    onclick="cancelTryOut('GETapi-v1-enduser-offices');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-enduser-offices"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/enduser/offices</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-GETapi-v1-enduser-cvs">GET api/v1/enduser/cvs</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-enduser-cvs">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/enduser/cvs"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/enduser/cvs"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-enduser-cvs">
    </span>
<span id="execution-results-GETapi-v1-enduser-cvs" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-enduser-cvs"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-enduser-cvs"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-enduser-cvs" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-enduser-cvs">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-enduser-cvs" data-method="GET"
      data-path="api/v1/enduser/cvs"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-enduser-cvs', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-enduser-cvs"
                    onclick="tryItOut('GETapi-v1-enduser-cvs');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-enduser-cvs"
                    onclick="cancelTryOut('GETapi-v1-enduser-cvs');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-enduser-cvs"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/enduser/cvs</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-GETapi-v1-enduser-me">GET /api/v1/enduser/me</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-enduser-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/enduser/me"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/enduser/me"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-enduser-me">
    </span>
<span id="execution-results-GETapi-v1-enduser-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-enduser-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-enduser-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-enduser-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-enduser-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-enduser-me" data-method="GET"
      data-path="api/v1/enduser/me"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-enduser-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-enduser-me"
                    onclick="tryItOut('GETapi-v1-enduser-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-enduser-me"
                    onclick="cancelTryOut('GETapi-v1-enduser-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-enduser-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/enduser/me</code></b>
        </p>
                    </form>

                    <h2 id="endpoints-PUTapi-v1-enduser-profile">PUT /api/v1/enduser/profile</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-enduser-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/enduser/profile" \
    --header "Content-Type: multipart/form-data" \
    --form "name=Johnathan Doe"\
    --form "phone=+966511111111"\
    --form "country_id=2"\
    --form "city_id=8"\
    --form "bio=Photographer and traveler."\
    --form "avatar=@E:\xampp\htdocs\xampp\mery\resources\scribe\examples\avatar.png" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/enduser/profile"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'Johnathan Doe');
body.append('phone', '+966511111111');
body.append('country_id', '2');
body.append('city_id', '8');
body.append('bio', 'Photographer and traveler.');
body.append('avatar', document.querySelector('input[name="avatar"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-enduser-profile">
</span>
<span id="execution-results-PUTapi-v1-enduser-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-enduser-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-enduser-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-enduser-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-enduser-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-enduser-profile" data-method="PUT"
      data-path="api/v1/enduser/profile"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-enduser-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-enduser-profile"
                    onclick="tryItOut('PUTapi-v1-enduser-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-enduser-profile"
                    onclick="cancelTryOut('PUTapi-v1-enduser-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-enduser-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/enduser/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-enduser-profile"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-enduser-profile"
               value="Johnathan Doe"
               data-component="body">
    <br>
<p>Updated full name. Must not be greater than 191 characters. Example: <code>Johnathan Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-v1-enduser-profile"
               value="+966511111111"
               data-component="body">
    <br>
<p>Updated phone number. Must not be greater than 32 characters. Example: <code>+966511111111</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="country_id"                data-endpoint="PUTapi-v1-enduser-profile"
               value="2"
               data-component="body">
    <br>
<p>Updated nationality identifier. The <code>id</code> of an existing record in the system.nationalities table. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="city_id"                data-endpoint="PUTapi-v1-enduser-profile"
               value="8"
               data-component="body">
    <br>
<p>Updated city identifier. The <code>id</code> of an existing record in the system.cities table. Example: <code>8</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bio</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="bio"                data-endpoint="PUTapi-v1-enduser-profile"
               value="Photographer and traveler."
               data-component="body">
    <br>
<p>Updated bio text. Example: <code>Photographer and traveler.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>avatar</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="avatar"                data-endpoint="PUTapi-v1-enduser-profile"
               value=""
               data-component="body">
    <br>
<p>New profile photo. Must be an image. Must not be greater than 2048 kilobytes. Example: <code>resources/scribe/examples/avatar.png</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-enduser-auth-logout">POST /api/v1/enduser/auth/logout</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-enduser-auth-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/enduser/auth/logout"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/enduser/auth/logout"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-enduser-auth-logout">
</span>
<span id="execution-results-POSTapi-v1-enduser-auth-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-enduser-auth-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-enduser-auth-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-enduser-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-enduser-auth-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-enduser-auth-logout" data-method="POST"
      data-path="api/v1/enduser/auth/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-enduser-auth-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-enduser-auth-logout"
                    onclick="tryItOut('POSTapi-v1-enduser-auth-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-enduser-auth-logout"
                    onclick="cancelTryOut('POSTapi-v1-enduser-auth-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-enduser-auth-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/enduser/auth/logout</code></b>
        </p>
                    </form>

                <h1 id="notifications">Notifications</h1>

    <p>Endpoints for listing and marking in-app notifications as read.</p>

                                <h2 id="notifications-GETapi-v1-admin-system-notifications">List notifications</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Paginated list of in-app notifications for the current principal (system user or office).</p>

<span id="example-requests-GETapi-v1-admin-system-notifications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/notifications?page=1" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/notifications"
);

const params = {
    "page": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-notifications">
    </span>
<span id="execution-results-GETapi-v1-admin-system-notifications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-notifications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-notifications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-notifications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-notifications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-notifications" data-method="GET"
      data-path="api/v1/admin/system/notifications"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-notifications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-notifications"
                    onclick="tryItOut('GETapi-v1-admin-system-notifications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-notifications"
                    onclick="cancelTryOut('GETapi-v1-admin-system-notifications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-notifications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/notifications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-system-notifications"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-v1-admin-system-notifications"
               value="1"
               data-component="query">
    <br>
<p>The page number. Example: <code>1</code></p>
            </div>
                </form>

                    <h2 id="notifications-POSTapi-v1-admin-system-notifications--id--read">Mark a notification as read</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-notifications--id--read">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/notifications/123/read" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/notifications/123/read"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-notifications--id--read">
</span>
<span id="execution-results-POSTapi-v1-admin-system-notifications--id--read" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-notifications--id--read"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-notifications--id--read"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-notifications--id--read" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-notifications--id--read">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-notifications--id--read" data-method="POST"
      data-path="api/v1/admin/system/notifications/{id}/read"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-notifications--id--read', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-notifications--id--read"
                    onclick="tryItOut('POSTapi-v1-admin-system-notifications--id--read');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-notifications--id--read"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-notifications--id--read');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-notifications--id--read"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/notifications/{id}/read</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-notifications--id--read"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-admin-system-notifications--id--read"
               value="123"
               data-component="url">
    <br>
<p>The notification recipient ID. Example: <code>123</code></p>
            </div>
                    </form>

                    <h2 id="notifications-POSTapi-v1-admin-system-notifications-read-all">Mark all as read</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-notifications-read-all">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/notifications/read-all" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/notifications/read-all"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-notifications-read-all">
</span>
<span id="execution-results-POSTapi-v1-admin-system-notifications-read-all" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-notifications-read-all"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-notifications-read-all"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-notifications-read-all" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-notifications-read-all">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-notifications-read-all" data-method="POST"
      data-path="api/v1/admin/system/notifications/read-all"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-notifications-read-all', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-notifications-read-all"
                    onclick="tryItOut('POSTapi-v1-admin-system-notifications-read-all');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-notifications-read-all"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-notifications-read-all');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-notifications-read-all"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/notifications/read-all</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-notifications-read-all"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                        </form>

                    <h2 id="notifications-POSTapi-v1-admin-system-notifications-broadcast">Broadcast a notification</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create and send a notification to admins or a list of office IDs.</p>

<span id="example-requests-POSTapi-v1-admin-system-notifications-broadcast">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/notifications/broadcast" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"title\": \"System update tonight\",
    \"body\": \"We will update the system at 1 AM UTC.\",
    \"target\": \"admins\",
    \"office_ids\": [
        1,
        2,
        3
    ],
    \"channels\": [
        \"inapp\",
        \"email\"
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/notifications/broadcast"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "System update tonight",
    "body": "We will update the system at 1 AM UTC.",
    "target": "admins",
    "office_ids": [
        1,
        2,
        3
    ],
    "channels": [
        "inapp",
        "email"
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-notifications-broadcast">
</span>
<span id="execution-results-POSTapi-v1-admin-system-notifications-broadcast" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-notifications-broadcast"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-notifications-broadcast"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-notifications-broadcast" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-notifications-broadcast">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-notifications-broadcast" data-method="POST"
      data-path="api/v1/admin/system/notifications/broadcast"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-notifications-broadcast', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-notifications-broadcast"
                    onclick="tryItOut('POSTapi-v1-admin-system-notifications-broadcast');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-notifications-broadcast"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-notifications-broadcast');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-notifications-broadcast"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/notifications/broadcast</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-notifications-broadcast"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-notifications-broadcast"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-v1-admin-system-notifications-broadcast"
               value="System update tonight"
               data-component="body">
    <br>
<p>The notification title. Example: <code>System update tonight</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>body</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="body"                data-endpoint="POSTapi-v1-admin-system-notifications-broadcast"
               value="We will update the system at 1 AM UTC."
               data-component="body">
    <br>
<p>The body text. Example: <code>We will update the system at 1 AM UTC.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>target</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="target"                data-endpoint="POSTapi-v1-admin-system-notifications-broadcast"
               value="admins"
               data-component="body">
    <br>
<p>Target audience. One of: admins, offices. Example: <code>admins</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>office_ids</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="office_ids[0]"                data-endpoint="POSTapi-v1-admin-system-notifications-broadcast"
               data-component="body">
        <input type="text" style="display: none"
               name="office_ids[1]"                data-endpoint="POSTapi-v1-admin-system-notifications-broadcast"
               data-component="body">
    <br>
<p>Office IDs when target=offices.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>channels</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="channels[0]"                data-endpoint="POSTapi-v1-admin-system-notifications-broadcast"
               data-component="body">
        <input type="text" style="display: none"
               name="channels[1]"                data-endpoint="POSTapi-v1-admin-system-notifications-broadcast"
               data-component="body">
    <br>
<p>Channels to send on.</p>
        </div>
        </form>

                    <h2 id="notifications-GETapi-v1-office-notifications">List notifications</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Paginated list of in-app notifications for the current principal (system user or office).</p>

<span id="example-requests-GETapi-v1-office-notifications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/office/notifications?page=1" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/notifications"
);

const params = {
    "page": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-office-notifications">
    </span>
<span id="execution-results-GETapi-v1-office-notifications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-office-notifications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-office-notifications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-office-notifications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-office-notifications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-office-notifications" data-method="GET"
      data-path="api/v1/office/notifications"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-office-notifications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-office-notifications"
                    onclick="tryItOut('GETapi-v1-office-notifications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-office-notifications"
                    onclick="cancelTryOut('GETapi-v1-office-notifications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-office-notifications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/office/notifications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-office-notifications"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-v1-office-notifications"
               value="1"
               data-component="query">
    <br>
<p>The page number. Example: <code>1</code></p>
            </div>
                </form>

                    <h2 id="notifications-POSTapi-v1-office-notifications--id--read">Mark a notification as read</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-office-notifications--id--read">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/office/notifications/123/read" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/notifications/123/read"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-office-notifications--id--read">
</span>
<span id="execution-results-POSTapi-v1-office-notifications--id--read" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-office-notifications--id--read"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-office-notifications--id--read"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-office-notifications--id--read" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-office-notifications--id--read">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-office-notifications--id--read" data-method="POST"
      data-path="api/v1/office/notifications/{id}/read"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-office-notifications--id--read', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-office-notifications--id--read"
                    onclick="tryItOut('POSTapi-v1-office-notifications--id--read');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-office-notifications--id--read"
                    onclick="cancelTryOut('POSTapi-v1-office-notifications--id--read');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-office-notifications--id--read"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/office/notifications/{id}/read</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-office-notifications--id--read"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-office-notifications--id--read"
               value="123"
               data-component="url">
    <br>
<p>The notification recipient ID. Example: <code>123</code></p>
            </div>
                    </form>

                    <h2 id="notifications-POSTapi-v1-office-notifications-read-all">Mark all as read</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-office-notifications-read-all">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/office/notifications/read-all" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/notifications/read-all"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-office-notifications-read-all">
</span>
<span id="execution-results-POSTapi-v1-office-notifications-read-all" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-office-notifications-read-all"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-office-notifications-read-all"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-office-notifications-read-all" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-office-notifications-read-all">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-office-notifications-read-all" data-method="POST"
      data-path="api/v1/office/notifications/read-all"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-office-notifications-read-all', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-office-notifications-read-all"
                    onclick="tryItOut('POSTapi-v1-office-notifications-read-all');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-office-notifications-read-all"
                    onclick="cancelTryOut('POSTapi-v1-office-notifications-read-all');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-office-notifications-read-all"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/office/notifications/read-all</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-office-notifications-read-all"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                        </form>

                <h1 id="office-cvs">Office / CVs</h1>

    

                                <h2 id="office-cvs-GETapi-v1-office-cvs">GET /api/v1/office/cvs - List my CVs</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-office-cvs">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/office/cvs"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/cvs"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-office-cvs">
    </span>
<span id="execution-results-GETapi-v1-office-cvs" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-office-cvs"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-office-cvs"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-office-cvs" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-office-cvs">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-office-cvs" data-method="GET"
      data-path="api/v1/office/cvs"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-office-cvs', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-office-cvs"
                    onclick="tryItOut('GETapi-v1-office-cvs');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-office-cvs"
                    onclick="cancelTryOut('GETapi-v1-office-cvs');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-office-cvs"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/office/cvs</code></b>
        </p>
                    </form>

                    <h2 id="office-cvs-POSTapi-v1-office-cvs">POST /api/v1/office/cvs</h2>

<p>
</p>

<p>يدعم:</p>
<ul>
<li>
<p>Single:
fields: category_id, nationality_code, gender, has_experience, is_muslim, file, meta</p>
</li>
<li>
<p>Bulk:
cvs[]: نفس الحقول لكل عنصر</p>
</li>
</ul>

<span id="example-requests-POSTapi-v1-office-cvs">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/office/cvs" \
    --header "Content-Type: multipart/form-data" \
    --form "category_id=1"\
    --form "nationality_code=PH"\
    --form "gender=female"\
    --form "has_experience="\
    --form "is_muslim="\
    --form "meta[age]=28"\
    --form "meta[notes]=live-in"\
    --form "file=@E:\xampp\htdocs\xampp\mery\resources\scribe\examples\cv-sample.pdf" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/cvs"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('category_id', '1');
body.append('nationality_code', 'PH');
body.append('gender', 'female');
body.append('has_experience', '');
body.append('is_muslim', '');
body.append('meta[age]', '28');
body.append('meta[notes]', 'live-in');
body.append('file', document.querySelector('input[name="file"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-office-cvs">
</span>
<span id="execution-results-POSTapi-v1-office-cvs" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-office-cvs"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-office-cvs"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-office-cvs" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-office-cvs">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-office-cvs" data-method="POST"
      data-path="api/v1/office/cvs"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-office-cvs', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-office-cvs"
                    onclick="tryItOut('POSTapi-v1-office-cvs');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-office-cvs"
                    onclick="cancelTryOut('POSTapi-v1-office-cvs');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-office-cvs"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/office/cvs</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-office-cvs"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="POSTapi-v1-office-cvs"
               value="1"
               data-component="body">
    <br>
<p>Optional category id. The <code>id</code> of an existing record in the system.categories table. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nationality_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nationality_code"                data-endpoint="POSTapi-v1-office-cvs"
               value="PH"
               data-component="body">
    <br>
<p>Nationality code (ISO-2 or your custom code). Must not be greater than 8 characters. Example: <code>PH</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="POSTapi-v1-office-cvs"
               value="female"
               data-component="body">
    <br>
<p>Optional gender (male|female). Example: <code>female</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>male</code></li> <li><code>female</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>has_experience</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-office-cvs" style="display: none">
            <input type="radio" name="has_experience"
                   value="true"
                   data-endpoint="POSTapi-v1-office-cvs"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-office-cvs" style="display: none">
            <input type="radio" name="has_experience"
                   value="false"
                   data-endpoint="POSTapi-v1-office-cvs"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Has previous experience? true/false. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_muslim</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-office-cvs" style="display: none">
            <input type="radio" name="is_muslim"
                   value="true"
                   data-endpoint="POSTapi-v1-office-cvs"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-office-cvs" style="display: none">
            <input type="radio" name="is_muslim"
                   value="false"
                   data-endpoint="POSTapi-v1-office-cvs"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Is Muslim? true/false. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>file</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="file"                data-endpoint="POSTapi-v1-office-cvs"
               value=""
               data-component="body">
    <br>
<p>Required PDF CV file. Must be a file. Must not be greater than 10240 kilobytes. Example: <code>resources/scribe/examples/cv-sample.pdf</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta"                data-endpoint="POSTapi-v1-office-cvs"
               value=""
               data-component="body">
    <br>
<p>Optional JSON metadata.</p>
        </div>
        </form>

                    <h2 id="office-cvs-PUTapi-v1-office-cvs--id-">PUT/PATCH /api/v1/office/cvs/{id} - Update CV</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-office-cvs--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/office/cvs/consequatur" \
    --header "Content-Type: multipart/form-data" \
    --form "category_id=2"\
    --form "nationality_code=NP"\
    --form "gender=male"\
    --form "has_experience="\
    --form "is_muslim="\
    --form "meta[languages][]=ar"\
    --form "file=@E:\xampp\htdocs\xampp\mery\resources\scribe\examples\cv-sample.pdf" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/cvs/consequatur"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('category_id', '2');
body.append('nationality_code', 'NP');
body.append('gender', 'male');
body.append('has_experience', '');
body.append('is_muslim', '');
body.append('meta[languages][]', 'ar');
body.append('file', document.querySelector('input[name="file"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-office-cvs--id-">
</span>
<span id="execution-results-PUTapi-v1-office-cvs--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-office-cvs--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-office-cvs--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-office-cvs--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-office-cvs--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-office-cvs--id-" data-method="PUT"
      data-path="api/v1/office/cvs/{id}"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-office-cvs--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-office-cvs--id-"
                    onclick="tryItOut('PUTapi-v1-office-cvs--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-office-cvs--id-"
                    onclick="cancelTryOut('PUTapi-v1-office-cvs--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-office-cvs--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/office/cvs/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-office-cvs--id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-v1-office-cvs--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the cv. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="PUTapi-v1-office-cvs--id-"
               value="2"
               data-component="body">
    <br>
<p>Optional category id. The <code>id</code> of an existing record in the system.categories table. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nationality_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="nationality_code"                data-endpoint="PUTapi-v1-office-cvs--id-"
               value="NP"
               data-component="body">
    <br>
<p>Nationality code. Must not be greater than 8 characters. Example: <code>NP</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="PUTapi-v1-office-cvs--id-"
               value="male"
               data-component="body">
    <br>
<p>Optional gender (male|female). Example: <code>male</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>male</code></li> <li><code>female</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>has_experience</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-office-cvs--id-" style="display: none">
            <input type="radio" name="has_experience"
                   value="true"
                   data-endpoint="PUTapi-v1-office-cvs--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-office-cvs--id-" style="display: none">
            <input type="radio" name="has_experience"
                   value="false"
                   data-endpoint="PUTapi-v1-office-cvs--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Has experience?. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_muslim</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-office-cvs--id-" style="display: none">
            <input type="radio" name="is_muslim"
                   value="true"
                   data-endpoint="PUTapi-v1-office-cvs--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-office-cvs--id-" style="display: none">
            <input type="radio" name="is_muslim"
                   value="false"
                   data-endpoint="PUTapi-v1-office-cvs--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Is Muslim? true/false. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>file</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="file"                data-endpoint="PUTapi-v1-office-cvs--id-"
               value=""
               data-component="body">
    <br>
<p>PDF CV file (replace existing). Must be a file. Must not be greater than 10240 kilobytes. Example: <code>resources/scribe/examples/cv-sample.pdf</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta"                data-endpoint="PUTapi-v1-office-cvs--id-"
               value=""
               data-component="body">
    <br>
<p>Optional JSON metadata.</p>
        </div>
        </form>

                    <h2 id="office-cvs-POSTapi-v1-office-cvs--id--toggle">POST /api/v1/office/cvs/{id}/toggle-active</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-office-cvs--id--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/office/cvs/consequatur/toggle" \
    --header "Content-Type: application/json" \
    --data "{
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/cvs/consequatur/toggle"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-office-cvs--id--toggle">
</span>
<span id="execution-results-POSTapi-v1-office-cvs--id--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-office-cvs--id--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-office-cvs--id--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-office-cvs--id--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-office-cvs--id--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-office-cvs--id--toggle" data-method="POST"
      data-path="api/v1/office/cvs/{id}/toggle"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-office-cvs--id--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-office-cvs--id--toggle"
                    onclick="tryItOut('POSTapi-v1-office-cvs--id--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-office-cvs--id--toggle"
                    onclick="cancelTryOut('POSTapi-v1-office-cvs--id--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-office-cvs--id--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/office/cvs/{id}/toggle</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-office-cvs--id--toggle"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-v1-office-cvs--id--toggle"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the cv. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-office-cvs--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-office-cvs--id--toggle"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-office-cvs--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-office-cvs--id--toggle"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="office-cvs-POSTapi-v1-office-cvs--id--resubmit">POST /api/v1/office/cvs/{id}/resubmit</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-office-cvs--id--resubmit">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/office/cvs/consequatur/resubmit"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/cvs/consequatur/resubmit"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-office-cvs--id--resubmit">
</span>
<span id="execution-results-POSTapi-v1-office-cvs--id--resubmit" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-office-cvs--id--resubmit"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-office-cvs--id--resubmit"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-office-cvs--id--resubmit" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-office-cvs--id--resubmit">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-office-cvs--id--resubmit" data-method="POST"
      data-path="api/v1/office/cvs/{id}/resubmit"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-office-cvs--id--resubmit', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-office-cvs--id--resubmit"
                    onclick="tryItOut('POSTapi-v1-office-cvs--id--resubmit');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-office-cvs--id--resubmit"
                    onclick="cancelTryOut('POSTapi-v1-office-cvs--id--resubmit');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-office-cvs--id--resubmit"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/office/cvs/{id}/resubmit</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-v1-office-cvs--id--resubmit"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the cv. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="office-cvs-DELETEapi-v1-office-cvs--id-">DELETE /api/v1/office/cvs/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-office-cvs--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/office/cvs/consequatur"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/office/cvs/consequatur"
);

fetch(url, {
    method: "DELETE",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-office-cvs--id-">
</span>
<span id="execution-results-DELETEapi-v1-office-cvs--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-office-cvs--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-office-cvs--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-office-cvs--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-office-cvs--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-office-cvs--id-" data-method="DELETE"
      data-path="api/v1/office/cvs/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-office-cvs--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-office-cvs--id-"
                    onclick="tryItOut('DELETEapi-v1-office-cvs--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-office-cvs--id-"
                    onclick="cancelTryOut('DELETEapi-v1-office-cvs--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-office-cvs--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/office/cvs/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-office-cvs--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the cv. Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="system-audit-logs">System / Audit Logs</h1>

    

                                <h2 id="system-audit-logs-GETapi-v1-admin-system-audit-logs">List audit logs (read-only).</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-audit-logs">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/audit-logs?user_id=17&amp;action=consequatur&amp;model=consequatur&amp;from=consequatur&amp;to=consequatur"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/audit-logs"
);

const params = {
    "user_id": "17",
    "action": "consequatur",
    "model": "consequatur",
    "from": "consequatur",
    "to": "consequatur",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-audit-logs">
    </span>
<span id="execution-results-GETapi-v1-admin-system-audit-logs" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-audit-logs"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-audit-logs"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-audit-logs" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-audit-logs">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-audit-logs" data-method="GET"
      data-path="api/v1/admin/system/audit-logs"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-audit-logs', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-audit-logs"
                    onclick="tryItOut('GETapi-v1-admin-system-audit-logs');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-audit-logs"
                    onclick="cancelTryOut('GETapi-v1-admin-system-audit-logs');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-audit-logs"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/audit-logs</code></b>
        </p>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="GETapi-v1-admin-system-audit-logs"
               value="17"
               data-component="query">
    <br>
<p>Example: <code>17</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>action</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="action"                data-endpoint="GETapi-v1-admin-system-audit-logs"
               value="consequatur"
               data-component="query">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>model</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="model"                data-endpoint="GETapi-v1-admin-system-audit-logs"
               value="consequatur"
               data-component="query">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="from"                data-endpoint="GETapi-v1-admin-system-audit-logs"
               value="consequatur"
               data-component="query">
    <br>
<p>date Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="to"                data-endpoint="GETapi-v1-admin-system-audit-logs"
               value="consequatur"
               data-component="query">
    <br>
<p>date Example: <code>consequatur</code></p>
            </div>
                </form>

                <h1 id="system-cvs">System / CVs</h1>

    

                                <h2 id="system-cvs-GETapi-v1-admin-system-cvs">List CVs (filters supported)</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-cvs">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/cvs?id=17&amp;name=consequatur&amp;office_id=17&amp;category_id=17&amp;nationality=consequatur&amp;gender=consequatur&amp;has_experience=&amp;is_muslim=&amp;status=consequatur&amp;from=consequatur&amp;to=consequatur&amp;per_page=17"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/cvs"
);

const params = {
    "id": "17",
    "name": "consequatur",
    "office_id": "17",
    "category_id": "17",
    "nationality": "consequatur",
    "gender": "consequatur",
    "has_experience": "0",
    "is_muslim": "0",
    "status": "consequatur",
    "from": "consequatur",
    "to": "consequatur",
    "per_page": "17",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-cvs">
    </span>
<span id="execution-results-GETapi-v1-admin-system-cvs" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-cvs"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-cvs"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-cvs" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-cvs">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-cvs" data-method="GET"
      data-path="api/v1/admin/system/cvs"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-cvs', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-cvs"
                    onclick="tryItOut('GETapi-v1-admin-system-cvs');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-cvs"
                    onclick="cancelTryOut('GETapi-v1-admin-system-cvs');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-cvs"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/cvs</code></b>
        </p>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-admin-system-cvs"
               value="17"
               data-component="query">
    <br>
<p>Example: <code>17</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="GETapi-v1-admin-system-cvs"
               value="consequatur"
               data-component="query">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>office_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="office_id"                data-endpoint="GETapi-v1-admin-system-cvs"
               value="17"
               data-component="query">
    <br>
<p>Example: <code>17</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="GETapi-v1-admin-system-cvs"
               value="17"
               data-component="query">
    <br>
<p>Example: <code>17</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>nationality</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="nationality"                data-endpoint="GETapi-v1-admin-system-cvs"
               value="consequatur"
               data-component="query">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="GETapi-v1-admin-system-cvs"
               value="consequatur"
               data-component="query">
    <br>
<p>male|female Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>has_experience</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="GETapi-v1-admin-system-cvs" style="display: none">
            <input type="radio" name="has_experience"
                   value="1"
                   data-endpoint="GETapi-v1-admin-system-cvs"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-admin-system-cvs" style="display: none">
            <input type="radio" name="has_experience"
                   value="0"
                   data-endpoint="GETapi-v1-admin-system-cvs"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>is_muslim</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="GETapi-v1-admin-system-cvs" style="display: none">
            <input type="radio" name="is_muslim"
                   value="1"
                   data-endpoint="GETapi-v1-admin-system-cvs"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-admin-system-cvs" style="display: none">
            <input type="radio" name="is_muslim"
                   value="0"
                   data-endpoint="GETapi-v1-admin-system-cvs"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-v1-admin-system-cvs"
               value="consequatur"
               data-component="query">
    <br>
<p>pending|approved|rejected|frozen|deactivated_by_office Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="from"                data-endpoint="GETapi-v1-admin-system-cvs"
               value="consequatur"
               data-component="query">
    <br>
<p>date Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="to"                data-endpoint="GETapi-v1-admin-system-cvs"
               value="consequatur"
               data-component="query">
    <br>
<p>date Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-admin-system-cvs"
               value="17"
               data-component="query">
    <br>
<p>Example: <code>17</code></p>
            </div>
                </form>

                    <h2 id="system-cvs-GETapi-v1-admin-system-cvs-stats">Stats</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-cvs-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/cvs-stats"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/cvs-stats"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-cvs-stats">
    </span>
<span id="execution-results-GETapi-v1-admin-system-cvs-stats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-cvs-stats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-cvs-stats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-cvs-stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-cvs-stats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-cvs-stats" data-method="GET"
      data-path="api/v1/admin/system/cvs-stats"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-cvs-stats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-cvs-stats"
                    onclick="tryItOut('GETapi-v1-admin-system-cvs-stats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-cvs-stats"
                    onclick="cancelTryOut('GETapi-v1-admin-system-cvs-stats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-cvs-stats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/cvs-stats</code></b>
        </p>
                    </form>

                    <h2 id="system-cvs-POSTapi-v1-admin-system-cvs--id--approve">Approve CV</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-cvs--id--approve">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/cvs/consequatur/approve"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/cvs/consequatur/approve"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-cvs--id--approve">
</span>
<span id="execution-results-POSTapi-v1-admin-system-cvs--id--approve" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-cvs--id--approve"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-cvs--id--approve"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-cvs--id--approve" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-cvs--id--approve">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-cvs--id--approve" data-method="POST"
      data-path="api/v1/admin/system/cvs/{id}/approve"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-cvs--id--approve', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-cvs--id--approve"
                    onclick="tryItOut('POSTapi-v1-admin-system-cvs--id--approve');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-cvs--id--approve"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-cvs--id--approve');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-cvs--id--approve"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/cvs/{id}/approve</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-v1-admin-system-cvs--id--approve"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the cv. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="system-cvs-POSTapi-v1-admin-system-cvs--id--reject">Reject CV (reason required)</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-cvs--id--reject">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/cvs/consequatur/reject"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/cvs/consequatur/reject"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-cvs--id--reject">
</span>
<span id="execution-results-POSTapi-v1-admin-system-cvs--id--reject" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-cvs--id--reject"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-cvs--id--reject"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-cvs--id--reject" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-cvs--id--reject">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-cvs--id--reject" data-method="POST"
      data-path="api/v1/admin/system/cvs/{id}/reject"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-cvs--id--reject', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-cvs--id--reject"
                    onclick="tryItOut('POSTapi-v1-admin-system-cvs--id--reject');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-cvs--id--reject"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-cvs--id--reject');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-cvs--id--reject"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/cvs/{id}/reject</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-v1-admin-system-cvs--id--reject"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the cv. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="system-cvs-POSTapi-v1-admin-system-cvs--id--freeze">Freeze CV</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-cvs--id--freeze">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/cvs/consequatur/freeze"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/cvs/consequatur/freeze"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-cvs--id--freeze">
</span>
<span id="execution-results-POSTapi-v1-admin-system-cvs--id--freeze" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-cvs--id--freeze"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-cvs--id--freeze"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-cvs--id--freeze" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-cvs--id--freeze">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-cvs--id--freeze" data-method="POST"
      data-path="api/v1/admin/system/cvs/{id}/freeze"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-cvs--id--freeze', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-cvs--id--freeze"
                    onclick="tryItOut('POSTapi-v1-admin-system-cvs--id--freeze');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-cvs--id--freeze"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-cvs--id--freeze');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-cvs--id--freeze"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/cvs/{id}/freeze</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-v1-admin-system-cvs--id--freeze"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the cv. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="system-cvs-POSTapi-v1-admin-system-cvs--id--unfreeze">Unfreeze CV (back to pending)</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-cvs--id--unfreeze">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/cvs/consequatur/unfreeze"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/cvs/consequatur/unfreeze"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-cvs--id--unfreeze">
</span>
<span id="execution-results-POSTapi-v1-admin-system-cvs--id--unfreeze" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-cvs--id--unfreeze"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-cvs--id--unfreeze"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-cvs--id--unfreeze" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-cvs--id--unfreeze">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-cvs--id--unfreeze" data-method="POST"
      data-path="api/v1/admin/system/cvs/{id}/unfreeze"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-cvs--id--unfreeze', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-cvs--id--unfreeze"
                    onclick="tryItOut('POSTapi-v1-admin-system-cvs--id--unfreeze');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-cvs--id--unfreeze"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-cvs--id--unfreeze');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-cvs--id--unfreeze"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/cvs/{id}/unfreeze</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-v1-admin-system-cvs--id--unfreeze"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the cv. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="system-cvs-DELETEapi-v1-admin-system-cvs--id-">Delete CV</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-cvs--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/cvs/consequatur"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/cvs/consequatur"
);

fetch(url, {
    method: "DELETE",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-cvs--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-system-cvs--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-cvs--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-cvs--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-cvs--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-cvs--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-cvs--id-" data-method="DELETE"
      data-path="api/v1/admin/system/cvs/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-cvs--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-cvs--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-cvs--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-cvs--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-cvs--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-cvs--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/cvs/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-admin-system-cvs--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the cv. Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="system-categories">System / Categories</h1>

    

                                <h2 id="system-categories-GETapi-v1-admin-system-categories">List categories</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-system-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/categories?q=clean&amp;active=1&amp;parent_id=5&amp;from=consequatur&amp;to=consequatur&amp;per_page=15" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/categories"
);

const params = {
    "q": "clean",
    "active": "1",
    "parent_id": "5",
    "from": "consequatur",
    "to": "consequatur",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-categories">
    </span>
<span id="execution-results-GETapi-v1-admin-system-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-categories" data-method="GET"
      data-path="api/v1/admin/system/categories"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-categories"
                    onclick="tryItOut('GETapi-v1-admin-system-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-categories"
                    onclick="cancelTryOut('GETapi-v1-admin-system-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-system-categories"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>q</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="q"                data-endpoint="GETapi-v1-admin-system-categories"
               value="clean"
               data-component="query">
    <br>
<p>Search slug/name. Example: <code>clean</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="GETapi-v1-admin-system-categories" style="display: none">
            <input type="radio" name="active"
                   value="1"
                   data-endpoint="GETapi-v1-admin-system-categories"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-admin-system-categories" style="display: none">
            <input type="radio" name="active"
                   value="0"
                   data-endpoint="GETapi-v1-admin-system-categories"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parent_id"                data-endpoint="GETapi-v1-admin-system-categories"
               value="5"
               data-component="query">
    <br>
<p>Example: <code>5</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="from"                data-endpoint="GETapi-v1-admin-system-categories"
               value="consequatur"
               data-component="query">
    <br>
<p>date Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="to"                data-endpoint="GETapi-v1-admin-system-categories"
               value="consequatur"
               data-component="query">
    <br>
<p>date Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-admin-system-categories"
               value="15"
               data-component="query">
    <br>
<p>Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="system-categories-POSTapi-v1-admin-system-categories">Create category</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/categories" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"parent_id\": 1,
    \"slug\": \"home-cleaning\",
    \"name\": \"Home Cleaning\",
    \"active\": true,
    \"translations\": [
        {
            \"lang_code\": \"ar\",
            \"name\": \"تنظيف منزلي\"
        }
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/categories"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "parent_id": 1,
    "slug": "home-cleaning",
    "name": "Home Cleaning",
    "active": true,
    "translations": [
        {
            "lang_code": "ar",
            "name": "تنظيف منزلي"
        }
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-categories">
</span>
<span id="execution-results-POSTapi-v1-admin-system-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-categories" data-method="POST"
      data-path="api/v1/admin/system/categories"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-categories"
                    onclick="tryItOut('POSTapi-v1-admin-system-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-categories"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-categories"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parent_id"                data-endpoint="POSTapi-v1-admin-system-categories"
               value="1"
               data-component="body">
    <br>
<p>nullable Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="POSTapi-v1-admin-system-categories"
               value="home-cleaning"
               data-component="body">
    <br>
<p>nullable Example: <code>home-cleaning</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-categories"
               value="Home Cleaning"
               data-component="body">
    <br>
<p>Example: <code>Home Cleaning</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-categories" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-categories"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-categories" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-categories"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta"                data-endpoint="POSTapi-v1-admin-system-categories"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>translations</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>lang_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="translations.0.lang_code"                data-endpoint="POSTapi-v1-admin-system-categories"
               value="vmqeopfuud"
               data-component="body">
    <br>
<p>This field is required when <code>translations</code> is present. Must not be greater than 12 characters. Example: <code>vmqeopfuud</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="translations.0.name"                data-endpoint="POSTapi-v1-admin-system-categories"
               value="tdsufvyvddqamniihfqco"
               data-component="body">
    <br>
<p>This field is required when <code>translations</code> is present. Must not be greater than 191 characters. Example: <code>tdsufvyvddqamniihfqco</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="system-categories-PUTapi-v1-admin-system-categories--id-">Update category</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-system-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/categories/17" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"parent_id\": 1,
    \"slug\": \"deep-cleaning\",
    \"name\": \"Deep Cleaning\",
    \"active\": false,
    \"translations\": [
        {
            \"lang_code\": \"ar\",
            \"name\": \"تنظيف عميق\"
        }
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/categories/17"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "parent_id": 1,
    "slug": "deep-cleaning",
    "name": "Deep Cleaning",
    "active": false,
    "translations": [
        {
            "lang_code": "ar",
            "name": "تنظيف عميق"
        }
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-categories--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-system-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-categories--id-" data-method="PUT"
      data-path="api/v1/admin/system/categories/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-categories--id-"
                    onclick="tryItOut('PUTapi-v1-admin-system-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-categories--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-system-categories--id-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-system-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-admin-system-categories--id-"
               value="17"
               data-component="url">
    <br>
<p>Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parent_id"                data-endpoint="PUTapi-v1-admin-system-categories--id-"
               value="1"
               data-component="body">
    <br>
<p>Parent category ID. The <code>id</code> of an existing record in the system.categories table. Must not be one of <code>0</code>. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="PUTapi-v1-admin-system-categories--id-"
               value="deep-cleaning"
               data-component="body">
    <br>
<p>Unique slug. Must not be greater than 191 characters. Example: <code>deep-cleaning</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-admin-system-categories--id-"
               value="Deep Cleaning"
               data-component="body">
    <br>
<p>Default name. Must not be greater than 191 characters. Example: <code>Deep Cleaning</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-categories--id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-categories--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-categories--id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-categories--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active flag. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta"                data-endpoint="PUTapi-v1-admin-system-categories--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>translations</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
<br>
<p>Replace/upsert translations.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>lang_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="translations.0.lang_code"                data-endpoint="PUTapi-v1-admin-system-categories--id-"
               value="vmqeopfuud"
               data-component="body">
    <br>
<p>This field is required when <code>translations</code> is present. Must not be greater than 12 characters. Example: <code>vmqeopfuud</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="translations.0.name"                data-endpoint="PUTapi-v1-admin-system-categories--id-"
               value="tdsufvyvddqamniihfqco"
               data-component="body">
    <br>
<p>This field is required when <code>translations</code> is present. Must not be greater than 191 characters. Example: <code>tdsufvyvddqamniihfqco</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="system-categories-DELETEapi-v1-admin-system-categories--id-">Delete category (soft)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/categories/17" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/categories/17"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-categories--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-system-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-categories--id-" data-method="DELETE"
      data-path="api/v1/admin/system/categories/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-categories--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-categories--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-system-categories--id-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-admin-system-categories--id-"
               value="17"
               data-component="url">
    <br>
<p>Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="system-categories-POSTapi-v1-admin-system-categories--id--toggle">Toggle active</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-categories--id--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/categories/17/toggle" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/categories/17/toggle"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-categories--id--toggle">
</span>
<span id="execution-results-POSTapi-v1-admin-system-categories--id--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-categories--id--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-categories--id--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-categories--id--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-categories--id--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-categories--id--toggle" data-method="POST"
      data-path="api/v1/admin/system/categories/{id}/toggle"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-categories--id--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-categories--id--toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-categories--id--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-categories--id--toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-categories--id--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-categories--id--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/categories/{id}/toggle</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-categories--id--toggle"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-categories--id--toggle"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-admin-system-categories--id--toggle"
               value="17"
               data-component="url">
    <br>
<p>Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-categories--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-categories--id--toggle"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-categories--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-categories--id--toggle"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="system-categories-POSTapi-v1-admin-system-categories--id--translations">Upsert translation</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-categories--id--translations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/categories/17/translations" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"lang_code\": \"ar\",
    \"name\": \"تنظيف\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/categories/17/translations"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "lang_code": "ar",
    "name": "تنظيف"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-categories--id--translations">
</span>
<span id="execution-results-POSTapi-v1-admin-system-categories--id--translations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-categories--id--translations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-categories--id--translations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-categories--id--translations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-categories--id--translations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-categories--id--translations" data-method="POST"
      data-path="api/v1/admin/system/categories/{id}/translations"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-categories--id--translations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-categories--id--translations"
                    onclick="tryItOut('POSTapi-v1-admin-system-categories--id--translations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-categories--id--translations"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-categories--id--translations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-categories--id--translations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/categories/{id}/translations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-categories--id--translations"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-categories--id--translations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-admin-system-categories--id--translations"
               value="17"
               data-component="url">
    <br>
<p>Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lang_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="lang_code"                data-endpoint="POSTapi-v1-admin-system-categories--id--translations"
               value="ar"
               data-component="body">
    <br>
<p>Example: <code>ar</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-categories--id--translations"
               value="تنظيف"
               data-component="body">
    <br>
<p>Example: <code>تنظيف</code></p>
        </div>
        </form>

                <h1 id="system-cities">System / Cities</h1>

    

                                <h2 id="system-cities-GETapi-v1-cities">List cities</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-cities">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/cities?q=Riy&amp;country=SA&amp;active=1&amp;from=2025-10-01&amp;to=2025-10-15&amp;per_page=15"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/cities"
);

const params = {
    "q": "Riy",
    "country": "SA",
    "active": "1",
    "from": "2025-10-01",
    "to": "2025-10-15",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-cities">
    </span>
<span id="execution-results-GETapi-v1-cities" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-cities"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-cities"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-cities" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-cities">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-cities" data-method="GET"
      data-path="api/v1/cities"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-cities', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-cities"
                    onclick="tryItOut('GETapi-v1-cities');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-cities"
                    onclick="cancelTryOut('GETapi-v1-cities');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-cities"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/cities</code></b>
        </p>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>q</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="q"                data-endpoint="GETapi-v1-cities"
               value="Riy"
               data-component="query">
    <br>
<p>Search by translated name. Example: <code>Riy</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>country</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="country"                data-endpoint="GETapi-v1-cities"
               value="SA"
               data-component="query">
    <br>
<p>ISO-2 country. Example: <code>SA</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="GETapi-v1-cities" style="display: none">
            <input type="radio" name="active"
                   value="1"
                   data-endpoint="GETapi-v1-cities"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-cities" style="display: none">
            <input type="radio" name="active"
                   value="0"
                   data-endpoint="GETapi-v1-cities"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="from"                data-endpoint="GETapi-v1-cities"
               value="2025-10-01"
               data-component="query">
    <br>
<p>date Example: <code>2025-10-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="to"                data-endpoint="GETapi-v1-cities"
               value="2025-10-15"
               data-component="query">
    <br>
<p>date Example: <code>2025-10-15</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-cities"
               value="15"
               data-component="query">
    <br>
<p>Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="system-cities-POSTapi-v1-admin-system-cities">Create a city with translations</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-cities">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/cities" \
    --header "Content-Type: application/json" \
    --data "{
    \"slug\": \"riyadh\",
    \"country_code\": \"SA\",
    \"active\": true,
    \"translations\": {
        \"ar\": \"الرياض\",
        \"en\": \"Riyadh\"
    }
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/cities"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "slug": "riyadh",
    "country_code": "SA",
    "active": true,
    "translations": {
        "ar": "الرياض",
        "en": "Riyadh"
    }
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-cities">
</span>
<span id="execution-results-POSTapi-v1-admin-system-cities" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-cities"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-cities"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-cities" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-cities">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-cities" data-method="POST"
      data-path="api/v1/admin/system/cities"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-cities', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-cities"
                    onclick="tryItOut('POSTapi-v1-admin-system-cities');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-cities"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-cities');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-cities"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/cities</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-cities"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="POSTapi-v1-admin-system-cities"
               value="riyadh"
               data-component="body">
    <br>
<p>Unique slug. Example: <code>riyadh</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="country_code"                data-endpoint="POSTapi-v1-admin-system-cities"
               value="SA"
               data-component="body">
    <br>
<p>ISO-2. Example: <code>SA</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-cities" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-cities"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-cities" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-cities"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>translations</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="translations"                data-endpoint="POSTapi-v1-admin-system-cities"
               value=""
               data-component="body">
    <br>
<p>Map of lang_code=&gt;name.</p>
        </div>
        </form>

                    <h2 id="system-cities-PUTapi-v1-admin-system-cities--id-">Update a city and/or its translations</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-admin-system-cities--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/cities/consequatur" \
    --header "Content-Type: application/json" \
    --data "{
    \"slug\": \"riyadh\",
    \"country_code\": \"SA\",
    \"active\": false,
    \"translations\": [
        \"vmqeopfuudtdsufvyvddq\"
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/cities/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "slug": "riyadh",
    "country_code": "SA",
    "active": false,
    "translations": [
        "vmqeopfuudtdsufvyvddq"
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-cities--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-system-cities--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-cities--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-cities--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-cities--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-cities--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-cities--id-" data-method="PUT"
      data-path="api/v1/admin/system/cities/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-cities--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-cities--id-"
                    onclick="tryItOut('PUTapi-v1-admin-system-cities--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-cities--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-cities--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-cities--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/cities/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-system-cities--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-v1-admin-system-cities--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the city. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="PUTapi-v1-admin-system-cities--id-"
               value="riyadh"
               data-component="body">
    <br>
<p>Unique slug. Must not be greater than 191 characters. Example: <code>riyadh</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="country_code"                data-endpoint="PUTapi-v1-admin-system-cities--id-"
               value="SA"
               data-component="body">
    <br>
<p>ISO-2. Must be 2 characters. Example: <code>SA</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-cities--id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-cities--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-cities--id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-cities--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active flag. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>translations</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="translations[0]"                data-endpoint="PUTapi-v1-admin-system-cities--id-"
               data-component="body">
        <input type="text" style="display: none"
               name="translations[1]"                data-endpoint="PUTapi-v1-admin-system-cities--id-"
               data-component="body">
    <br>
<p>This field is required when <code>translations</code> is present. Must not be greater than 191 characters.</p>
        </div>
        </form>

                    <h2 id="system-cities-DELETEapi-v1-admin-system-cities--id-">Soft delete a city</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-cities--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/cities/consequatur"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/cities/consequatur"
);

fetch(url, {
    method: "DELETE",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-cities--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-system-cities--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-cities--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-cities--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-cities--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-cities--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-cities--id-" data-method="DELETE"
      data-path="api/v1/admin/system/cities/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-cities--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-cities--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-cities--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-cities--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-cities--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-cities--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/cities/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-admin-system-cities--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the city. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="system-cities-POSTapi-v1-admin-system-cities--id--toggle">Toggle active</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-cities--id--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/cities/consequatur/toggle" \
    --header "Content-Type: application/json" \
    --data "{
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/cities/consequatur/toggle"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-cities--id--toggle">
</span>
<span id="execution-results-POSTapi-v1-admin-system-cities--id--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-cities--id--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-cities--id--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-cities--id--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-cities--id--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-cities--id--toggle" data-method="POST"
      data-path="api/v1/admin/system/cities/{id}/toggle"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-cities--id--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-cities--id--toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-cities--id--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-cities--id--toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-cities--id--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-cities--id--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/cities/{id}/toggle</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-cities--id--toggle"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-v1-admin-system-cities--id--toggle"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the city. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-cities--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-cities--id--toggle"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-cities--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-cities--id--toggle"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                <h1 id="system-coupons">System / Coupons</h1>

    

                                <h2 id="system-coupons-GETapi-v1-admin-system-coupons">GET api/v1/admin/system/coupons</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-system-coupons">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/coupons?code=WELCOME10&amp;active=1&amp;per_page=20" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/coupons"
);

const params = {
    "code": "WELCOME10",
    "active": "1",
    "per_page": "20",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-coupons">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost/api/v1/admin/system/coupons?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost/api/v1/admin/system/coupons?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: null,
        &quot;last_page&quot;: 1,
        &quot;path&quot;: &quot;http://localhost/api/v1/admin/system/coupons&quot;,
        &quot;per_page&quot;: 15,
        &quot;to&quot;: null,
        &quot;total&quot;: 0
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-system-coupons" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-coupons"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-coupons"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-coupons" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-coupons">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-coupons" data-method="GET"
      data-path="api/v1/admin/system/coupons"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-coupons', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-coupons"
                    onclick="tryItOut('GETapi-v1-admin-system-coupons');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-coupons"
                    onclick="cancelTryOut('GETapi-v1-admin-system-coupons');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-coupons"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/coupons</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-system-coupons"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="GETapi-v1-admin-system-coupons"
               value="WELCOME10"
               data-component="query">
    <br>
<p>Filter by code (LIKE). Example: <code>WELCOME10</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="GETapi-v1-admin-system-coupons" style="display: none">
            <input type="radio" name="active"
                   value="1"
                   data-endpoint="GETapi-v1-admin-system-coupons"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-admin-system-coupons" style="display: none">
            <input type="radio" name="active"
                   value="0"
                   data-endpoint="GETapi-v1-admin-system-coupons"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Filter by active status. Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-admin-system-coupons"
               value="20"
               data-component="query">
    <br>
<p>Results per page (default 15). Example: <code>20</code></p>
            </div>
                </form>

                    <h2 id="system-coupons-POSTapi-v1-admin-system-coupons">POST api/v1/admin/system/coupons</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-coupons">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/coupons" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"code\": \"WELCOME10\",
    \"type\": \"percent\",
    \"amount\": 10,
    \"currency_code\": \"USD\",
    \"starts_at\": \"2025-01-01 00:00:00\",
    \"ends_at\": \"2025-12-31 23:59:59\",
    \"max_redemptions\": 1000,
    \"per_office_limit\": 1,
    \"active\": true,
    \"meta\": {
        \"note\": \"new year\"
    }
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/coupons"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "code": "WELCOME10",
    "type": "percent",
    "amount": 10,
    "currency_code": "USD",
    "starts_at": "2025-01-01 00:00:00",
    "ends_at": "2025-12-31 23:59:59",
    "max_redemptions": 1000,
    "per_office_limit": 1,
    "active": true,
    "meta": {
        "note": "new year"
    }
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-coupons">
            <blockquote>
            <p>Example response (201, Created):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Coupon created&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;code&quot;: &quot;WELCOME10&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-admin-system-coupons" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-coupons"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-coupons"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-coupons" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-coupons">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-coupons" data-method="POST"
      data-path="api/v1/admin/system/coupons"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-coupons', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-coupons"
                    onclick="tryItOut('POSTapi-v1-admin-system-coupons');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-coupons"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-coupons');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-coupons"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/coupons</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-coupons"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-coupons"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-admin-system-coupons"
               value="WELCOME10"
               data-component="body">
    <br>
<p>Unique coupon code. Example: <code>WELCOME10</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-v1-admin-system-coupons"
               value="percent"
               data-component="body">
    <br>
<p>Discount type: percent|fixed. Example: <code>percent</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount"                data-endpoint="POSTapi-v1-admin-system-coupons"
               value="10"
               data-component="body">
    <br>
<p>Amount; if percent, 10 means 10%. Example: <code>10</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="currency_code"                data-endpoint="POSTapi-v1-admin-system-coupons"
               value="USD"
               data-component="body">
    <br>
<p>Currency of amount (only for fixed). Example: <code>USD</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>starts_at</code></b>&nbsp;&nbsp;
<small>datetime</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="starts_at"                data-endpoint="POSTapi-v1-admin-system-coupons"
               value="2025-01-01 00:00:00"
               data-component="body">
    <br>
<p>Start date (Y-m-d H:i:s). Example: <code>2025-01-01 00:00:00</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ends_at</code></b>&nbsp;&nbsp;
<small>datetime</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="ends_at"                data-endpoint="POSTapi-v1-admin-system-coupons"
               value="2025-12-31 23:59:59"
               data-component="body">
    <br>
<p>End date (Y-m-d H:i:s). Must be after starts_at. Example: <code>2025-12-31 23:59:59</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>max_redemptions</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="max_redemptions"                data-endpoint="POSTapi-v1-admin-system-coupons"
               value="1000"
               data-component="body">
    <br>
<p>Max total redemptions (null for unlimited). Example: <code>1000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_office_limit</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_office_limit"                data-endpoint="POSTapi-v1-admin-system-coupons"
               value="1"
               data-component="body">
    <br>
<p>Max redemptions per office (null for unlimited). Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-coupons" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-coupons"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-coupons" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-coupons"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Whether coupon is active. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta"                data-endpoint="POSTapi-v1-admin-system-coupons"
               value=""
               data-component="body">
    <br>
<p>Free-form JSON metadata (send as JSON string in form-data).</p>
        </div>
        </form>

                    <h2 id="system-coupons-PUTapi-v1-admin-system-coupons--id-">PUT api/v1/admin/system/coupons/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-system-coupons--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/coupons/5" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"type\": \"fixed\",
    \"amount\": 25,
    \"currency_code\": \"SAR\",
    \"starts_at\": \"2025-01-01 00:00:00\",
    \"ends_at\": \"2025-06-30 23:59:59\",
    \"max_redemptions\": 500,
    \"per_office_limit\": 2,
    \"active\": false,
    \"meta\": {
        \"channel\": \"web\"
    }
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/coupons/5"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "fixed",
    "amount": 25,
    "currency_code": "SAR",
    "starts_at": "2025-01-01 00:00:00",
    "ends_at": "2025-06-30 23:59:59",
    "max_redemptions": 500,
    "per_office_limit": 2,
    "active": false,
    "meta": {
        "channel": "web"
    }
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-coupons--id-">
            <blockquote>
            <p>Example response (200, Updated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Coupon updated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v1-admin-system-coupons--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-coupons--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-coupons--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-coupons--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-coupons--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-coupons--id-" data-method="PUT"
      data-path="api/v1/admin/system/coupons/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-coupons--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-coupons--id-"
                    onclick="tryItOut('PUTapi-v1-admin-system-coupons--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-coupons--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-coupons--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-coupons--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/coupons/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-system-coupons--id-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-system-coupons--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-admin-system-coupons--id-"
               value="5"
               data-component="url">
    <br>
<p>The coupon ID. Example: <code>5</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="PUTapi-v1-admin-system-coupons--id-"
               value="fixed"
               data-component="body">
    <br>
<p>Discount type: percent|fixed. Example: <code>fixed</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount"                data-endpoint="PUTapi-v1-admin-system-coupons--id-"
               value="25"
               data-component="body">
    <br>
<p>Amount (see type). Example: <code>25</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="currency_code"                data-endpoint="PUTapi-v1-admin-system-coupons--id-"
               value="SAR"
               data-component="body">
    <br>
<p>Currency for fixed type. Example: <code>SAR</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>starts_at</code></b>&nbsp;&nbsp;
<small>datetime</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="starts_at"                data-endpoint="PUTapi-v1-admin-system-coupons--id-"
               value="2025-01-01 00:00:00"
               data-component="body">
    <br>
<p>Start date (Y-m-d H:i:s). Example: <code>2025-01-01 00:00:00</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ends_at</code></b>&nbsp;&nbsp;
<small>datetime</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="ends_at"                data-endpoint="PUTapi-v1-admin-system-coupons--id-"
               value="2025-06-30 23:59:59"
               data-component="body">
    <br>
<p>End date (Y-m-d H:i:s). Must be after starts_at. Example: <code>2025-06-30 23:59:59</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>max_redemptions</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="max_redemptions"                data-endpoint="PUTapi-v1-admin-system-coupons--id-"
               value="500"
               data-component="body">
    <br>
<p>Max total redemptions. Example: <code>500</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_office_limit</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_office_limit"                data-endpoint="PUTapi-v1-admin-system-coupons--id-"
               value="2"
               data-component="body">
    <br>
<p>Per-office limit. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-coupons--id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-coupons--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-coupons--id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-coupons--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active flag. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta"                data-endpoint="PUTapi-v1-admin-system-coupons--id-"
               value=""
               data-component="body">
    <br>
<p>Free-form JSON metadata (send as JSON string in form-data).</p>
        </div>
        </form>

                    <h2 id="system-coupons-DELETEapi-v1-admin-system-coupons--id-">DELETE api/v1/admin/system/coupons/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-coupons--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/coupons/5" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/coupons/5"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-coupons--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Coupon deleted&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-v1-admin-system-coupons--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-coupons--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-coupons--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-coupons--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-coupons--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-coupons--id-" data-method="DELETE"
      data-path="api/v1/admin/system/coupons/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-coupons--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-coupons--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-coupons--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-coupons--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-coupons--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-coupons--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/coupons/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-system-coupons--id-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-admin-system-coupons--id-"
               value="5"
               data-component="url">
    <br>
<p>The coupon ID. Example: <code>5</code></p>
            </div>
                    </form>

                    <h2 id="system-coupons-POSTapi-v1-admin-system-coupons--id--toggle">POST api/v1/admin/system/coupons/{id}/toggle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-coupons--id--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/coupons/5/toggle" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/coupons/5/toggle"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-coupons--id--toggle">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Coupon status updated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-admin-system-coupons--id--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-coupons--id--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-coupons--id--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-coupons--id--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-coupons--id--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-coupons--id--toggle" data-method="POST"
      data-path="api/v1/admin/system/coupons/{id}/toggle"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-coupons--id--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-coupons--id--toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-coupons--id--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-coupons--id--toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-coupons--id--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-coupons--id--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/coupons/{id}/toggle</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-coupons--id--toggle"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-coupons--id--toggle"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-admin-system-coupons--id--toggle"
               value="5"
               data-component="url">
    <br>
<p>The coupon ID. Example: <code>5</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-coupons--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-coupons--id--toggle"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-coupons--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-coupons--id--toggle"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Set to 1 to enable, 0 to disable. Example: <code>true</code></p>
        </div>
        </form>

                <h1 id="system-currencies">System / Currencies</h1>

    

                                <h2 id="system-currencies-GETapi-v1-admin-system-currencies">List currencies (paginated). Use ?all=1 to return all.</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-currencies">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/currencies"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/currencies"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-currencies">
    </span>
<span id="execution-results-GETapi-v1-admin-system-currencies" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-currencies"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-currencies"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-currencies" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-currencies">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-currencies" data-method="GET"
      data-path="api/v1/admin/system/currencies"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-currencies', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-currencies"
                    onclick="tryItOut('GETapi-v1-admin-system-currencies');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-currencies"
                    onclick="cancelTryOut('GETapi-v1-admin-system-currencies');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-currencies"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/currencies</code></b>
        </p>
                    </form>

                    <h2 id="system-currencies-POSTapi-v1-admin-system-currencies">Upsert a currency.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-currencies">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/currencies" \
    --header "Content-Type: application/json" \
    --data "{
    \"code\": \"SAR\",
    \"name\": \"Saudi Riyal\",
    \"symbol\": \"﷼\",
    \"decimal\": 2,
    \"active\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/currencies"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "code": "SAR",
    "name": "Saudi Riyal",
    "symbol": "﷼",
    "decimal": 2,
    "active": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-currencies">
</span>
<span id="execution-results-POSTapi-v1-admin-system-currencies" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-currencies"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-currencies"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-currencies" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-currencies">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-currencies" data-method="POST"
      data-path="api/v1/admin/system/currencies"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-currencies', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-currencies"
                    onclick="tryItOut('POSTapi-v1-admin-system-currencies');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-currencies"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-currencies');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-currencies"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/currencies</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-currencies"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-admin-system-currencies"
               value="SAR"
               data-component="body">
    <br>
<p>ISO code. Must not be greater than 8 characters. Example: <code>SAR</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-currencies"
               value="Saudi Riyal"
               data-component="body">
    <br>
<p>Display name. Must not be greater than 64 characters. Example: <code>Saudi Riyal</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>symbol</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="symbol"                data-endpoint="POSTapi-v1-admin-system-currencies"
               value="﷼"
               data-component="body">
    <br>
<p>Symbol. Must not be greater than 16 characters. Example: <code>﷼</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>decimal</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="decimal"                data-endpoint="POSTapi-v1-admin-system-currencies"
               value="2"
               data-component="body">
    <br>
<p>Fraction digits. Must be at least 0. Must not be greater than 6. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-currencies" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-currencies"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-currencies" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-currencies"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Enabled. Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="system-currencies-PUTapi-v1-admin-system-currencies--code-">Update a currency.</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-admin-system-currencies--code-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/currencies/consequatur" \
    --header "Content-Type: application/json" \
    --data "{
    \"name\": \"Saudi Riyal\",
    \"symbol\": \"﷼\",
    \"decimal\": 2,
    \"active\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/currencies/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Saudi Riyal",
    "symbol": "﷼",
    "decimal": 2,
    "active": false
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-currencies--code-">
</span>
<span id="execution-results-PUTapi-v1-admin-system-currencies--code-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-currencies--code-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-currencies--code-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-currencies--code-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-currencies--code-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-currencies--code-" data-method="PUT"
      data-path="api/v1/admin/system/currencies/{code}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-currencies--code-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-currencies--code-"
                    onclick="tryItOut('PUTapi-v1-admin-system-currencies--code-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-currencies--code-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-currencies--code-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-currencies--code-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/currencies/{code}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-system-currencies--code-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="PUTapi-v1-admin-system-currencies--code-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-admin-system-currencies--code-"
               value="Saudi Riyal"
               data-component="body">
    <br>
<p>Display name. Must not be greater than 64 characters. Example: <code>Saudi Riyal</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>symbol</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="symbol"                data-endpoint="PUTapi-v1-admin-system-currencies--code-"
               value="﷼"
               data-component="body">
    <br>
<p>Symbol. Must not be greater than 16 characters. Example: <code>﷼</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>decimal</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="decimal"                data-endpoint="PUTapi-v1-admin-system-currencies--code-"
               value="2"
               data-component="body">
    <br>
<p>Fraction digits. Must be at least 0. Must not be greater than 6. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-currencies--code-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-currencies--code-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-currencies--code-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-currencies--code-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Enabled. Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="system-currencies-DELETEapi-v1-admin-system-currencies--code-">Soft-delete a currency.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-currencies--code-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/currencies/consequatur"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/currencies/consequatur"
);

fetch(url, {
    method: "DELETE",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-currencies--code-">
</span>
<span id="execution-results-DELETEapi-v1-admin-system-currencies--code-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-currencies--code-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-currencies--code-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-currencies--code-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-currencies--code-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-currencies--code-" data-method="DELETE"
      data-path="api/v1/admin/system/currencies/{code}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-currencies--code-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-currencies--code-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-currencies--code-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-currencies--code-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-currencies--code-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-currencies--code-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/currencies/{code}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="DELETEapi-v1-admin-system-currencies--code-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="system-currencies-POSTapi-v1-admin-system-currencies--code--toggle">Toggle active flag.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-currencies--code--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/currencies/consequatur/toggle"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/currencies/consequatur/toggle"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-currencies--code--toggle">
</span>
<span id="execution-results-POSTapi-v1-admin-system-currencies--code--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-currencies--code--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-currencies--code--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-currencies--code--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-currencies--code--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-currencies--code--toggle" data-method="POST"
      data-path="api/v1/admin/system/currencies/{code}/toggle"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-currencies--code--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-currencies--code--toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-currencies--code--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-currencies--code--toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-currencies--code--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-currencies--code--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/currencies/{code}/toggle</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-admin-system-currencies--code--toggle"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="system-exchange-rates">System / Exchange Rates</h1>

    

                                <h2 id="system-exchange-rates-GETapi-v1-admin-system-exchange-rates">List exchange rates (paginated). Use ?all=1 to return all.</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-exchange-rates">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/exchange-rates"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/exchange-rates"
);

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-exchange-rates">
    </span>
<span id="execution-results-GETapi-v1-admin-system-exchange-rates" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-exchange-rates"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-exchange-rates"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-exchange-rates" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-exchange-rates">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-exchange-rates" data-method="GET"
      data-path="api/v1/admin/system/exchange-rates"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-exchange-rates', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-exchange-rates"
                    onclick="tryItOut('GETapi-v1-admin-system-exchange-rates');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-exchange-rates"
                    onclick="cancelTryOut('GETapi-v1-admin-system-exchange-rates');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-exchange-rates"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/exchange-rates</code></b>
        </p>
                    </form>

                    <h2 id="system-exchange-rates-POSTapi-v1-admin-system-exchange-rates">Upsert a rate (base-quote).</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-exchange-rates">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/exchange-rates" \
    --header "Content-Type: application/json" \
    --data "{
    \"base\": \"USD\",
    \"quote\": \"EGP\",
    \"rate\": 48.25,
    \"fetched_at\": \"2025-10-13T12:00:00Z\",
    \"active\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/exchange-rates"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "base": "USD",
    "quote": "EGP",
    "rate": 48.25,
    "fetched_at": "2025-10-13T12:00:00Z",
    "active": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-exchange-rates">
</span>
<span id="execution-results-POSTapi-v1-admin-system-exchange-rates" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-exchange-rates"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-exchange-rates"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-exchange-rates" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-exchange-rates">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-exchange-rates" data-method="POST"
      data-path="api/v1/admin/system/exchange-rates"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-exchange-rates', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-exchange-rates"
                    onclick="tryItOut('POSTapi-v1-admin-system-exchange-rates');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-exchange-rates"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-exchange-rates');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-exchange-rates"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/exchange-rates</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-exchange-rates"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>base</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="base"                data-endpoint="POSTapi-v1-admin-system-exchange-rates"
               value="USD"
               data-component="body">
    <br>
<p>Base currency. Must not be greater than 8 characters. Example: <code>USD</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quote</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="quote"                data-endpoint="POSTapi-v1-admin-system-exchange-rates"
               value="EGP"
               data-component="body">
    <br>
<p>Quote currency. The value and <code>base</code> must be different. Must not be greater than 8 characters. Example: <code>EGP</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rate</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rate"                data-endpoint="POSTapi-v1-admin-system-exchange-rates"
               value="48.25"
               data-component="body">
    <br>
<p>Exchange rate. Example: <code>48.25</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>fetched_at</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="fetched_at"                data-endpoint="POSTapi-v1-admin-system-exchange-rates"
               value="2025-10-13T12:00:00Z"
               data-component="body">
    <br>
<p>Timestamp. Must be a valid date. Example: <code>2025-10-13T12:00:00Z</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-exchange-rates" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-exchange-rates"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-exchange-rates" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-exchange-rates"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Enabled. Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="system-exchange-rates-POSTapi-v1-admin-system-exchange-rates-toggle">Toggle active for a pair.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-exchange-rates-toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/exchange-rates/toggle"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/exchange-rates/toggle"
);

fetch(url, {
    method: "POST",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-exchange-rates-toggle">
</span>
<span id="execution-results-POSTapi-v1-admin-system-exchange-rates-toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-exchange-rates-toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-exchange-rates-toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-exchange-rates-toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-exchange-rates-toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-exchange-rates-toggle" data-method="POST"
      data-path="api/v1/admin/system/exchange-rates/toggle"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-exchange-rates-toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-exchange-rates-toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-exchange-rates-toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-exchange-rates-toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-exchange-rates-toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-exchange-rates-toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/exchange-rates/toggle</code></b>
        </p>
                    </form>

                <h1 id="system-insurance-companies">System / Insurance Companies</h1>

    

                                <h2 id="system-insurance-companies-GETapi-v1-admin-system-insurance-companies">GET api/v1/admin/system/insurance-companies</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-insurance-companies">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/insurance-companies?q=comp&amp;active=1&amp;from=2025-10-01&amp;to=2025-10-15&amp;per_page=15"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/insurance-companies"
);

const params = {
    "q": "comp",
    "active": "1",
    "from": "2025-10-01",
    "to": "2025-10-15",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-insurance-companies">
    </span>
<span id="execution-results-GETapi-v1-admin-system-insurance-companies" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-insurance-companies"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-insurance-companies"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-insurance-companies" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-insurance-companies">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-insurance-companies" data-method="GET"
      data-path="api/v1/admin/system/insurance-companies"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-insurance-companies', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-insurance-companies"
                    onclick="tryItOut('GETapi-v1-admin-system-insurance-companies');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-insurance-companies"
                    onclick="cancelTryOut('GETapi-v1-admin-system-insurance-companies');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-insurance-companies"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/insurance-companies</code></b>
        </p>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>q</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="q"                data-endpoint="GETapi-v1-admin-system-insurance-companies"
               value="comp"
               data-component="query">
    <br>
<p>Search name/website. Example: <code>comp</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="GETapi-v1-admin-system-insurance-companies" style="display: none">
            <input type="radio" name="active"
                   value="1"
                   data-endpoint="GETapi-v1-admin-system-insurance-companies"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-admin-system-insurance-companies" style="display: none">
            <input type="radio" name="active"
                   value="0"
                   data-endpoint="GETapi-v1-admin-system-insurance-companies"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="from"                data-endpoint="GETapi-v1-admin-system-insurance-companies"
               value="2025-10-01"
               data-component="query">
    <br>
<p>date Example: <code>2025-10-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="to"                data-endpoint="GETapi-v1-admin-system-insurance-companies"
               value="2025-10-15"
               data-component="query">
    <br>
<p>date Example: <code>2025-10-15</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-admin-system-insurance-companies"
               value="15"
               data-component="query">
    <br>
<p>Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="system-insurance-companies-POSTapi-v1-admin-system-insurance-companies">POST api/v1/admin/system/insurance-companies</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-insurance-companies">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/insurance-companies" \
    --header "Content-Type: multipart/form-data" \
    --form "name=consequatur"\
    --form "website=consequatur"\
    --form "active="\
    --form "insurance_amount=10000"\
    --form "currency_code=EGP"\
    --form "logo=@C:\Users\ahmednour\AppData\Local\Microsoft\WinGet\Packages\Astronomer.Astro_Microsoft.Winget.Source_8wekyb3d8bbwe\phpD4BC.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/insurance-companies"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'consequatur');
body.append('website', 'consequatur');
body.append('active', '');
body.append('insurance_amount', '10000');
body.append('currency_code', 'EGP');
body.append('logo', document.querySelector('input[name="logo"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-insurance-companies">
</span>
<span id="execution-results-POSTapi-v1-admin-system-insurance-companies" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-insurance-companies"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-insurance-companies"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-insurance-companies" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-insurance-companies">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-insurance-companies" data-method="POST"
      data-path="api/v1/admin/system/insurance-companies"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-insurance-companies', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-insurance-companies"
                    onclick="tryItOut('POSTapi-v1-admin-system-insurance-companies');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-insurance-companies"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-insurance-companies');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-insurance-companies"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/insurance-companies</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-insurance-companies"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-insurance-companies"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>website</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="website"                data-endpoint="POSTapi-v1-admin-system-insurance-companies"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>logo</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="logo"                data-endpoint="POSTapi-v1-admin-system-insurance-companies"
               value=""
               data-component="body">
    <br>
<p>image Example: <code>C:\Users\ahmednour\AppData\Local\Microsoft\WinGet\Packages\Astronomer.Astro_Microsoft.Winget.Source_8wekyb3d8bbwe\phpD4BC.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-insurance-companies" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-insurance-companies"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-insurance-companies" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-insurance-companies"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>insurance_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="insurance_amount"                data-endpoint="POSTapi-v1-admin-system-insurance-companies"
               value="10000"
               data-component="body">
    <br>
<p>Insurance amount in company base currency. Must be at least 0. Example: <code>10000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="currency_code"                data-endpoint="POSTapi-v1-admin-system-insurance-companies"
               value="EGP"
               data-component="body">
    <br>
<p>Currency code (from currencies.code). The <code>code</code> of an existing record in the system.currencies table. Must not be greater than 8 characters. Example: <code>EGP</code></p>
        </div>
        </form>

                    <h2 id="system-insurance-companies-PUTapi-v1-admin-system-insurance-companies--id-">PUT api/v1/admin/system/insurance-companies/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-admin-system-insurance-companies--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/insurance-companies/consequatur" \
    --header "Content-Type: multipart/form-data" \
    --form "name=consequatur"\
    --form "website=consequatur"\
    --form "active="\
    --form "insurance_amount=10000"\
    --form "currency_code=EGP"\
    --form "logo=@C:\Users\ahmednour\AppData\Local\Microsoft\WinGet\Packages\Astronomer.Astro_Microsoft.Winget.Source_8wekyb3d8bbwe\phpD4CD.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/insurance-companies/consequatur"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'consequatur');
body.append('website', 'consequatur');
body.append('active', '');
body.append('insurance_amount', '10000');
body.append('currency_code', 'EGP');
body.append('logo', document.querySelector('input[name="logo"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-insurance-companies--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-system-insurance-companies--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-insurance-companies--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-insurance-companies--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-insurance-companies--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-insurance-companies--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-insurance-companies--id-" data-method="PUT"
      data-path="api/v1/admin/system/insurance-companies/{id}"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-insurance-companies--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-insurance-companies--id-"
                    onclick="tryItOut('PUTapi-v1-admin-system-insurance-companies--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-insurance-companies--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-insurance-companies--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-insurance-companies--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/insurance-companies/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-system-insurance-companies--id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-v1-admin-system-insurance-companies--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the insurance company. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-admin-system-insurance-companies--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>website</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="website"                data-endpoint="PUTapi-v1-admin-system-insurance-companies--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>logo</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="logo"                data-endpoint="PUTapi-v1-admin-system-insurance-companies--id-"
               value=""
               data-component="body">
    <br>
<p>image Example: <code>C:\Users\ahmednour\AppData\Local\Microsoft\WinGet\Packages\Astronomer.Astro_Microsoft.Winget.Source_8wekyb3d8bbwe\phpD4CD.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-insurance-companies--id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-insurance-companies--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-insurance-companies--id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-insurance-companies--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>insurance_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="insurance_amount"                data-endpoint="PUTapi-v1-admin-system-insurance-companies--id-"
               value="10000"
               data-component="body">
    <br>
<p>Insurance amount in company base currency. Must be at least 0. Example: <code>10000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="currency_code"                data-endpoint="PUTapi-v1-admin-system-insurance-companies--id-"
               value="EGP"
               data-component="body">
    <br>
<p>Currency code (from currencies.code). The <code>code</code> of an existing record in the system.currencies table. Must not be greater than 8 characters. Example: <code>EGP</code></p>
        </div>
        </form>

                    <h2 id="system-insurance-companies-DELETEapi-v1-admin-system-insurance-companies--id-">DELETE api/v1/admin/system/insurance-companies/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-insurance-companies--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/insurance-companies/consequatur"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/insurance-companies/consequatur"
);

fetch(url, {
    method: "DELETE",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-insurance-companies--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-system-insurance-companies--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-insurance-companies--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-insurance-companies--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-insurance-companies--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-insurance-companies--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-insurance-companies--id-" data-method="DELETE"
      data-path="api/v1/admin/system/insurance-companies/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-insurance-companies--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-insurance-companies--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-insurance-companies--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-insurance-companies--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-insurance-companies--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-insurance-companies--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/insurance-companies/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-admin-system-insurance-companies--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the insurance company. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="system-insurance-companies-POSTapi-v1-admin-system-insurance-companies--id--toggle">POST api/v1/admin/system/insurance-companies/{id}/toggle</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-insurance-companies--id--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/insurance-companies/consequatur/toggle" \
    --header "Content-Type: application/json" \
    --data "{
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/insurance-companies/consequatur/toggle"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-insurance-companies--id--toggle">
</span>
<span id="execution-results-POSTapi-v1-admin-system-insurance-companies--id--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-insurance-companies--id--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-insurance-companies--id--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-insurance-companies--id--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-insurance-companies--id--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-insurance-companies--id--toggle" data-method="POST"
      data-path="api/v1/admin/system/insurance-companies/{id}/toggle"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-insurance-companies--id--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-insurance-companies--id--toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-insurance-companies--id--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-insurance-companies--id--toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-insurance-companies--id--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-insurance-companies--id--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/insurance-companies/{id}/toggle</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-insurance-companies--id--toggle"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-v1-admin-system-insurance-companies--id--toggle"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the insurance company. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-insurance-companies--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-insurance-companies--id--toggle"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-insurance-companies--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-insurance-companies--id--toggle"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                <h1 id="system-languages">System / Languages</h1>

    

                                <h2 id="system-languages-GETapi-v1-admin-system-languages">List system languages

Paginated list. Use ?per_page=0 or ?all=1 to fetch all.</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-system-languages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/languages?per_page=15&amp;all=1"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/languages"
);

const params = {
    "per_page": "15",
    "all": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

fetch(url, {
    method: "GET",
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-languages">
    </span>
<span id="execution-results-GETapi-v1-admin-system-languages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-languages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-languages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-languages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-languages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-languages" data-method="GET"
      data-path="api/v1/admin/system/languages"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-languages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-languages"
                    onclick="tryItOut('GETapi-v1-admin-system-languages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-languages"
                    onclick="cancelTryOut('GETapi-v1-admin-system-languages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-languages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/languages</code></b>
        </p>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-admin-system-languages"
               value="15"
               data-component="query">
    <br>
<p>Number per page. Example: <code>15</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>all</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="GETapi-v1-admin-system-languages" style="display: none">
            <input type="radio" name="all"
                   value="1"
                   data-endpoint="GETapi-v1-admin-system-languages"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-admin-system-languages" style="display: none">
            <input type="radio" name="all"
                   value="0"
                   data-endpoint="GETapi-v1-admin-system-languages"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Return all records (no pagination). Example: <code>true</code></p>
            </div>
                </form>

                    <h2 id="system-languages-POSTapi-v1-admin-system-languages">Store or update a system language</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-system-languages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/languages" \
    --header "Content-Type: application/json" \
    --data "{
    \"code\": \"ar\",
    \"name\": \"Arabic\",
    \"native_name\": \"العربية\",
    \"rtl\": true,
    \"status\": \"active\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/languages"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "code": "ar",
    "name": "Arabic",
    "native_name": "العربية",
    "rtl": true,
    "status": "active"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-languages">
</span>
<span id="execution-results-POSTapi-v1-admin-system-languages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-languages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-languages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-languages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-languages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-languages" data-method="POST"
      data-path="api/v1/admin/system/languages"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-languages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-languages"
                    onclick="tryItOut('POSTapi-v1-admin-system-languages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-languages"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-languages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-languages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/languages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-languages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-admin-system-languages"
               value="ar"
               data-component="body">
    <br>
<p>Two-letter (or en-US). Example: <code>ar</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-languages"
               value="Arabic"
               data-component="body">
    <br>
<p>Localized name. Example: <code>Arabic</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>native_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="native_name"                data-endpoint="POSTapi-v1-admin-system-languages"
               value="العربية"
               data-component="body">
    <br>
<p>Native name. Example: <code>العربية</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rtl</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-languages" style="display: none">
            <input type="radio" name="rtl"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-languages"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-languages" style="display: none">
            <input type="radio" name="rtl"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-languages"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>RTL language. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-v1-admin-system-languages"
               value="active"
               data-component="body">
    <br>
<p>active|inactive. Example: <code>active</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta"                data-endpoint="POSTapi-v1-admin-system-languages"
               value=""
               data-component="body">
    <br>

        </div>
        </form>

                <h1 id="system-nationalities">System / Nationalities</h1>

    

                                <h2 id="system-nationalities-GETapi-v1-admin-system-nationalities">List nationalities</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-system-nationalities">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/nationalities?q=sa&amp;active=1&amp;from=2025-01-01&amp;to=2025-12-31&amp;per_page=15" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/nationalities"
);

const params = {
    "q": "sa",
    "active": "1",
    "from": "2025-01-01",
    "to": "2025-12-31",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-nationalities">
    </span>
<span id="execution-results-GETapi-v1-admin-system-nationalities" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-nationalities"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-nationalities"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-nationalities" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-nationalities">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-nationalities" data-method="GET"
      data-path="api/v1/admin/system/nationalities"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-nationalities', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-nationalities"
                    onclick="tryItOut('GETapi-v1-admin-system-nationalities');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-nationalities"
                    onclick="cancelTryOut('GETapi-v1-admin-system-nationalities');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-nationalities"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/nationalities</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-system-nationalities"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>q</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="q"                data-endpoint="GETapi-v1-admin-system-nationalities"
               value="sa"
               data-component="query">
    <br>
<p>Search by code/name. Example: <code>sa</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="GETapi-v1-admin-system-nationalities" style="display: none">
            <input type="radio" name="active"
                   value="1"
                   data-endpoint="GETapi-v1-admin-system-nationalities"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-admin-system-nationalities" style="display: none">
            <input type="radio" name="active"
                   value="0"
                   data-endpoint="GETapi-v1-admin-system-nationalities"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Filter by active. Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="from"                data-endpoint="GETapi-v1-admin-system-nationalities"
               value="2025-01-01"
               data-component="query">
    <br>
<p>date Example: <code>2025-01-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="to"                data-endpoint="GETapi-v1-admin-system-nationalities"
               value="2025-12-31"
               data-component="query">
    <br>
<p>date Example: <code>2025-12-31</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-admin-system-nationalities"
               value="15"
               data-component="query">
    <br>
<p>Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="system-nationalities-POSTapi-v1-admin-system-nationalities">Create nationality</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-nationalities">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/nationalities" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"code\": \"SA\",
    \"name\": \"Saudi\",
    \"active\": true,
    \"translations\": [
        {
            \"lang_code\": \"ar\",
            \"name\": \"سعودي\"
        }
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/nationalities"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "code": "SA",
    "name": "Saudi",
    "active": true,
    "translations": [
        {
            "lang_code": "ar",
            "name": "سعودي"
        }
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-nationalities">
</span>
<span id="execution-results-POSTapi-v1-admin-system-nationalities" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-nationalities"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-nationalities"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-nationalities" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-nationalities">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-nationalities" data-method="POST"
      data-path="api/v1/admin/system/nationalities"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-nationalities', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-nationalities"
                    onclick="tryItOut('POSTapi-v1-admin-system-nationalities');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-nationalities"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-nationalities');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-nationalities"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/nationalities</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-nationalities"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-nationalities"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-admin-system-nationalities"
               value="SA"
               data-component="body">
    <br>
<p>Unique code. Example: <code>SA</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-nationalities"
               value="Saudi"
               data-component="body">
    <br>
<p>Default name. Example: <code>Saudi</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-nationalities" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-nationalities"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-nationalities" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-nationalities"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active flag. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta"                data-endpoint="POSTapi-v1-admin-system-nationalities"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>translations</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
<br>
<p>Translations list.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>lang_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="translations.0.lang_code"                data-endpoint="POSTapi-v1-admin-system-nationalities"
               value="vmqeopfuud"
               data-component="body">
    <br>
<p>This field is required when <code>translations</code> is present. Must not be greater than 12 characters. Example: <code>vmqeopfuud</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="translations.0.name"                data-endpoint="POSTapi-v1-admin-system-nationalities"
               value="tdsufvyvddqamniihfqco"
               data-component="body">
    <br>
<p>This field is required when <code>translations</code> is present. Must not be greater than 191 characters. Example: <code>tdsufvyvddqamniihfqco</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="system-nationalities-PUTapi-v1-admin-system-nationalities--id-">Update nationality</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-system-nationalities--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/nationalities/3" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"code\": \"EG\",
    \"name\": \"Egyptian\",
    \"active\": false,
    \"translations\": [
        {
            \"lang_code\": \"ar\",
            \"name\": \"مصري\"
        }
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/nationalities/3"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "code": "EG",
    "name": "Egyptian",
    "active": false,
    "translations": [
        {
            "lang_code": "ar",
            "name": "مصري"
        }
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-nationalities--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-system-nationalities--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-nationalities--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-nationalities--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-nationalities--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-nationalities--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-nationalities--id-" data-method="PUT"
      data-path="api/v1/admin/system/nationalities/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-nationalities--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-nationalities--id-"
                    onclick="tryItOut('PUTapi-v1-admin-system-nationalities--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-nationalities--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-nationalities--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-nationalities--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/nationalities/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-system-nationalities--id-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-system-nationalities--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-admin-system-nationalities--id-"
               value="3"
               data-component="url">
    <br>
<p>Nationality ID. Example: <code>3</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="PUTapi-v1-admin-system-nationalities--id-"
               value="EG"
               data-component="body">
    <br>
<p>Unique code. Example: <code>EG</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-admin-system-nationalities--id-"
               value="Egyptian"
               data-component="body">
    <br>
<p>Default name. Example: <code>Egyptian</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-nationalities--id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-nationalities--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-nationalities--id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-nationalities--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active flag. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta"                data-endpoint="PUTapi-v1-admin-system-nationalities--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>translations</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
<br>
<p>Replace/upsert translations.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>lang_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="translations.0.lang_code"                data-endpoint="PUTapi-v1-admin-system-nationalities--id-"
               value="vmqeopfuud"
               data-component="body">
    <br>
<p>This field is required when <code>translations</code> is present. Must not be greater than 12 characters. Example: <code>vmqeopfuud</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="translations.0.name"                data-endpoint="PUTapi-v1-admin-system-nationalities--id-"
               value="tdsufvyvddqamniihfqco"
               data-component="body">
    <br>
<p>This field is required when <code>translations</code> is present. Must not be greater than 191 characters. Example: <code>tdsufvyvddqamniihfqco</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="system-nationalities-DELETEapi-v1-admin-system-nationalities--id-">Delete nationality</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-nationalities--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/nationalities/3" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/nationalities/3"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-nationalities--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-system-nationalities--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-nationalities--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-nationalities--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-nationalities--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-nationalities--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-nationalities--id-" data-method="DELETE"
      data-path="api/v1/admin/system/nationalities/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-nationalities--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-nationalities--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-nationalities--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-nationalities--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-nationalities--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-nationalities--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/nationalities/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-system-nationalities--id-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-admin-system-nationalities--id-"
               value="3"
               data-component="url">
    <br>
<p>Nationality ID. Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="system-nationalities-POSTapi-v1-admin-system-nationalities--id--toggle">Toggle nationality</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-nationalities--id--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/nationalities/3/toggle" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/nationalities/3/toggle"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-nationalities--id--toggle">
</span>
<span id="execution-results-POSTapi-v1-admin-system-nationalities--id--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-nationalities--id--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-nationalities--id--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-nationalities--id--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-nationalities--id--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-nationalities--id--toggle" data-method="POST"
      data-path="api/v1/admin/system/nationalities/{id}/toggle"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-nationalities--id--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-nationalities--id--toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-nationalities--id--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-nationalities--id--toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-nationalities--id--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-nationalities--id--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/nationalities/{id}/toggle</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-nationalities--id--toggle"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-nationalities--id--toggle"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-admin-system-nationalities--id--toggle"
               value="3"
               data-component="url">
    <br>
<p>Nationality ID. Example: <code>3</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-nationalities--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-nationalities--id--toggle"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-nationalities--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-nationalities--id--toggle"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>1/0. Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="system-nationalities-POSTapi-v1-admin-system-nationalities--id--translations">Upsert translation</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-nationalities--id--translations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/nationalities/3/translations" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"lang_code\": \"ar\",
    \"name\": \"سعودي\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/nationalities/3/translations"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "lang_code": "ar",
    "name": "سعودي"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-nationalities--id--translations">
</span>
<span id="execution-results-POSTapi-v1-admin-system-nationalities--id--translations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-nationalities--id--translations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-nationalities--id--translations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-nationalities--id--translations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-nationalities--id--translations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-nationalities--id--translations" data-method="POST"
      data-path="api/v1/admin/system/nationalities/{id}/translations"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-nationalities--id--translations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-nationalities--id--translations"
                    onclick="tryItOut('POSTapi-v1-admin-system-nationalities--id--translations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-nationalities--id--translations"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-nationalities--id--translations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-nationalities--id--translations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/nationalities/{id}/translations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-nationalities--id--translations"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-nationalities--id--translations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-admin-system-nationalities--id--translations"
               value="3"
               data-component="url">
    <br>
<p>Nationality ID. Example: <code>3</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lang_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="lang_code"                data-endpoint="POSTapi-v1-admin-system-nationalities--id--translations"
               value="ar"
               data-component="body">
    <br>
<p>Language code. Example: <code>ar</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-nationalities--id--translations"
               value="سعودي"
               data-component="body">
    <br>
<p>Translated name. Example: <code>سعودي</code></p>
        </div>
        </form>

                <h1 id="system-plans">System / Plans</h1>

    

                                <h2 id="system-plans-GETapi-v1-admin-system-plans">GET api/v1/admin/system/plans</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-system-plans">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/plans?q=pro&amp;active=1&amp;billing=monthly&amp;per_page=20" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/plans"
);

const params = {
    "q": "pro",
    "active": "1",
    "billing": "monthly",
    "per_page": "20",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-plans">
            <blockquote>
            <p>Example response (200, OK):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Plans&quot;,
    &quot;data&quot;: {
        &quot;items&quot;: [
            {
                &quot;code&quot;: &quot;pro&quot;,
                &quot;name&quot;: &quot;Pro&quot;,
                &quot;base_currency&quot;: &quot;USD&quot;,
                &quot;base_price&quot;: 49,
                &quot;billing_cycle&quot;: &quot;monthly&quot;,
                &quot;active&quot;: true
            }
        ],
        &quot;pagination&quot;: {
            &quot;current_page&quot;: 1,
            &quot;per_page&quot;: 15,
            &quot;total&quot;: 1
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-system-plans" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-plans"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-plans"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-plans" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-plans">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-plans" data-method="GET"
      data-path="api/v1/admin/system/plans"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-plans', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-plans"
                    onclick="tryItOut('GETapi-v1-admin-system-plans');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-plans"
                    onclick="cancelTryOut('GETapi-v1-admin-system-plans');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-plans"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/plans</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-system-plans"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>q</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="q"                data-endpoint="GETapi-v1-admin-system-plans"
               value="pro"
               data-component="query">
    <br>
<p>Search by code or name (LIKE). Example: <code>pro</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="GETapi-v1-admin-system-plans" style="display: none">
            <input type="radio" name="active"
                   value="1"
                   data-endpoint="GETapi-v1-admin-system-plans"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-admin-system-plans" style="display: none">
            <input type="radio" name="active"
                   value="0"
                   data-endpoint="GETapi-v1-admin-system-plans"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Filter by active status. Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>billing</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="billing"                data-endpoint="GETapi-v1-admin-system-plans"
               value="monthly"
               data-component="query">
    <br>
<p>Filter by billing cycle (monthly|annual). Example: <code>monthly</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-admin-system-plans"
               value="20"
               data-component="query">
    <br>
<p>Results per page (default 15). Example: <code>20</code></p>
            </div>
                </form>

                    <h2 id="system-plans-POSTapi-v1-admin-system-plans">POST api/v1/admin/system/plans</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-plans">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/plans" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"code\": \"pro\",
    \"name\": \"Pro\",
    \"description\": \"For growing offices\",
    \"base_currency\": \"USD\",
    \"base_price\": 49.99,
    \"billing_cycle\": \"monthly\",
    \"active\": true,
    \"meta\": {
        \"color\": \"#1e88e5\"
    },
    \"features\": [
        \"consequatur\"
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/plans"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "code": "pro",
    "name": "Pro",
    "description": "For growing offices",
    "base_currency": "USD",
    "base_price": 49.99,
    "billing_cycle": "monthly",
    "active": true,
    "meta": {
        "color": "#1e88e5"
    },
    "features": [
        "consequatur"
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-plans">
            <blockquote>
            <p>Example response (201, Created):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Plan created&quot;,
    &quot;data&quot;: {
        &quot;code&quot;: &quot;pro&quot;,
        &quot;name&quot;: &quot;Pro&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-admin-system-plans" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-plans"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-plans"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-plans" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-plans">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-plans" data-method="POST"
      data-path="api/v1/admin/system/plans"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-plans', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-plans"
                    onclick="tryItOut('POSTapi-v1-admin-system-plans');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-plans"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-plans');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-plans"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/plans</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-plans"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-plans"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-admin-system-plans"
               value="pro"
               data-component="body">
    <br>
<p>Unique plan code (primary key). Example: <code>pro</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-plans"
               value="Pro"
               data-component="body">
    <br>
<p>Default (base) name (usually en). Example: <code>Pro</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-v1-admin-system-plans"
               value="For growing offices"
               data-component="body">
    <br>
<p>A short description. Example: <code>For growing offices</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>base_currency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="base_currency"                data-endpoint="POSTapi-v1-admin-system-plans"
               value="USD"
               data-component="body">
    <br>
<p>Base currency code (ISO). Example: <code>USD</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>base_price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="base_price"                data-endpoint="POSTapi-v1-admin-system-plans"
               value="49.99"
               data-component="body">
    <br>
<p>Base price in base currency. Example: <code>49.99</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>billing_cycle</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="billing_cycle"                data-endpoint="POSTapi-v1-admin-system-plans"
               value="monthly"
               data-component="body">
    <br>
<p>monthly|annual. Example: <code>monthly</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-plans" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-plans"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-plans" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-plans"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Whether the plan is active. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta"                data-endpoint="POSTapi-v1-admin-system-plans"
               value=""
               data-component="body">
    <br>
<p>Arbitrary JSON metadata (send as JSON string in form-data).</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>features</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
<br>
<p>Feature list (optional).</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>feature_key</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="features.0.feature_key"                data-endpoint="POSTapi-v1-admin-system-plans"
               value="cv.limit"
               data-component="body">
    <br>
<p>One of PlanFeatureKey values. Example: <code>cv.limit</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>limit</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="features.0.limit"                data-endpoint="POSTapi-v1-admin-system-plans"
               value="100"
               data-component="body">
    <br>
<p>Limit if applicable. Example: <code>100</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>value</code></b>&nbsp;&nbsp;
<small>mixed</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="features.0.value"                data-endpoint="POSTapi-v1-admin-system-plans"
               value="{"upload":true}"
               data-component="body">
    <br>
<p>Arbitrary value (send JSON string if multipart). Example: <code>{"upload":true}</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-plans" style="display: none">
            <input type="radio" name="features.0.active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-plans"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-plans" style="display: none">
            <input type="radio" name="features.0.active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-plans"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Whether the feature is active. Example: <code>true</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="system-plans-PUTapi-v1-admin-system-plans--code-">PUT api/v1/admin/system/plans/{code}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-system-plans--code-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/plans/pro" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"name\": \"Pro Plus\",
    \"description\": \"For advanced usage\",
    \"base_currency\": \"USD\",
    \"base_price\": 59.99,
    \"billing_cycle\": \"annual\",
    \"active\": false,
    \"meta\": {
        \"badge\": \"popular\"
    },
    \"features\": [
        \"consequatur\"
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/plans/pro"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Pro Plus",
    "description": "For advanced usage",
    "base_currency": "USD",
    "base_price": 59.99,
    "billing_cycle": "annual",
    "active": false,
    "meta": {
        "badge": "popular"
    },
    "features": [
        "consequatur"
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-plans--code-">
            <blockquote>
            <p>Example response (200, Updated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Plan updated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Plan not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v1-admin-system-plans--code-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-plans--code-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-plans--code-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-plans--code-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-plans--code-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-plans--code-" data-method="PUT"
      data-path="api/v1/admin/system/plans/{code}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-plans--code-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-plans--code-"
                    onclick="tryItOut('PUTapi-v1-admin-system-plans--code-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-plans--code-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-plans--code-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-plans--code-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/plans/{code}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-system-plans--code-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-system-plans--code-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="PUTapi-v1-admin-system-plans--code-"
               value="pro"
               data-component="url">
    <br>
<p>Plan code (primary key). Example: <code>pro</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-admin-system-plans--code-"
               value="Pro Plus"
               data-component="body">
    <br>
<p>Default name. Example: <code>Pro Plus</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-v1-admin-system-plans--code-"
               value="For advanced usage"
               data-component="body">
    <br>
<p>Description. Example: <code>For advanced usage</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>base_currency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="base_currency"                data-endpoint="PUTapi-v1-admin-system-plans--code-"
               value="USD"
               data-component="body">
    <br>
<p>Base currency code. Example: <code>USD</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>base_price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="base_price"                data-endpoint="PUTapi-v1-admin-system-plans--code-"
               value="59.99"
               data-component="body">
    <br>
<p>Base price. Example: <code>59.99</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>billing_cycle</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="billing_cycle"                data-endpoint="PUTapi-v1-admin-system-plans--code-"
               value="annual"
               data-component="body">
    <br>
<p>monthly|annual. Example: <code>annual</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-plans--code-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-plans--code-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-plans--code-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-plans--code-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active flag. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta"                data-endpoint="PUTapi-v1-admin-system-plans--code-"
               value=""
               data-component="body">
    <br>
<p>JSON metadata (send as JSON string).</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>features</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
<br>
<p>Feature list (optional, replaces existing).</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>feature_key</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="features.0.feature_key"                data-endpoint="PUTapi-v1-admin-system-plans--code-"
               value="office.users.limit"
               data-component="body">
    <br>
<p>One of PlanFeatureKey values. Example: <code>office.users.limit</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>limit</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="features.0.limit"                data-endpoint="PUTapi-v1-admin-system-plans--code-"
               value="10"
               data-component="body">
    <br>
<p>Limit if applicable. Example: <code>10</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>value</code></b>&nbsp;&nbsp;
<small>mixed</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="features.0.value"                data-endpoint="PUTapi-v1-admin-system-plans--code-"
               value="true"
               data-component="body">
    <br>
<p>Arbitrary value (send JSON string if multipart). Example: <code>true</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-plans--code-" style="display: none">
            <input type="radio" name="features.0.active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-plans--code-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-plans--code-" style="display: none">
            <input type="radio" name="features.0.active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-plans--code-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Whether the feature is active. Example: <code>true</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="system-plans-DELETEapi-v1-admin-system-plans--code-">DELETE api/v1/admin/system/plans/{code}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-plans--code-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/plans/pro" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/plans/pro"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-plans--code-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Plan deleted&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Plan not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-v1-admin-system-plans--code-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-plans--code-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-plans--code-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-plans--code-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-plans--code-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-plans--code-" data-method="DELETE"
      data-path="api/v1/admin/system/plans/{code}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-plans--code-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-plans--code-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-plans--code-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-plans--code-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-plans--code-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-plans--code-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/plans/{code}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-system-plans--code-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="DELETEapi-v1-admin-system-plans--code-"
               value="pro"
               data-component="url">
    <br>
<p>Plan code. Example: <code>pro</code></p>
            </div>
                    </form>

                    <h2 id="system-plans-POSTapi-v1-admin-system-plans--code--toggle">POST api/v1/admin/system/plans/{code}/toggle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-plans--code--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/plans/pro/toggle" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/plans/pro/toggle"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-plans--code--toggle">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Plan status updated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Plan not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-admin-system-plans--code--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-plans--code--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-plans--code--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-plans--code--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-plans--code--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-plans--code--toggle" data-method="POST"
      data-path="api/v1/admin/system/plans/{code}/toggle"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-plans--code--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-plans--code--toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-plans--code--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-plans--code--toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-plans--code--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-plans--code--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/plans/{code}/toggle</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-plans--code--toggle"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-plans--code--toggle"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-admin-system-plans--code--toggle"
               value="pro"
               data-component="url">
    <br>
<p>Plan code. Example: <code>pro</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-plans--code--toggle" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-plans--code--toggle"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-plans--code--toggle" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-plans--code--toggle"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>1 to enable, 0 to disable. Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="system-plans-POSTapi-v1-admin-system-plans--code--translations">POST api/v1/admin/system/plans/{code}/translations</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-plans--code--translations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/plans/pro/translations" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"lang_code\": \"ar\",
    \"name\": \"الخطة الاحترافية\",
    \"description\": \"مناسبة للمكاتب النامية\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/plans/pro/translations"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "lang_code": "ar",
    "name": "الخطة الاحترافية",
    "description": "مناسبة للمكاتب النامية"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-plans--code--translations">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Translation saved&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Plan not found or error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-admin-system-plans--code--translations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-plans--code--translations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-plans--code--translations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-plans--code--translations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-plans--code--translations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-plans--code--translations" data-method="POST"
      data-path="api/v1/admin/system/plans/{code}/translations"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-plans--code--translations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-plans--code--translations"
                    onclick="tryItOut('POSTapi-v1-admin-system-plans--code--translations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-plans--code--translations"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-plans--code--translations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-plans--code--translations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/plans/{code}/translations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-plans--code--translations"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-plans--code--translations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-admin-system-plans--code--translations"
               value="pro"
               data-component="url">
    <br>
<p>Plan code. Example: <code>pro</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>lang_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="lang_code"                data-endpoint="POSTapi-v1-admin-system-plans--code--translations"
               value="ar"
               data-component="body">
    <br>
<p>Language code. Example: <code>ar</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-plans--code--translations"
               value="الخطة الاحترافية"
               data-component="body">
    <br>
<p>Translated name. Example: <code>الخطة الاحترافية</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-v1-admin-system-plans--code--translations"
               value="مناسبة للمكاتب النامية"
               data-component="body">
    <br>
<p>Translated description. Example: <code>مناسبة للمكاتب النامية</code></p>
        </div>
        </form>

                    <h2 id="system-plans-POSTapi-v1-admin-system-plans--code--features">POST api/v1/admin/system/plans/{code}/features</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-plans--code--features">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/plans/pro/features" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"features\": [
        \"consequatur\"
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/plans/pro/features"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "features": [
        "consequatur"
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-plans--code--features">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Features synced&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-admin-system-plans--code--features" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-plans--code--features"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-plans--code--features"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-plans--code--features" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-plans--code--features">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-plans--code--features" data-method="POST"
      data-path="api/v1/admin/system/plans/{code}/features"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-plans--code--features', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-plans--code--features"
                    onclick="tryItOut('POSTapi-v1-admin-system-plans--code--features');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-plans--code--features"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-plans--code--features');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-plans--code--features"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/plans/{code}/features</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-plans--code--features"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-plans--code--features"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-admin-system-plans--code--features"
               value="pro"
               data-component="url">
    <br>
<p>Plan code. Example: <code>pro</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>features</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
<br>
<p>Features array.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>feature_key</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="features.0.feature_key"                data-endpoint="POSTapi-v1-admin-system-plans--code--features"
               value="cv.limit"
               data-component="body">
    <br>
<p>Feature key. Example: <code>cv.limit</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>limit</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="features.0.limit"                data-endpoint="POSTapi-v1-admin-system-plans--code--features"
               value="100"
               data-component="body">
    <br>
<p>Limit (if applicable). Example: <code>100</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>value</code></b>&nbsp;&nbsp;
<small>mixed</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="features.0.value"                data-endpoint="POSTapi-v1-admin-system-plans--code--features"
               value="{"upload":true}"
               data-component="body">
    <br>
<p>Arbitrary value (JSON-serializable). Example: <code>{"upload":true}</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-plans--code--features" style="display: none">
            <input type="radio" name="features.0.active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-plans--code--features"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-plans--code--features" style="display: none">
            <input type="radio" name="features.0.active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-plans--code--features"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Whether the feature is active. Example: <code>true</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                <h1 id="system-promotions">System / Promotions</h1>

    

                                <h2 id="system-promotions-GETapi-v1-admin-system-promotions">GET api/v1/admin/system/promotions</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-system-promotions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/promotions?plan_code=pro&amp;active=1&amp;per_page=20" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/promotions"
);

const params = {
    "plan_code": "pro",
    "active": "1",
    "per_page": "20",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-promotions">
            <blockquote>
            <p>Example response (200, OK):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Promotions&quot;,
    &quot;data&quot;: {
        &quot;items&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;New Year&quot;,
                &quot;type&quot;: &quot;percent&quot;,
                &quot;amount&quot;: 20,
                &quot;active&quot;: true
            }
        ],
        &quot;pagination&quot;: {
            &quot;current_page&quot;: 1,
            &quot;per_page&quot;: 15,
            &quot;total&quot;: 1
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-system-promotions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-promotions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-promotions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-promotions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-promotions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-promotions" data-method="GET"
      data-path="api/v1/admin/system/promotions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-promotions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-promotions"
                    onclick="tryItOut('GETapi-v1-admin-system-promotions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-promotions"
                    onclick="cancelTryOut('GETapi-v1-admin-system-promotions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-promotions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/promotions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-system-promotions"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>plan_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="plan_code"                data-endpoint="GETapi-v1-admin-system-promotions"
               value="pro"
               data-component="query">
    <br>
<p>Filter by plan code. Example: <code>pro</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="GETapi-v1-admin-system-promotions" style="display: none">
            <input type="radio" name="active"
                   value="1"
                   data-endpoint="GETapi-v1-admin-system-promotions"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-admin-system-promotions" style="display: none">
            <input type="radio" name="active"
                   value="0"
                   data-endpoint="GETapi-v1-admin-system-promotions"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Filter by active status. Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-admin-system-promotions"
               value="20"
               data-component="query">
    <br>
<p>Results per page (default 15). Example: <code>20</code></p>
            </div>
                </form>

                    <h2 id="system-promotions-POSTapi-v1-admin-system-promotions">POST api/v1/admin/system/promotions</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-promotions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/promotions" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"name\": \"New Year 20%\",
    \"plan_code\": \"pro\",
    \"type\": \"percent\",
    \"amount\": 20,
    \"currency_code\": \"USD\",
    \"starts_at\": \"2025-01-01 00:00:00\",
    \"ends_at\": \"2025-01-31 23:59:59\",
    \"auto_apply\": true,
    \"active\": true,
    \"meta\": {
        \"channel\": \"web\"
    }
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/promotions"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "New Year 20%",
    "plan_code": "pro",
    "type": "percent",
    "amount": 20,
    "currency_code": "USD",
    "starts_at": "2025-01-01 00:00:00",
    "ends_at": "2025-01-31 23:59:59",
    "auto_apply": true,
    "active": true,
    "meta": {
        "channel": "web"
    }
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-promotions">
            <blockquote>
            <p>Example response (201, Created):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Promotion created&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 10,
        &quot;name&quot;: &quot;New Year 20%&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-admin-system-promotions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-promotions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-promotions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-promotions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-promotions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-promotions" data-method="POST"
      data-path="api/v1/admin/system/promotions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-promotions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-promotions"
                    onclick="tryItOut('POSTapi-v1-admin-system-promotions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-promotions"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-promotions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-promotions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/promotions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-promotions"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-promotions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-promotions"
               value="New Year 20%"
               data-component="body">
    <br>
<p>Promotion name. Example: <code>New Year 20%</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>plan_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="plan_code"                data-endpoint="POSTapi-v1-admin-system-promotions"
               value="pro"
               data-component="body">
    <br>
<p>Plan code (optional for global promo). Example: <code>pro</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-v1-admin-system-promotions"
               value="percent"
               data-component="body">
    <br>
<p>Discount type: percent|fixed. Example: <code>percent</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount"                data-endpoint="POSTapi-v1-admin-system-promotions"
               value="20"
               data-component="body">
    <br>
<p>Discount amount (if percent: 20 = 20%). Example: <code>20</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="currency_code"                data-endpoint="POSTapi-v1-admin-system-promotions"
               value="USD"
               data-component="body">
    <br>
<p>Currency (only required for fixed). Example: <code>USD</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>starts_at</code></b>&nbsp;&nbsp;
<small>datetime</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="starts_at"                data-endpoint="POSTapi-v1-admin-system-promotions"
               value="2025-01-01 00:00:00"
               data-component="body">
    <br>
<p>Start date (Y-m-d H:i:s). Example: <code>2025-01-01 00:00:00</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ends_at</code></b>&nbsp;&nbsp;
<small>datetime</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="ends_at"                data-endpoint="POSTapi-v1-admin-system-promotions"
               value="2025-01-31 23:59:59"
               data-component="body">
    <br>
<p>End date (Y-m-d H:i:s). Must be after starts_at. Example: <code>2025-01-31 23:59:59</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>auto_apply</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-promotions" style="display: none">
            <input type="radio" name="auto_apply"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-promotions"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-promotions" style="display: none">
            <input type="radio" name="auto_apply"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-promotions"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Automatically apply when eligible. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-promotions" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-promotions"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-promotions" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-promotions"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Whether promo is active. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta"                data-endpoint="POSTapi-v1-admin-system-promotions"
               value=""
               data-component="body">
    <br>
<p>Arbitrary JSON metadata (send JSON string in form-data).</p>
        </div>
        </form>

                    <h2 id="system-promotions-PUTapi-v1-admin-system-promotions--id-">PUT api/v1/admin/system/promotions/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-system-promotions--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/promotions/10" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"name\": \"Spring 15%\",
    \"plan_code\": \"pro\",
    \"type\": \"fixed\",
    \"amount\": 25,
    \"currency_code\": \"SAR\",
    \"starts_at\": \"2025-03-01 00:00:00\",
    \"ends_at\": \"2025-03-31 23:59:59\",
    \"auto_apply\": false,
    \"active\": true,
    \"meta\": {
        \"segment\": \"returning\"
    }
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/promotions/10"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Spring 15%",
    "plan_code": "pro",
    "type": "fixed",
    "amount": 25,
    "currency_code": "SAR",
    "starts_at": "2025-03-01 00:00:00",
    "ends_at": "2025-03-31 23:59:59",
    "auto_apply": false,
    "active": true,
    "meta": {
        "segment": "returning"
    }
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-promotions--id-">
            <blockquote>
            <p>Example response (200, Updated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Promotion updated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v1-admin-system-promotions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-promotions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-promotions--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-promotions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-promotions--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-promotions--id-" data-method="PUT"
      data-path="api/v1/admin/system/promotions/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-promotions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-promotions--id-"
                    onclick="tryItOut('PUTapi-v1-admin-system-promotions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-promotions--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-promotions--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-promotions--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/promotions/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-system-promotions--id-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-system-promotions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-admin-system-promotions--id-"
               value="10"
               data-component="url">
    <br>
<p>Promotion ID. Example: <code>10</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-admin-system-promotions--id-"
               value="Spring 15%"
               data-component="body">
    <br>
<p>Promotion name. Example: <code>Spring 15%</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>plan_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="plan_code"                data-endpoint="PUTapi-v1-admin-system-promotions--id-"
               value="pro"
               data-component="body">
    <br>
<p>Plan code or null. Example: <code>pro</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="PUTapi-v1-admin-system-promotions--id-"
               value="fixed"
               data-component="body">
    <br>
<p>percent|fixed. Example: <code>fixed</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount"                data-endpoint="PUTapi-v1-admin-system-promotions--id-"
               value="25"
               data-component="body">
    <br>
<p>Discount amount. Example: <code>25</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="currency_code"                data-endpoint="PUTapi-v1-admin-system-promotions--id-"
               value="SAR"
               data-component="body">
    <br>
<p>Currency for fixed discounts. Example: <code>SAR</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>starts_at</code></b>&nbsp;&nbsp;
<small>datetime</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="starts_at"                data-endpoint="PUTapi-v1-admin-system-promotions--id-"
               value="2025-03-01 00:00:00"
               data-component="body">
    <br>
<p>Start date (Y-m-d H:i:s). Example: <code>2025-03-01 00:00:00</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ends_at</code></b>&nbsp;&nbsp;
<small>datetime</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="ends_at"                data-endpoint="PUTapi-v1-admin-system-promotions--id-"
               value="2025-03-31 23:59:59"
               data-component="body">
    <br>
<p>End date (Y-m-d H:i:s), after starts_at. Example: <code>2025-03-31 23:59:59</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>auto_apply</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-promotions--id-" style="display: none">
            <input type="radio" name="auto_apply"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-promotions--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-promotions--id-" style="display: none">
            <input type="radio" name="auto_apply"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-promotions--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Auto apply flag. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-promotions--id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-promotions--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-promotions--id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-promotions--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active flag. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="meta"                data-endpoint="PUTapi-v1-admin-system-promotions--id-"
               value=""
               data-component="body">
    <br>
<p>Arbitrary JSON metadata (send JSON string).</p>
        </div>
        </form>

                    <h2 id="system-promotions-DELETEapi-v1-admin-system-promotions--id-">DELETE api/v1/admin/system/promotions/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-promotions--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/promotions/10" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/promotions/10"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-promotions--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Promotion deleted&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-v1-admin-system-promotions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-promotions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-promotions--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-promotions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-promotions--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-promotions--id-" data-method="DELETE"
      data-path="api/v1/admin/system/promotions/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-promotions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-promotions--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-promotions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-promotions--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-promotions--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-promotions--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/promotions/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-system-promotions--id-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-admin-system-promotions--id-"
               value="10"
               data-component="url">
    <br>
<p>Promotion ID. Example: <code>10</code></p>
            </div>
                    </form>

                    <h2 id="system-promotions-POSTapi-v1-admin-system-promotions--id--toggle">POST api/v1/admin/system/promotions/{id}/toggle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-promotions--id--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/promotions/10/toggle" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"active\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/promotions/10/toggle"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "active": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-promotions--id--toggle">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Promotion status updated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-admin-system-promotions--id--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-promotions--id--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-promotions--id--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-promotions--id--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-promotions--id--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-promotions--id--toggle" data-method="POST"
      data-path="api/v1/admin/system/promotions/{id}/toggle"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-promotions--id--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-promotions--id--toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-promotions--id--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-promotions--id--toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-promotions--id--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-promotions--id--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/promotions/{id}/toggle</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-promotions--id--toggle"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-promotions--id--toggle"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-admin-system-promotions--id--toggle"
               value="10"
               data-component="url">
    <br>
<p>Promotion ID. Example: <code>10</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-promotions--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-promotions--id--toggle"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-promotions--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-promotions--id--toggle"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>1 to enable, 0 to disable. Example: <code>false</code></p>
        </div>
        </form>

                <h1 id="system-roles">System / Roles</h1>

    

                                <h2 id="system-roles-GETapi-v1-admin-system-roles">GET api/v1/admin/system/roles</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-system-roles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/roles?name=Admin&amp;slug=admin&amp;guard=api&amp;active=1&amp;from=2025-01-01&amp;to=2025-12-31&amp;per_page=15" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/roles"
);

const params = {
    "name": "Admin",
    "slug": "admin",
    "guard": "api",
    "active": "1",
    "from": "2025-01-01",
    "to": "2025-12-31",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-roles">
    </span>
<span id="execution-results-GETapi-v1-admin-system-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-roles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-roles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-roles" data-method="GET"
      data-path="api/v1/admin/system/roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-roles"
                    onclick="tryItOut('GETapi-v1-admin-system-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-roles"
                    onclick="cancelTryOut('GETapi-v1-admin-system-roles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-roles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/roles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-system-roles"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="GETapi-v1-admin-system-roles"
               value="Admin"
               data-component="query">
    <br>
<p>Example: <code>Admin</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="GETapi-v1-admin-system-roles"
               value="admin"
               data-component="query">
    <br>
<p>Example: <code>admin</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>guard</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="guard"                data-endpoint="GETapi-v1-admin-system-roles"
               value="api"
               data-component="query">
    <br>
<p>Example: <code>api</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="GETapi-v1-admin-system-roles" style="display: none">
            <input type="radio" name="active"
                   value="1"
                   data-endpoint="GETapi-v1-admin-system-roles"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-admin-system-roles" style="display: none">
            <input type="radio" name="active"
                   value="0"
                   data-endpoint="GETapi-v1-admin-system-roles"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="from"                data-endpoint="GETapi-v1-admin-system-roles"
               value="2025-01-01"
               data-component="query">
    <br>
<p>date Example: <code>2025-01-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="to"                data-endpoint="GETapi-v1-admin-system-roles"
               value="2025-12-31"
               data-component="query">
    <br>
<p>date Example: <code>2025-12-31</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-admin-system-roles"
               value="15"
               data-component="query">
    <br>
<p>Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="system-roles-POSTapi-v1-admin-system-roles">POST api/v1/admin/system/roles</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-roles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/roles" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"name\": \"Admin\",
    \"slug\": \"admin\",
    \"guard\": \"api\",
    \"active\": true,
    \"permissions\": [
        1,
        3,
        5
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/roles"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Admin",
    "slug": "admin",
    "guard": "api",
    "active": true,
    "permissions": [
        1,
        3,
        5
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-roles">
</span>
<span id="execution-results-POSTapi-v1-admin-system-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-roles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-roles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-roles" data-method="POST"
      data-path="api/v1/admin/system/roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-roles"
                    onclick="tryItOut('POSTapi-v1-admin-system-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-roles"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-roles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-roles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/roles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-roles"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-roles"
               value="Admin"
               data-component="body">
    <br>
<p>Role display name. Example: <code>Admin</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="POSTapi-v1-admin-system-roles"
               value="admin"
               data-component="body">
    <br>
<p>Unique slug per guard. Example: <code>admin</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>guard</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="guard"                data-endpoint="POSTapi-v1-admin-system-roles"
               value="api"
               data-component="body">
    <br>
<p>Auth guard. Example: <code>api</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-roles" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-roles"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-roles" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-roles"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active flag. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>permissions</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="permissions[0]"                data-endpoint="POSTapi-v1-admin-system-roles"
               data-component="body">
        <input type="number" style="display: none"
               name="permissions[1]"                data-endpoint="POSTapi-v1-admin-system-roles"
               data-component="body">
    <br>
<p>List of permission IDs to attach.</p>
        </div>
        </form>

                    <h2 id="system-roles-PUTapi-v1-admin-system-roles--id-">PUT api/v1/admin/system/roles/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-system-roles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/roles/4" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"name\": \"Manager\",
    \"slug\": \"manager\",
    \"guard\": \"api\",
    \"active\": false,
    \"permissions\": [
        2,
        6
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/roles/4"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Manager",
    "slug": "manager",
    "guard": "api",
    "active": false,
    "permissions": [
        2,
        6
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-roles--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-system-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-roles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-roles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-roles--id-" data-method="PUT"
      data-path="api/v1/admin/system/roles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-roles--id-"
                    onclick="tryItOut('PUTapi-v1-admin-system-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-roles--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-roles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-roles--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/roles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-system-roles--id-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-system-roles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-admin-system-roles--id-"
               value="4"
               data-component="url">
    <br>
<p>Role ID. Example: <code>4</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-admin-system-roles--id-"
               value="Manager"
               data-component="body">
    <br>
<p>Role display name. Example: <code>Manager</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="PUTapi-v1-admin-system-roles--id-"
               value="manager"
               data-component="body">
    <br>
<p>Unique slug per guard. Example: <code>manager</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>guard</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="guard"                data-endpoint="PUTapi-v1-admin-system-roles--id-"
               value="api"
               data-component="body">
    <br>
<p>Auth guard. Example: <code>api</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-roles--id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-roles--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-roles--id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-roles--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active flag. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>permissions</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="permissions[0]"                data-endpoint="PUTapi-v1-admin-system-roles--id-"
               data-component="body">
        <input type="number" style="display: none"
               name="permissions[1]"                data-endpoint="PUTapi-v1-admin-system-roles--id-"
               data-component="body">
    <br>
<p>Replace role permissions with IDs.</p>
        </div>
        </form>

                    <h2 id="system-roles-DELETEapi-v1-admin-system-roles--id-">DELETE api/v1/admin/system/roles/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-roles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/roles/4" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/roles/4"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-roles--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-system-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-roles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-roles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-roles--id-" data-method="DELETE"
      data-path="api/v1/admin/system/roles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-roles--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-roles--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-roles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-roles--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/roles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-system-roles--id-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-admin-system-roles--id-"
               value="4"
               data-component="url">
    <br>
<p>Role ID. Example: <code>4</code></p>
            </div>
                    </form>

                    <h2 id="system-roles-POSTapi-v1-admin-system-roles--id--toggle">POST api/v1/admin/system/roles/{id}/toggle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-roles--id--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/roles/4/toggle" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/roles/4/toggle"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-roles--id--toggle">
</span>
<span id="execution-results-POSTapi-v1-admin-system-roles--id--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-roles--id--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-roles--id--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-roles--id--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-roles--id--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-roles--id--toggle" data-method="POST"
      data-path="api/v1/admin/system/roles/{id}/toggle"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-roles--id--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-roles--id--toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-roles--id--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-roles--id--toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-roles--id--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-roles--id--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/roles/{id}/toggle</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-roles--id--toggle"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-roles--id--toggle"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-admin-system-roles--id--toggle"
               value="4"
               data-component="url">
    <br>
<p>Role ID. Example: <code>4</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-roles--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-roles--id--toggle"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-roles--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-roles--id--toggle"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>1/0. Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="system-roles-POSTapi-v1-admin-system-roles--id--sync-permissions">POST api/v1/admin/system/roles/{id}/sync-permissions</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-roles--id--sync-permissions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/roles/4/sync-permissions" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"permissions\": [
        1,
        2,
        3
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/roles/4/sync-permissions"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "permissions": [
        1,
        2,
        3
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-roles--id--sync-permissions">
</span>
<span id="execution-results-POSTapi-v1-admin-system-roles--id--sync-permissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-roles--id--sync-permissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-roles--id--sync-permissions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-roles--id--sync-permissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-roles--id--sync-permissions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-roles--id--sync-permissions" data-method="POST"
      data-path="api/v1/admin/system/roles/{id}/sync-permissions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-roles--id--sync-permissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-roles--id--sync-permissions"
                    onclick="tryItOut('POSTapi-v1-admin-system-roles--id--sync-permissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-roles--id--sync-permissions"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-roles--id--sync-permissions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-roles--id--sync-permissions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/roles/{id}/sync-permissions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-roles--id--sync-permissions"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-roles--id--sync-permissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-admin-system-roles--id--sync-permissions"
               value="4"
               data-component="url">
    <br>
<p>Role ID. Example: <code>4</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>permissions</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="permissions[0]"                data-endpoint="POSTapi-v1-admin-system-roles--id--sync-permissions"
               data-component="body">
        <input type="number" style="display: none"
               name="permissions[1]"                data-endpoint="POSTapi-v1-admin-system-roles--id--sync-permissions"
               data-component="body">
    <br>
<p>Permission IDs.</p>
        </div>
        </form>

                    <h2 id="system-roles-GETapi-v1-admin-system-roles--id-">GET api/v1/admin/system/roles/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-system-roles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/roles/4" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/roles/4"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-roles--id-">
    </span>
<span id="execution-results-GETapi-v1-admin-system-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-roles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-roles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-roles--id-" data-method="GET"
      data-path="api/v1/admin/system/roles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-roles--id-"
                    onclick="tryItOut('GETapi-v1-admin-system-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-roles--id-"
                    onclick="cancelTryOut('GETapi-v1-admin-system-roles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-roles--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/roles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-system-roles--id-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-admin-system-roles--id-"
               value="4"
               data-component="url">
    <br>
<p>Role ID. Example: <code>4</code></p>
            </div>
                    </form>

    <h3>Response</h3>
    <h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
    <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
<br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
<br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
<br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>guard</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
<br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
<br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>permissions</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
<br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>users_count</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
<br>

        </div>
                    <h1 id="system-users">System / Users</h1>

    

                                <h2 id="system-users-GETapi-v1-admin-system-users">GET api/v1/admin/system/users</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-system-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://mery.alemtayaz.com/api/v1/admin/system/users?name=Ahmed&amp;email=admin%40example.com&amp;active=1&amp;guard=api&amp;role=admin&amp;from=2025-01-01&amp;to=2025-12-31&amp;per_page=15" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/users"
);

const params = {
    "name": "Ahmed",
    "email": "admin@example.com",
    "active": "1",
    "guard": "api",
    "role": "admin",
    "from": "2025-01-01",
    "to": "2025-12-31",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-system-users">
    </span>
<span id="execution-results-GETapi-v1-admin-system-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-system-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-system-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-system-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-system-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-system-users" data-method="GET"
      data-path="api/v1/admin/system/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-system-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-system-users"
                    onclick="tryItOut('GETapi-v1-admin-system-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-system-users"
                    onclick="cancelTryOut('GETapi-v1-admin-system-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-system-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/system/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-system-users"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="GETapi-v1-admin-system-users"
               value="Ahmed"
               data-component="query">
    <br>
<p>Example: <code>Ahmed</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="GETapi-v1-admin-system-users"
               value="admin@example.com"
               data-component="query">
    <br>
<p>Example: <code>admin@example.com</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="GETapi-v1-admin-system-users" style="display: none">
            <input type="radio" name="active"
                   value="1"
                   data-endpoint="GETapi-v1-admin-system-users"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-admin-system-users" style="display: none">
            <input type="radio" name="active"
                   value="0"
                   data-endpoint="GETapi-v1-admin-system-users"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>guard</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="guard"                data-endpoint="GETapi-v1-admin-system-users"
               value="api"
               data-component="query">
    <br>
<p>Example: <code>api</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="role"                data-endpoint="GETapi-v1-admin-system-users"
               value="admin"
               data-component="query">
    <br>
<p>Role slug/name/id. Example: <code>admin</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="from"                data-endpoint="GETapi-v1-admin-system-users"
               value="2025-01-01"
               data-component="query">
    <br>
<p>date Example: <code>2025-01-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="to"                data-endpoint="GETapi-v1-admin-system-users"
               value="2025-12-31"
               data-component="query">
    <br>
<p>date Example: <code>2025-12-31</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-admin-system-users"
               value="15"
               data-component="query">
    <br>
<p>Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="system-users-POSTapi-v1-admin-system-users">POST api/v1/admin/system/users</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/users" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"name\": \"Ahmed Ali\",
    \"email\": \"admin@example.com\",
    \"phone\": \"+201001234567\",
    \"password\": \"secret123\",
    \"guard\": \"api\",
    \"active\": false,
    \"roles\": [
        17
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/users"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Ahmed Ali",
    "email": "admin@example.com",
    "phone": "+201001234567",
    "password": "secret123",
    "guard": "api",
    "active": false,
    "roles": [
        17
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-users">
</span>
<span id="execution-results-POSTapi-v1-admin-system-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-users" data-method="POST"
      data-path="api/v1/admin/system/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-users"
                    onclick="tryItOut('POSTapi-v1-admin-system-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-users"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-users"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-admin-system-users"
               value="Ahmed Ali"
               data-component="body">
    <br>
<p>Full name. Must not be greater than 191 characters. Example: <code>Ahmed Ali</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-admin-system-users"
               value="admin@example.com"
               data-component="body">
    <br>
<p>Unique email. Must be a valid email address. Must not be greater than 191 characters. Example: <code>admin@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-v1-admin-system-users"
               value="+201001234567"
               data-component="body">
    <br>
<p>Optional phone. Must not be greater than 30 characters. Example: <code>+201001234567</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-admin-system-users"
               value="secret123"
               data-component="body">
    <br>
<p>Password (min 6). Must be at least 6 characters. Must not be greater than 191 characters. Example: <code>secret123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>guard</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="guard"                data-endpoint="POSTapi-v1-admin-system-users"
               value="api"
               data-component="body">
    <br>
<p>Auth guard. Must not be greater than 32 characters. Example: <code>api</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-users" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-users"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-users" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-users"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active flag. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>roles</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="roles[0]"                data-endpoint="POSTapi-v1-admin-system-users"
               data-component="body">
        <input type="number" style="display: none"
               name="roles[1]"                data-endpoint="POSTapi-v1-admin-system-users"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the system.roles table.</p>
        </div>
        </form>

                    <h2 id="system-users-PUTapi-v1-admin-system-users--id-">PUT api/v1/admin/system/users/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-system-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://mery.alemtayaz.com/api/v1/admin/system/users/consequatur" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"name\": \"Ahmed Updated\",
    \"email\": \"admin2@example.com\",
    \"phone\": \"+201111111111\",
    \"password\": \"newpass123\",
    \"guard\": \"api\",
    \"active\": false,
    \"roles\": [
        17
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/users/consequatur"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Ahmed Updated",
    "email": "admin2@example.com",
    "phone": "+201111111111",
    "password": "newpass123",
    "guard": "api",
    "active": false,
    "roles": [
        17
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-system-users--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-system-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-system-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-system-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-system-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-system-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-system-users--id-" data-method="PUT"
      data-path="api/v1/admin/system/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-system-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-system-users--id-"
                    onclick="tryItOut('PUTapi-v1-admin-system-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-system-users--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-system-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-system-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/system/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-system-users--id-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-system-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-v1-admin-system-users--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-admin-system-users--id-"
               value="Ahmed Updated"
               data-component="body">
    <br>
<p>Full name. Must not be greater than 191 characters. Example: <code>Ahmed Updated</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-v1-admin-system-users--id-"
               value="admin2@example.com"
               data-component="body">
    <br>
<p>Unique email. Must be a valid email address. Must not be greater than 191 characters. Example: <code>admin2@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-v1-admin-system-users--id-"
               value="+201111111111"
               data-component="body">
    <br>
<p>Phone. Must not be greater than 30 characters. Example: <code>+201111111111</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="PUTapi-v1-admin-system-users--id-"
               value="newpass123"
               data-component="body">
    <br>
<p>New password (optional). Must be at least 6 characters. Must not be greater than 191 characters. Example: <code>newpass123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>guard</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="guard"                data-endpoint="PUTapi-v1-admin-system-users--id-"
               value="api"
               data-component="body">
    <br>
<p>Auth guard. Must not be greater than 32 characters. Example: <code>api</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-v1-admin-system-users--id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-system-users--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-system-users--id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-system-users--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active flag. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>roles</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="roles[0]"                data-endpoint="PUTapi-v1-admin-system-users--id-"
               data-component="body">
        <input type="number" style="display: none"
               name="roles[1]"                data-endpoint="PUTapi-v1-admin-system-users--id-"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the system.roles table.</p>
        </div>
        </form>

                    <h2 id="system-users-DELETEapi-v1-admin-system-users--id-">DELETE api/v1/admin/system/users/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-system-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://mery.alemtayaz.com/api/v1/admin/system/users/consequatur" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/users/consequatur"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-system-users--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-system-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-system-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-system-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-system-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-system-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-system-users--id-" data-method="DELETE"
      data-path="api/v1/admin/system/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-system-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-system-users--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-system-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-system-users--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-system-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-system-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/system/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-system-users--id-"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-admin-system-users--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="system-users-POSTapi-v1-admin-system-users--id--toggle">POST api/v1/admin/system/users/{id}/toggle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-users--id--toggle">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/users/consequatur/toggle" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/users/consequatur/toggle"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-users--id--toggle">
</span>
<span id="execution-results-POSTapi-v1-admin-system-users--id--toggle" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-users--id--toggle"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-users--id--toggle"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-users--id--toggle" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-users--id--toggle">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-users--id--toggle" data-method="POST"
      data-path="api/v1/admin/system/users/{id}/toggle"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-users--id--toggle', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-users--id--toggle"
                    onclick="tryItOut('POSTapi-v1-admin-system-users--id--toggle');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-users--id--toggle"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-users--id--toggle');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-users--id--toggle"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/users/{id}/toggle</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-users--id--toggle"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-users--id--toggle"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-v1-admin-system-users--id--toggle"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-system-users--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-system-users--id--toggle"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-system-users--id--toggle" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-system-users--id--toggle"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="system-users-POSTapi-v1-admin-system-users--id--sync-roles">POST api/v1/admin/system/users/{id}/sync-roles</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-system-users--id--sync-roles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://mery.alemtayaz.com/api/v1/admin/system/users/consequatur/sync-roles" \
    --header "Authorization: Bearer 3V5EgbkvZcDPa166h8fd4ae" \
    --header "Content-Type: application/json" \
    --data "{
    \"roles\": [
        1,
        2
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://mery.alemtayaz.com/api/v1/admin/system/users/consequatur/sync-roles"
);

const headers = {
    "Authorization": "Bearer 3V5EgbkvZcDPa166h8fd4ae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "roles": [
        1,
        2
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-system-users--id--sync-roles">
</span>
<span id="execution-results-POSTapi-v1-admin-system-users--id--sync-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-system-users--id--sync-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-system-users--id--sync-roles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-system-users--id--sync-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-system-users--id--sync-roles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-system-users--id--sync-roles" data-method="POST"
      data-path="api/v1/admin/system/users/{id}/sync-roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-system-users--id--sync-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-system-users--id--sync-roles"
                    onclick="tryItOut('POSTapi-v1-admin-system-users--id--sync-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-system-users--id--sync-roles"
                    onclick="cancelTryOut('POSTapi-v1-admin-system-users--id--sync-roles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-system-users--id--sync-roles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/system/users/{id}/sync-roles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-system-users--id--sync-roles"
               value="Bearer 3V5EgbkvZcDPa166h8fd4ae"
               data-component="header">
    <br>
<p>Example: <code>Bearer 3V5EgbkvZcDPa166h8fd4ae</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-system-users--id--sync-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-v1-admin-system-users--id--sync-roles"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>roles</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="roles[0]"                data-endpoint="POSTapi-v1-admin-system-users--id--sync-roles"
               data-component="body">
        <input type="text" style="display: none"
               name="roles[1]"                data-endpoint="POSTapi-v1-admin-system-users--id--sync-roles"
               data-component="body">
    <br>
<p>List of role IDs.</p>
        </div>
        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
