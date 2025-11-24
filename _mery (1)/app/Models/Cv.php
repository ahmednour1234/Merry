<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Cv extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $table = 'cvs';

    protected $fillable = [
        'office_id','category_id','nationality_code','gender','has_experience',
        'file_path','file_mime','file_size','file_original_name',
        'status','approved_by','approved_at','rejected_by','rejected_at','rejected_reason',
        'is_muslim',
        'frozen_by','frozen_at','deactivated_by_office_at','meta',
    ];

    protected $casts = [
        'has_experience' => 'boolean',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'frozen_at'   => 'datetime',
        'deactivated_by_office_at' => 'datetime',
        'meta' => 'array',
    ];
    public function nationality()
    {
        return $this->belongsTo(\App\Models\Nationality::class, 'nationality_code', 'code');
    }

    // علاقات
    public function office()   { return $this->belongsTo(\App\Models\Office::class, 'office_id'); }
    public function category() { return $this->belongsTo(\App\Models\Category::class, 'category_id'); }

    // Scopes للفلاتر
    public function scopeFilter($q, array $f)
    {
        if (filled($f['id'] ?? null)) {
            $ids = $f['id'];

            if (!is_array($ids)) {
                $ids = preg_split('/[,\s]+/', (string) $ids, -1, PREG_SPLIT_NO_EMPTY) ?: [];
            }

            $ids = array_values(array_filter(array_map(fn ($id) => (int) $id, $ids)));

            if (!empty($ids)) {
                count($ids) === 1
                    ? $q->whereKey(reset($ids))
                    : $q->whereIn('id', $ids);
            }
        }

        if (filled($f['office_id'] ?? null)) {
            $q->where('office_id', $f['office_id']);
        }

        if (filled($f['category_id'] ?? null)) {
            $q->where('category_id', $f['category_id']);
        }

        if (filled($f['name'] ?? null)) {
            $name = trim((string) $f['name']);

            $q->where(function ($query) use ($name) {
                $like = '%' . $name . '%';

                $query->where('meta->name', 'like', $like)
                    ->orWhere('meta->full_name', 'like', $like);
            });
        }

        $nationality = $f['nationality_code'] ?? $f['nationality'] ?? null;
        if (filled($nationality)) {
            $q->where('nationality_code', $nationality);
        }

        if (filled($f['gender'] ?? null)) {
            $q->where('gender', $f['gender']);
        }

        if (array_key_exists('has_experience', $f)) {
            $bool = self::normalizeBoolean($f['has_experience']);
            if (!is_null($bool)) {
                $q->where('has_experience', $bool);
            }
        }

        if (filled($f['status'] ?? null)) {
            $q->where('status', $f['status']);
        }

        if ($from = self::normalizeDate($f['from'] ?? null, true)) {
            $q->where('created_at', '>=', $from);
        }

        if ($to = self::normalizeDate($f['to'] ?? null, false)) {
            $q->where('created_at', '<=', $to);
        }

        if (array_key_exists('is_muslim', $f)) {
            $bool = self::normalizeBoolean($f['is_muslim']);
            if (!is_null($bool)) {
                $q->where('is_muslim', $bool);
            }
        }

        return $q;
    }

    protected static function normalizeBoolean(mixed $value): ?bool
    {
        if (is_bool($value)) {
            return $value;
        }

        if (is_numeric($value)) {
            return (bool) $value;
        }

        if (is_string($value)) {
            $value = strtolower(trim($value));

            if (in_array($value, ['1', 'true', 'yes', 'on'], true)) {
                return true;
            }

            if (in_array($value, ['0', 'false', 'no', 'off'], true)) {
                return false;
            }
        }

        return null;
    }

    protected static function normalizeDate(mixed $value, bool $isStart): ?string
    {
        if (empty($value)) {
            return null;
        }

        try {
            $date = Carbon::parse($value);
        } catch (\Throwable) {
            return null;
        }

        return $isStart
            ? $date->startOfDay()->toDateTimeString()
            : $date->endOfDay()->toDateTimeString();
    }
}
