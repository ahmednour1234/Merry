<?php

namespace App\Enums;

enum PlanFeatureKey: string
{
    case CV_LIMIT              = 'cv.limit';              // أقصى عدد CVs نشطة
    case REQUEST_LIMIT         = 'request.limit';         // أقصى عدد طلبات شهريًا
    case OFFICE_USERS_LIMIT    = 'office.users.limit';    // أقصى عدد مستخدمين للمكتب
    case MEDIA_STORAGE_GB      = 'media.storage.gb';      // مساحة التخزين بالـ GB
    case PRIORITY_SUPPORT      = 'support.priority';      // دعم أولوية (boolean)
    case CAN_FREEZE_CV         = 'cv.freeze.allowed';     // هل مسموح تجميد CV (boolean)
    case EXPORTS_PER_MONTH     = 'exports.per_month';     // عدد مرات التصدير شهريًا
    case MULTI_BRANCH          = 'office.multi_branch';   // دعم تعدد الفروع (boolean)
}
