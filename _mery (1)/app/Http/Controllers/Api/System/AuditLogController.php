<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\System\AuditLogResource;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends ApiController
{
    public function __construct(){ parent::__construct(app('api.responder')); }

    /**
     * @group System / Audit Logs
     * List audit logs (read-only).
     * @queryParam user_id int
     * @queryParam action string
     * @queryParam model string
     * @queryParam from date
     * @queryParam to date
     */
    public function index(Request $r)
    {
        $q = AuditLog::on('system')->where('active', true);

        if ($r->filled('user_id')) $q->where('user_id', (int)$r->user_id);
        if ($r->filled('action'))  $q->where('action', $r->action);
        if ($r->filled('model'))   $q->where('model', $r->model);
        if ($r->filled('from'))    $q->where('created_at', '>=', $r->date('from'));
        if ($r->filled('to'))      $q->where('created_at', '<=', $r->date('to'));

        $q->orderByDesc('created_at');

        $per = (int) $r->integer('per_page', 15);
        $p = $q->paginate($per > 0 ? $per : 15)->appends($r->query());

        return $this->responder->paginated($p, AuditLogResource::class, 'Audit logs');
    }
}
