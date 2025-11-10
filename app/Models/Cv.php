<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        if (!empty($f['office_id']))       $q->where('office_id', $f['office_id']);
        if (!empty($f['category_id']))     $q->where('category_id', $f['category_id']);
        if (!empty($f['nationality']))     $q->where('nationality_code', $f['nationality']);
        if (!empty($f['gender']))          $q->where('gender', $f['gender']);
        if (isset($f['has_experience']))   $q->where('has_experience', (bool)$f['has_experience']);
        if (!empty($f['status']))          $q->where('status', $f['status']);
        if (!empty($f['from']))            $q->where('created_at','>=',$f['from']);
        if (!empty($f['to']))              $q->where('created_at','<=',$f['to']);
        if (isset($f['is_muslim']))        $q->where('is_muslim', (bool)$f['is_muslim']);
        return $q;
    }
}
