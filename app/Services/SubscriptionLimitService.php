<?php

namespace App\Services;

use App\Enums\PlanFeatureKey;
use App\Models\Cv;
use App\Models\CvBooking;
use App\Models\OfficeSubscription;

class SubscriptionLimitService
{
    public function getActiveSubscriptionForOffice(int $officeId): ?OfficeSubscription
    {
        return OfficeSubscription::on('system')
            ->with('plan.features')
            ->where('office_id', $officeId)
            ->where('active', true)
            ->where('status', 'active')
            ->where('ends_at', '>=', now())
            ->orderByDesc('ends_at')
            ->first();
    }

    public function getCvCountForSubscription(OfficeSubscription $subscription): int
    {
        return Cv::on('system')
            ->where('office_id', $subscription->office_id)
            ->whereBetween('created_at', [$subscription->starts_at, $subscription->ends_at])
            ->count();
    }

    public function getBookingCountForSubscription(OfficeSubscription $subscription): int
    {
        return CvBooking::on('system')
            ->where('office_id', $subscription->office_id)
            ->whereBetween('created_at', [$subscription->starts_at, $subscription->ends_at])
            ->count();
    }

    protected function getFeatureLimit(string $planCode, string $featureKey): ?int
    {
        $subSvc = app(SubscriptionService::class);
        $features = $subSvc->features($planCode);
        $val = $features[$featureKey] ?? null;
        if ($val === null) {
            return null;
        }
        return is_numeric($val) ? (int) $val : null;
    }

    public function canOfficeAddCv(int $officeId): array
    {
        $sub = $this->getActiveSubscriptionForOffice($officeId);
        if (!$sub) {
            return ['allowed' => false, 'message' => 'لا يوجد اشتراك نشط. يرجى التجديد أو الاشتراك أولاً.'];
        }
        $limit = $this->getFeatureLimit($sub->plan_code, PlanFeatureKey::CV_LIMIT->value);
        if ($limit === null) {
            return ['allowed' => true, 'message' => null, 'subscription' => $sub];
        }
        $count = $this->getCvCountForSubscription($sub);
        if ($count >= $limit) {
            return ['allowed' => false, 'message' => 'وصلت للحد الأقصى لعدد السير الذاتية لهذه الباقة.'];
        }
        return ['allowed' => true, 'message' => null, 'subscription' => $sub];
    }

    public function canOfficeAddBooking(int $officeId): array
    {
        $sub = $this->getActiveSubscriptionForOffice($officeId);
        if (!$sub) {
            return ['allowed' => false, 'message' => 'لا يوجد اشتراك نشط للمكتب.'];
        }
        $limit = $this->getFeatureLimit($sub->plan_code, PlanFeatureKey::BOOKINGS_LIMIT->value);
        if ($limit === null) {
            return ['allowed' => true, 'message' => null];
        }
        $count = $this->getBookingCountForSubscription($sub);
        if ($count >= $limit) {
            return ['allowed' => false, 'message' => 'وصلت للحد الأقصى لعدد الحجوزات المسموح به لهذه الباقة.'];
        }
        return ['allowed' => true, 'message' => null];
    }
}
