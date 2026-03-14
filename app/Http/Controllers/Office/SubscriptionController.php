<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\OfficeSubscription;
use App\Models\Plan;
use App\Repositories\System\Subscriptions\Contracts\PlanRepositoryInterface;
use App\Repositories\System\Subscriptions\Contracts\SubscriptionRepositoryInterface;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct(
        protected PlanRepositoryInterface $planRepo,
        protected SubscriptionRepositoryInterface $subsRepo,
        protected SubscriptionService $svc
    ) {}

    public function index()
    {
        $office = Auth::guard('office-panel')->user();

        $plans = $this->planRepo->paginate(['active' => 1], 50);
        $plans->getCollection()->load(['translations', 'features']);

        $currentSubscription = OfficeSubscription::on('system')
            ->with(['plan.translations', 'plan.features'])
            ->where('office_id', $office->id)
            ->where('active', true)
            ->orderByDesc('ends_at')
            ->first();

        $subscriptions = OfficeSubscription::on('system')
            ->with(['plan.translations'])
            ->where('office_id', $office->id)
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('office.subscriptions', compact('plans', 'currentSubscription', 'subscriptions'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'plan_code' => 'required|string|exists:system.plans,code',
            'coupon' => 'nullable|string|max:64',
        ]);

        $office = Auth::guard('office-panel')->user();
        $priced = $this->svc->priced($request->plan_code, $request->coupon);

        if (!$priced) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'الخطة غير متاحة'], 422);
            }
            return back()->with('error', 'الخطة غير متاحة');
        }

        $subscription = $this->subsRepo->createForOffice(
            $office->id,
            $request->plan_code,
            $priced['currency'],
            $priced['price'],
            [
                'features' => $priced['features'] ?? [],
                'coupon' => $request->coupon,
            ]
        );

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $subscription->status,
                'message' => $subscription->status === 'pending'
                    ? 'جاري المراجعة من الدعم'
                    : 'تم الاشتراك بنجاح'
            ]);
        }

        return back()->with('success', 'تم الاشتراك بنجاح');
    }

    public function toggleAutoRenew($id)
    {
        $office = Auth::guard('office-panel')->user();
        $sub = OfficeSubscription::on('system')
            ->where('id', $id)
            ->where('office_id', $office->id)
            ->first();

        if (!$sub) {
            return back()->with('error', 'لا يوجد اشتراك نشط');
        }

        $currentSubscriptionId = OfficeSubscription::on('system')
            ->where('office_id', $office->id)
            ->where('status', 'active')
            ->where('active', true)
            ->where('ends_at', '>=', now())
            ->orderByDesc('ends_at')
            ->value('id');

        if (! $sub->auto_renew && $sub->id !== $currentSubscriptionId) {
            return back()->with('error', 'يمكن تفعيل التجديد التلقائي للباقة الحالية فقط');
        }

        $this->subsRepo->setAutoRenew($sub->id, !$sub->auto_renew);

        return back()->with('success', $sub->auto_renew ? 'تم إلغاء التجديد التلقائي' : 'تم تفعيل التجديد التلقائي');
    }

    public function cancel($id)
    {
        $office = Auth::guard('office-panel')->user();
        $sub = OfficeSubscription::on('system')
            ->where('id', $id)
            ->where('office_id', $office->id)
            ->first();

        if (!$sub) {
            return back()->with('error', 'لا يوجد اشتراك');
        }

        $sub->update(['status' => 'cancelled', 'active' => false]);

        return back()->with('success', 'تم إلغاء الاشتراك');
    }

    public function renew($id)
    {
        $office = Auth::guard('office-panel')->user();
        $sub = OfficeSubscription::on('system')
            ->with('plan')
            ->where('id', $id)
            ->where('office_id', $office->id)
            ->first();

        if (!$sub) {
            return back()->with('error', 'لا يوجد اشتراك');
        }

        if ($sub->ends_at->isFuture()) {
            return back()->with('error', 'لا يمكن التجديد الآن. التجديد يتم عند انتهاء الاشتراك.');
        }

        $plan = $sub->plan;
        $startsAt = now();
        $endsAt = $plan && $plan->billing_cycle === 'annual'
            ? $startsAt->copy()->addYear()
            : $startsAt->copy()->addMonth();

        $sub->update([
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'status' => 'active',
            'active' => true,
        ]);

        \App\Models\OfficeSubscriptionLog::log($sub->id, 'renewed', [
            'starts_at' => $startsAt->toIso8601String(),
            'ends_at' => $endsAt->toIso8601String(),
        ]);

        return back()->with('success', 'تم تجديد الاشتراك بنجاح');
    }
}
