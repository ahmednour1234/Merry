<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $fillable = ['name','slug','guard','active'];
    protected $casts = ['active'=>'boolean'];

    public function roles() { return $this->belongsToMany(Role::class, 'permission_role'); }
    public function users() { return $this->belongsToMany(User::class, 'permission_user'); }
}
