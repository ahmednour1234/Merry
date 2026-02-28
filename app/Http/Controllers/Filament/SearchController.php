<?php

namespace App\Http\Controllers\Filament;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\Identity\EndUser;
use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $results = [];

        // Search Offices
        $offices = Office::on('system')
            ->where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($offices as $office) {
            $results[] = [
                'id' => $office->id,
                'title' => $office->name,
                'type' => 'مكتب',
                'url' => \App\Filament\Resources\OfficeResource::getUrl('edit', ['record' => $office->id]),
            ];
        }

        // Search End Users
        $endUsers = EndUser::on('identity')
            ->where('name', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->orWhere('national_id', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($endUsers as $user) {
            $results[] = [
                'id' => $user->id,
                'title' => $user->name,
                'type' => 'مستخدم',
                'url' => \App\Filament\Resources\EndUserResource::getUrl('view', ['record' => $user->id]),
            ];
        }

        // Search CVs
        $cvs = Cv::on('system')
            ->where('file_original_name', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($cvs as $cv) {
            $results[] = [
                'id' => $cv->id,
                'title' => $cv->file_original_name ?? "CV #{$cv->id}",
                'type' => 'سيرة ذاتية',
                'url' => \App\Filament\Resources\CvResource::getUrl('edit', ['record' => $cv->id]),
            ];
        }

        return response()->json($results);
    }
}
