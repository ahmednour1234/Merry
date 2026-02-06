<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Office\StoreOfficeRequest;
use App\Http\Requests\Office\UpdateOfficeRequest;
use App\Http\Resources\Office\OfficeResource;
use App\Http\Resources\System\OfficeStatsResource;
use App\Models\Office;
use App\Models\Cv;
use App\Support\Uploads\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OfficeController extends ApiController
{
    public function __construct()
    {
        parent::__construct(app('api.responder'));
    }

    /**
     * عرض قائمة المكاتب مع الفلاتر
     */
    public function index(Request $r)
    {
        $q = Office::on('system')->orderByDesc('created_at');

        $s = (string) ($r->input('search') ?? $r->input('q'));
        if ($s !== '') {
            $s = '%'.$s.'%';
            $q->where(function($w) use ($s) {
                $w->where('name','like',$s)
                  ->orWhere('email','like',$s)
                  ->orWhere('commercial_reg_no','like',$s)
                  ->orWhere('phone','like',$s);
            });
        }

        if ($r->filled('city_id')) $q->where('city_id', $r->integer('city_id'));
        if ($r->has('active'))    $q->where('active', (bool)$r->boolean('active'));
        if ($r->has('blocked'))   $q->where('blocked', (bool)$r->boolean('blocked'));
        if ($r->filled('from'))   $q->where('created_at', '>=', $r->input('from'));
        if ($r->filled('to'))     $q->where('created_at', '<=', $r->input('to'));

        $per = max(1, (int)$r->integer('per_page', 15));
        $p = $q->paginate($per)->appends($r->query());

        return $this->responder->paginated($p, OfficeResource::class, 'Offices');
    }

    /**
     * إحصائيات سريعة للمكاتب وملفات السير الذاتية
     */
    public function stats(Request $r)
    {
		$total   = Office::on('system')->count();
		$active  = Office::on('system')->where('active', true)->count();
		$blocked = Office::on('system')->where('blocked', true)->count();
		$cvs     = Cv::on('system')->count();

		// Total favourites (identity DB)
		$totalFavourites = 0;
		try {
			$totalFavourites = \App\Models\Identity\FavouriteCv::on('identity')->count();
		} catch (\Throwable $e) {
			$totalFavourites = 0;
		}

        return $this->responder->ok(new OfficeStatsResource([
            'total_offices'  => $total,
            'active_offices' => $active,
            'blocked_offices'=> $blocked,
			'total_cvs'      => $cvs,
			'total_favourites' => $totalFavourites,
        ]), 'Office stats');
    }

    /**
     * إنشاء مكتب جديد
     */
    public function store(StoreOfficeRequest $r)
    {
        $data = $r->validated();
        $data['password'] = Hash::make($data['password']);

        // رفع الصورة إن وجدت
        if ($r->hasFile('image')) {
            $data['image'] = ImageUploader::upload($r->file('image'), 'offices');
        }

        $row = Office::on('system')->create($data);
        return $this->responder->created(new OfficeResource($row), 'Office created');
    }

    /**
     * عرض مكتب واحد حسب المعرّف
     */
    public function show($id)
    {
        $row = Office::on('system')->find((int)$id);
        if (!$row) return $this->responder->fail('Office not found', status:404);

        return $this->responder->ok(new OfficeResource($row), 'Office');
    }

    /**
     * تحديث بيانات المكتب
     */
    public function update($id, UpdateOfficeRequest $r)
    {
        $row = Office::on('system')->find((int)$id);
        if (!$row) return $this->responder->fail('Office not found', status:404);

        $data = $r->validated();

        // تحديث كلمة المرور إن وُجدت
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // تحديث الصورة
        if ($r->hasFile('image')) {
            // حذف الصورة القديمة
            \App\Support\Uploads\ImageUploader::deleteIfExists($row->image);
            // رفع الجديدة
            $data['image'] = ImageUploader::upload($r->file('image'), 'offices');
        }

        $row->fill($data)->save();

        return $this->responder->ok(new OfficeResource($row), 'Office updated');
    }

    /** حظر / إلغاء حظر */
    public function block(Request $r, $id)
    {
        $r->validate(['blocked'=>'required|boolean']);
        $row = Office::on('system')->find((int)$id);
        if (!$row) return $this->responder->fail('Office not found', status:404);

        $row->blocked = (bool)$r->boolean('blocked');
        $row->save();

        return $this->responder->ok(new OfficeResource($row), 'Office block status updated');
    }

    /** تفعيل / تعطيل */
    public function toggle(Request $r, $id)
    {
        $r->validate(['active'=>'required|boolean']);
        $row = Office::on('system')->find((int)$id);
        if (!$row) return $this->responder->fail('Office not found', status:404);

        $row->active = (bool)$r->boolean('active');
        $row->save();

        return $this->responder->ok(new OfficeResource($row), 'Office status updated');
    }

    /** حذف مكتب */
    public function destroy($id)
    {
        $row = Office::on('system')->find((int)$id);
        if (!$row) return $this->responder->fail('Office not found', status:404);

        // حذف الصورة من التخزين
        \App\Support\Uploads\ImageUploader::deleteIfExists($row->image);

        $row->delete();
        return $this->responder->ok(null, 'Office deleted');
    }
}
 