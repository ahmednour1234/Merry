<?php

namespace App\Http\Controllers\Api\Office;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Office\Fcm\StoreFcmTokenRequest;
use App\Models\OfficeFcmToken;
use Illuminate\Http\Request;

class FcmTokenController extends ApiController
{
    public function __construct()
    {
        parent::__construct(app('api.responder'));
    }

    /** POST /api/v1/office/fcm-tokens */
    public function store(StoreFcmTokenRequest $r)
    {
        $office = $r->user();
        $data = $r->validated();

        $row = OfficeFcmToken::on('system')->updateOrCreate(
            ['token' => $data['token']],
            [
                'office_id' => $office->id,
                'device'    => $data['device'] ?? null,
                'platform'  => $data['platform'] ?? null,
            ]
        );

        return $this->responder->ok(['id'=>$row->id], 'FCM token saved');
    }

    /** DELETE /api/v1/office/fcm-tokens */
    public function destroy(Request $r)
    {
        $r->validate(['token'=>'required|string']);
        OfficeFcmToken::on('system')->where('token',$r->input('token'))->delete();
        return $this->responder->ok(null, 'FCM token removed');
    }
}
