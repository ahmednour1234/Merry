<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfficeReview extends Model
{
    protected $connection = 'system';
    protected $table = 'office_reviews';

    protected $fillable = [
        'office_id',
        'end_user_id',
        'rating',
        'comment',
        'is_active',
    ];

    protected $casts = [
        'rating'    => 'integer',
        'is_active' => 'boolean',
    ];

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    /**
     * EndUser lives on the 'identity' connection so we can't use a real FK join.
     * Load manually when needed: EndUser::on('identity')->find($review->end_user_id)
     */
    public function getEndUserAttribute(): ?\App\Models\Identity\EndUser
    {
        return \App\Models\Identity\EndUser::on('identity')->find($this->end_user_id);
    }

    /** Scope: only active (visible) reviews */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
