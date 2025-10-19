<?php

namespace App\Repositories\System\Subscriptions\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\OfficeSubscription;

interface SubscriptionRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function currentForOffice(int $officeId): ?OfficeSubscription;
    public function createForOffice(int $officeId, string $planCode, string $currency, float $price, array $meta = []): OfficeSubscription;
    public function setAutoRenew(int $subscriptionId, bool $auto): ?OfficeSubscription;
}
