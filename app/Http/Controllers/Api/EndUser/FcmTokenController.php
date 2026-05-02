<?php

namespace App\Http\Controllers\Api\EndUser;

use App\Http\Controllers\Api\ApiController;
use App\Models\Identity\EndUserFcmToken;
use Illuminate\Http\Request;

class FcmTokenController extends ApiController
{
    public function __construct()
    {
        parent::__construct(app('api.responder'));
    }

    /** POST /api/v1/enduser/fcm-tokens */
    public function store(Request $request)
    {
        $request->validate([
            'token'    => ['required', 'string', 'max:512'],
            'device'   => ['nullable', 'string', 'max:191'],
            'platform' => ['nullable', 'string', 'max:191'],
        ]);

        $user = $request->user();

        $row = EndUserFcmToken::updateOrCreate(
            ['token' => $request->input('token')],
            [
                'end_user_id' => $user->id,
                'device'      => $request->input('device'),
                'platform'    => $request->input('platform'),
            ]
        );

        return $this->responder->ok(['id' => $row->id], 'FCM token saved');
    }

    /** DELETE /api/v1/enduser/fcm-tokens */
    public function destroy(Request $request)
    {
        $request->validate(['token' => ['required', 'string']]);

        EndUserFcmToken::where('token', $request->input('token'))->delete();

        return $this->responder->ok(null, 'FCM token removed');
    }
}
