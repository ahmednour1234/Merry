<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Models\Identity\EndUser;
use App\Models\OfficeReview;
use Illuminate\Http\Request;

class OfficeReviewController extends ApiController
{
    public function __construct()
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * GET /api/v1/admin/system/office-reviews
     * List all reviews (admin).
     * @group Admin / Office Reviews
     * @queryParam office_id integer Filter by office. Example: 1
     * @queryParam is_active boolean Filter by active status. Example: 1
     * @queryParam per_page integer Results per page. Example: 15
     */
    public function index(Request $request)
    {
        $per = max(1, (int) $request->integer('per_page', 15));

        $q = OfficeReview::on('system')->with('office')->orderByDesc('id');

        if ($request->filled('office_id')) {
            $q->where('office_id', (int) $request->integer('office_id'));
        }
        if ($request->has('is_active')) {
            $q->where('is_active', (bool) $request->boolean('is_active'));
        }

        $reviews = $q->paginate($per);

        $userIds = $reviews->pluck('end_user_id')->unique()->values()->all();
        $userMap = EndUser::on('identity')
            ->whereIn('id', $userIds)
            ->get(['id', 'name', 'phone'])
            ->keyBy('id');

        $items = $reviews->map(fn($r) => [
            'id'         => $r->id,
            'office_id'  => $r->office_id,
            'office'     => $r->office ? ['id' => $r->office->id, 'name' => $r->office->name] : null,
            'end_user_id'=> $r->end_user_id,
            'user'       => isset($userMap[$r->end_user_id])
                ? ['id' => $r->end_user_id, 'name' => $userMap[$r->end_user_id]->name, 'phone' => $userMap[$r->end_user_id]->phone]
                : ['id' => $r->end_user_id, 'name' => 'مستخدم', 'phone' => null],
            'rating'     => $r->rating,
            'comment'    => $r->comment,
            'is_active'  => $r->is_active,
            'created_at' => $r->created_at,
        ]);

        return response()->json([
            'status' => true,
            'data'   => $items,
            'pagination' => [
                'total'        => $reviews->total(),
                'per_page'     => $reviews->perPage(),
                'current_page' => $reviews->currentPage(),
                'last_page'    => $reviews->lastPage(),
            ],
        ]);
    }

    /**
     * POST /api/v1/admin/system/office-reviews/{id}/toggle
     * Activate or deactivate a review.
     * @group Admin / Office Reviews
     * @urlParam id integer required Review ID. Example: 1
     */
    public function toggle(int $id)
    {
        $review = OfficeReview::on('system')->findOrFail($id);
        $review->update(['is_active' => !$review->is_active]);

        return response()->json([
            'status'    => true,
            'message'   => $review->is_active ? 'تم تفعيل التقييم' : 'تم إيقاف التقييم',
            'is_active' => $review->is_active,
        ]);
    }

    /**
     * DELETE /api/v1/admin/system/office-reviews/{id}
     * Delete a review (admin).
     * @group Admin / Office Reviews
     * @urlParam id integer required Review ID. Example: 1
     */
    public function destroy(int $id)
    {
        $review = OfficeReview::on('system')->findOrFail($id);
        $review->delete();

        return response()->json([
            'status'  => true,
            'message' => 'تم حذف التقييم',
        ]);
    }
}
