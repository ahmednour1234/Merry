<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $fillable = ['name','slug','guard','active'];
    protected $casts = ['active'=>'boolean'];

    public function users()      { return $this->belongsToMany(User::class, 'role_user'); }
    public function permissions(){ return $this->belongsToMany(Permission::class, 'permission_role'); }
}
