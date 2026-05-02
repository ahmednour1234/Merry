<?php

namespace App\Http\Controllers\Api\EndUser;

use App\Http\Controllers\Api\ApiController;
use App\Models\Identity\EndUser;
use App\Models\Office;
use App\Models\OfficeReview;
use Illuminate\Http\Request;

class OfficeReviewController extends ApiController
{
    public function __construct()
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * GET /api/v1/enduser/offices/{officeId}/reviews
     * List active reviews for an office (public – only active ones)
     * @group EndUser / Office Reviews
     * @urlParam officeId integer required The office ID. Example: 1
     * @queryParam per_page integer Results per page. Example: 15
     */
    public function index(Request $request, int $officeId)
    {
        $office = Office::on('system')->findOrFail($officeId);

        $per = max(1, (int) $request->integer('per_page', 15));

        $reviews = OfficeReview::on('system')
            ->where('office_id', $officeId)
            ->where('is_active', true)
            ->orderByDesc('id')
            ->paginate($per);

        // Attach end-user names from identity DB
        $userIds  = $reviews->pluck('end_user_id')->unique()->values()->all();
        $userMap  = EndUser::on('identity')
            ->whereIn('id', $userIds)
            ->get(['id', 'name'])
            ->keyBy('id');

        $items = $reviews->map(function ($r) use ($userMap) {
            return [
                'id'         => $r->id,
                'rating'     => $r->rating,
                'comment'    => $r->comment,
                'created_at' => $r->created_at,
                'user'       => isset($userMap[$r->end_user_id])
                    ? ['id' => $r->end_user_id, 'name' => $userMap[$r->end_user_id]->name]
                    : ['id' => $r->end_user_id, 'name' => 'مستخدم'],
            ];
        });

        // Summary stats
        $stats = OfficeReview::on('system')
            ->where('office_id', $officeId)
            ->where('is_active', true)
            ->selectRaw('COUNT(*) as total, AVG(rating) as average, 
                SUM(CASE WHEN rating=5 THEN 1 ELSE 0 END) as five,
                SUM(CASE WHEN rating=4 THEN 1 ELSE 0 END) as four,
                SUM(CASE WHEN rating=3 THEN 1 ELSE 0 END) as three,
                SUM(CASE WHEN rating=2 THEN 1 ELSE 0 END) as two,
                SUM(CASE WHEN rating=1 THEN 1 ELSE 0 END) as one')
            ->first();

        return response()->json([
            'status'  => true,
            'message' => 'Office reviews',
            'data'    => [
                'stats' => [
                    'total'   => (int) $stats->total,
                    'average' => $stats->total > 0 ? round($stats->average, 2) : null,
                    'breakdown' => [
                        5 => (int) $stats->five,
                        4 => (int) $stats->four,
                        3 => (int) $stats->three,
                        2 => (int) $stats->two,
                        1 => (int) $stats->one,
                    ],
                ],
                'reviews'    => $items,
                'pagination' => [
                    'total'        => $reviews->total(),
                    'per_page'     => $reviews->perPage(),
                    'current_page' => $reviews->currentPage(),
                    'last_page'    => $reviews->lastPage(),
                ],
            ],
        ]);
    }

    /**
     * POST /api/v1/enduser/offices/{officeId}/reviews
     * Submit or update the authenticated user's review for an office.
     * @group EndUser / Office Reviews
     * @urlParam officeId integer required The office ID. Example: 1
     * @bodyParam rating integer required Rating from 1 to 5. Example: 5
     * @bodyParam comment string nullable Review text. Example: خدمة ممتازة
     */
    public function store(Request $request, int $officeId)
    {
        Office::on('system')->findOrFail($officeId);

        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $userId = (int) $request->user()->id;

        $review = OfficeReview::on('system')->updateOrCreate(
            ['office_id' => $officeId, 'end_user_id' => $userId],
            [
                'rating'    => $data['rating'],
                'comment'   => $data['comment'] ?? null,
                'is_active' => true,   // reset to active on re-submit
            ]
        );

        return response()->json([
            'status'  => true,
            'message' => 'تم حفظ تقييمك بنجاح',
            'data'    => [
                'id'         => $review->id,
                'rating'     => $review->rating,
                'comment'    => $review->comment,
                'created_at' => $review->created_at,
            ],
        ], 201);
    }

    /**
     * DELETE /api/v1/enduser/offices/{officeId}/reviews
     * Delete the authenticated user's own review for an office.
     * @group EndUser / Office Reviews
     * @urlParam officeId integer required The office ID. Example: 1
     */
    public function destroy(Request $request, int $officeId)
    {
        $userId = (int) $request->user()->id;

        $review = OfficeReview::on('system')
            ->where('office_id', $officeId)
            ->where('end_user_id', $userId)
            ->firstOrFail();

        $review->delete();

        return response()->json([
            'status'  => true,
            'message' => 'تم حذف تقييمك',
        ]);
    }
}
