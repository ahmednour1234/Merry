<?php

namespace App\Models\Identity;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class EndUser extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    protected $connection = 'identity';

    protected $table = 'end_users';

    protected $guard = 'enduser';

    protected $fillable = [
        'national_id',
        'name',
        'phone',
        'password',
        'country_id',
        'city_id',
        'avatar_path',
        'bio',
        'active',
        'blocked',
        'last_login_at',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'active' => 'boolean',
        'blocked' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    protected $appends = [
        'avatar_url',
    ];

    public function tokens(): MorphMany
    {
        return $this->morphMany(IdentityPersonalAccessToken::class, 'tokenable');
    }

    public function getAvatarUrlAttribute(): ?string
    {
        if (empty($this->avatar_path)) {
            return null;
        }

        return asset('storage/' . ltrim($this->avatar_path, '/'));
    }

    public function bookings()
    {
        return $this->hasMany(\App\Models\CvBooking::class, 'end_user_id', 'id');
    }

    public function favouriteCvs()
    {
        return $this->hasMany(FavouriteCv::class, 'end_user_id', 'id');
    }

    public function getBookingsCountAttribute(): int
    {
        return \App\Models\CvBooking::on('system')
            ->where('end_user_id', $this->id)
            ->count();
    }

    public function getFavouritesCountAttribute(): int
    {
        return FavouriteCv::on('identity')
            ->where('end_user_id', $this->id)
            ->count();
    }
}


