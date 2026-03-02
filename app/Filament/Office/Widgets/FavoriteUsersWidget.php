<?php

namespace App\Filament\Office\Widgets;

use App\Models\Identity\FavouriteCv;
use App\Models\Identity\EndUser;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class FavoriteUsersWidget extends Widget
{
    protected string $view = 'filament.office.widgets.favorite-users-widget';
    protected static ?int $sort = 2;

    public function getViewData(): array
    {
        $office = Auth::guard('office-panel')->user();

        $cvIds = \App\Models\Cv::on('system')
            ->where('office_id', $office->id)
            ->pluck('id')
            ->toArray();

        if (empty($cvIds)) {
            return ['users' => []];
        }

        $favorites = FavouriteCv::on('identity')
            ->selectRaw('end_user_id, COUNT(*) as favorites_count')
            ->whereIn('cv_id', array_values($cvIds))
            ->groupBy('end_user_id')
            ->orderByDesc('favorites_count')
            ->limit(10)
            ->get();

        $data = [];
        foreach ($favorites as $fav) {
            $user = EndUser::on('identity')->find($fav->end_user_id);
            $data[] = [
                'user_id' => $fav->end_user_id,
                'user_name' => $user ? ($user->name ?? $user->phone ?? "User #{$fav->end_user_id}") : "User #{$fav->end_user_id}",
                'count' => $fav->favorites_count,
            ];
        }

        return ['users' => $data];
    }
}
