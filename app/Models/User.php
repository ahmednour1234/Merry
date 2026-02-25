<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // <-- مهم

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, Notifiable, SoftDeletes; // <-- ضيف الـ Trait هنا

protected $connection = 'system';

    protected $fillable = ['name','email','phone','password','guard','active','last_login_at'];
    protected $hidden   = ['password','remember_token'];
    protected $casts    = ['active'=>'boolean','last_login_at'=>'datetime'];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->active && $this->guard === 'filament';
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user')->withTimestamps();
    }
}
