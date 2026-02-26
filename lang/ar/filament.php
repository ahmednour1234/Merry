<?php

return [
    'actions' => [
        'attach' => 'إرفاق',
        'add' => 'إضافة',
        'bulk_attach' => 'إرفاق',
        'cancel' => 'إلغاء',
        'clone' => 'نسخ',
        'close' => 'إغلاق',
        'create' => 'إنشاء',
        'delete' => 'حذف',
        'detach' => 'فصل',
        'dissociate' => 'إلغاء الارتباط',
        'edit' => 'تعديل',
        'force_delete' => 'حذف نهائي',
        'modal' => [
            'confirm' => 'تأكيد',
            'cancel' => 'إلغاء',
            'submit' => 'إرسال',
        ],
        'replicate' => 'تكرار',
        'restore' => 'استعادة',
        'save' => 'حفظ',
        'view' => 'عرض',
    ],
    'empty' => [
        'heading' => 'لا توجد سجلات',
        'description' => 'قم بإنشاء :model للبدء.',
    ],
    'filters' => [
        'actions' => [
            'apply' => 'تطبيق',
            'reset' => 'إعادة تعيين',
        ],
        'heading' => 'المرشحات',
        'indicator' => 'المرشحات النشطة',
        'multi_select' => [
            'placeholder' => 'الكل',
        ],
        'select' => [
            'placeholder' => 'الكل',
        ],
        'trashed' => [
            'label' => 'السجلات المحذوفة',
            'only_trashed' => 'المحذوفة فقط',
            'with_trashed' => 'مع المحذوفة',
            'without_trashed' => 'بدون المحذوفة',
        ],
    ],
    'form' => [
        'actions' => [
            'create' => 'إنشاء',
            'create_another' => 'إنشاء وإضافة آخر',
            'save' => 'حفظ',
            'save_another' => 'حفظ وإضافة آخر',
        ],
        'tab' => [
            'items' => [
                'preview' => 'معاينة',
                'edit' => 'تعديل',
            ],
        ],
    ],
    'layout' => [
        'actions' => [
            'sidebar' => [
                'collapse' => 'طي الشريط الجانبي',
                'expand' => 'توسيع الشريط الجانبي',
            ],
        ],
        'notifications' => [
            'mark_all_as_read' => 'تحديد الكل كمقروء',
            'no_notifications' => 'لا توجد إشعارات',
        ],
        'user_menu' => [
            'logout' => 'تسجيل الخروج',
            'profile' => 'الملف الشخصي',
        ],
    ],
    'modals' => [
        'close' => 'إغلاق',
        'submit' => 'إرسال',
    ],
    'navigation' => [
        'collapse' => 'طي القائمة',
        'expand' => 'توسيع القائمة',
        'group' => 'المجموعة',
        'groups' => [
            'settings' => 'الإعدادات',
            'system' => 'النظام',
            'المحتوى' => 'المحتوى',
            'الإدارة' => 'الإدارة',
        ],
        'label' => 'القائمة',
        'single' => 'الصفحة',
    ],
    'pages' => [
        'actions' => [
            'open_documentation' => 'فتح التوثيق',
            'preview_rendered' => 'معاينة',
        ],
        'auth' => [
            'login' => [
                'heading' => 'تسجيل الدخول',
                'actions' => [
                    'register' => 'إنشاء حساب',
                    'remember' => 'تذكرني',
                    'request_password_reset' => 'نسيت كلمة المرور؟',
                ],
                'form' => [
                    'email' => 'البريد الإلكتروني',
                    'email_validation_error' => 'يرجى إدخال بريد إلكتروني صحيح',
                    'password' => 'كلمة المرور',
                    'password_validation_error' => 'كلمة المرور مطلوبة',
                    'remember' => 'تذكرني',
                ],
                'messages' => [
                    'failed' => 'بيانات الاعتماد هذه غير متطابقة مع البيانات المسجلة لدينا.',
                ],
                'notifications' => [
                    'throttled' => [
                        'title' => 'عدد كبير جداً من محاولات الدخول',
                        'body' => 'يرجى المحاولة مرة أخرى بعد :seconds ثانية.',
                    ],
                ],
            ],
        ],
    ],
    'pagination' => [
        'label' => 'التنقل بين الصفحات',
        'overview' => 'عرض :first إلى :last من :total نتائج',
        'fields' => [
            'records_per_page' => [
                'label' => 'لكل صفحة',
                'options' => [
                    'all' => 'الكل',
                ],
            ],
        ],
        'actions' => [
            'first' => 'الأولى',
            'go_to_page' => 'الانتقال إلى صفحة :page',
            'last' => 'الأخيرة',
            'next' => 'التالي',
            'previous' => 'السابق',
        ],
    ],
    'resources' => [
        'actions' => [
            'create' => 'إنشاء :label',
            'delete' => 'حذف',
            'edit' => 'تعديل :label',
            'force_delete' => 'حذف نهائي',
            'replicate' => 'تكرار :label',
            'restore' => 'استعادة',
            'view' => 'عرض :label',
        ],
        'empty' => [
            'heading' => 'لا توجد :label',
            'description' => 'قم بإنشاء :label للبدء.',
        ],
        'fields' => [
            'created_at' => 'تاريخ الإنشاء',
            'deleted_at' => 'تاريخ الحذف',
            'updated_at' => 'تاريخ التحديث',
        ],
        'notifications' => [
            'created' => 'تم إنشاء :label بنجاح',
            'deleted' => 'تم حذف :label بنجاح',
            'force_deleted' => 'تم حذف :label نهائياً',
            'replicated' => 'تم تكرار :label بنجاح',
            'restored' => 'تم استعادة :label بنجاح',
            'updated' => 'تم تحديث :label بنجاح',
        ],
        'title' => [
            'create' => 'إنشاء :label',
            'edit' => 'تعديل :label',
            'list' => ':label',
            'view' => 'عرض :label',
        ],
    ],
    'tables' => [
        'actions' => [
            'attach' => 'إرفاق',
            'detach' => 'فصل',
            'edit' => 'تعديل',
            'replicate' => 'تكرار',
            'delete' => 'حذف',
            'force_delete' => 'حذف نهائي',
            'restore' => 'استعادة',
        ],
        'bulk_actions' => [
            'attach' => 'إرفاق',
            'delete' => 'حذف',
            'detach' => 'فصل',
            'force_delete' => 'حذف نهائي',
            'restore' => 'استعادة',
        ],
        'columns' => [
            'created_at' => 'تاريخ الإنشاء',
            'deleted_at' => 'تاريخ الحذف',
            'updated_at' => 'تاريخ التحديث',
        ],
        'empty' => [
            'heading' => 'لا توجد سجلات',
            'description' => 'قم بإنشاء :model للبدء.',
        ],
        'filters' => [
            'actions' => [
                'apply' => 'تطبيق',
                'remove' => 'إزالة',
                'remove_all' => 'إزالة الكل',
                'reset' => 'إعادة تعيين',
            ],
            'heading' => 'المرشحات',
            'indicator' => 'المرشحات النشطة',
            'multi_select' => [
                'placeholder' => 'الكل',
            ],
            'select' => [
                'placeholder' => 'الكل',
            ],
            'trashed' => [
                'label' => 'السجلات المحذوفة',
                'only_trashed' => 'المحذوفة فقط',
                'with_trashed' => 'مع المحذوفة',
                'without_trashed' => 'بدون المحذوفة',
            ],
        ],
        'grouping' => [
            'fields' => [
                'group' => 'تجميع حسب',
                'label' => 'التسمية',
            ],
        ],
        'reorder' => [
            'handle' => 'السحب لإعادة الترتيب',
        ],
        'search' => [
            'label' => 'بحث',
            'placeholder' => 'بحث',
            'indicator' => 'بحث',
        ],
    ],
    'widgets' => [
        'account' => [
            'actions' => [
                'logout' => 'تسجيل الخروج',
            ],
            'heading' => 'الحساب',
            'subheading' => 'إدارة حسابك',
        ],
        'filament_info' => [
            'actions' => [
                'open_documentation' => [
                    'label' => 'فتح التوثيق',
                ],
                'open_github' => [
                    'label' => 'فتح GitHub',
                ],
            ],
        ],
    ],
    'resources' => [
        'system_settings' => [
            'label' => 'إعدادات النظام',
            'plural_label' => 'إعدادات النظام',
        ],
        'currency' => [
            'label' => 'عملة',
            'plural_label' => 'العملات',
        ],
        'exchange_rate' => [
            'label' => 'سعر صرف',
            'plural_label' => 'أسعار الصرف',
        ],
        'audit_log' => [
            'label' => 'سجل تدقيق',
            'plural_label' => 'سجلات التدقيق',
        ],
        'insurance_company' => [
            'label' => 'شركة تأمين',
            'plural_label' => 'شركات التأمين',
        ],
        'city' => [
            'label' => 'مدينة',
            'plural_label' => 'المدن',
        ],
        'office' => [
            'label' => 'مكتب',
            'plural_label' => 'المكاتب',
        ],
        'plan' => [
            'label' => 'خطة',
            'plural_label' => 'الخطط',
        ],
        'coupon' => [
            'label' => 'كوبون',
            'plural_label' => 'كوبونات الخصم',
        ],
        'promotion' => [
            'label' => 'عرض ترويجي',
            'plural_label' => 'العروض الترويجية',
        ],
        'slider' => [
            'label' => 'شريحة',
            'plural_label' => 'الشرائح',
        ],
        'booking' => [
            'label' => 'حجز',
            'plural_label' => 'الحجوزات',
        ],
        'nationality' => [
            'label' => 'جنسية',
            'plural_label' => 'الجنسيات',
        ],
        'category' => [
            'label' => 'فئة',
            'plural_label' => 'الفئات',
        ],
        'cv' => [
            'label' => 'سيرة ذاتية',
            'plural_label' => 'السير الذاتية',
        ],
    ],
];
